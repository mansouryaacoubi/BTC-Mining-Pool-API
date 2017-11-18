<?php
    header('Content-Type: application/json');
    
    const DEFAULT_BTC_PAYOUT_ADDRESS = '1f7now3v2J56gzpYQfkmn1mv9KvcqtC6E';
    define('BTC_PAYOUT_ADDRESS', isset($_GET['q'])?$_GET['q']:DEFAULT_BTC_PAYOUT_ADDRESS);
    
    const BASE_URL           = 'http://www.groupfabric.com/pool/?q=';
    const SEARCH_FLAG        = 'set_viewmodel(';
    const FILE_NAME          = 'stats.csv';

    $htmldoc     = file_get_contents(BASE_URL.BTC_PAYOUT_ADDRESS);
    $offset      = strpos($htmldoc, SEARCH_FLAG) + 1;
    
    $start_pos   = strpos($htmldoc, SEARCH_FLAG, $offset);

    $htmldoc     = substr($htmldoc, $start_pos);
    $htmldoc     = explode("\n", $htmldoc)[0];
    $htmldoc     = trim(str_replace(SEARCH_FLAG, '', $htmldoc));
    $htmldoc     = substr($htmldoc, 0, strlen($htmldoc)-1);
    $obj         = null;
    if(empty($obj = json_decode($htmldoc))) {
        echo json_encode(['status' => 'ERROR', 'failed' => true, 'msg' => 'BTC Payout Address does not exist in this mining pool', 'addr' => BTC_PAYOUT_ADDRESS]);
    } else {
        $obj->status = 'SUCCESS';
        $obj->failed = false;
        if( is_null($obj->posix_time) ) {
            $obj->posix_time = round(microtime(true)*1000);
        }
        $obj->hr_time = date('d.m.Y H:i:s', round($obj->posix_time/1000));
        if(isset($_GET['stats'])) {
            $result = date('d.m.Y H:i:s') . ';' . ($obj->num1/1000).PHP_EOL;
            if(!file_exists(FILE_NAME)) {
                file_put_contents(FILE_NAME, 'Timestamp; Satoshis'.PHP_EOL);
            }
            file_put_contents(FILE_NAME, $result, FILE_APPEND | LOCK_EX);
        }
        echo json_encode($obj);
    }