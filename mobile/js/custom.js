$(document).ready(function() {
    startBTCRefresh();
    changeCounter();
});

var refresh_sec = 5*1000;
var current_sec = refresh_sec/1000;
var lastEUR = 0;
var lastSAT = null;
var lastSATDiff = 0;
var lastTrend = null;

function startBTCRefresh() {
    $.get("../index.php").done(function (data) {
        if (data.failed) {
            alert("ERROR: "+data.msg);
        } else {
            var sat = Math.round(data.num1/1000);
            var btc = sat/100000000;
            var addHint = '';
            if(lastSAT != null && (sat > lastSAT || lastSATDiff > 0) ) {
                var diff = sat - lastSAT;
                lastSATDiff = diff > 0 ? diff : lastSATDiff;
                addHint = ' <small class="h3">+'+lastSATDiff+'</small>';
            }
            lastSAT = sat;
            $('#btcpayaddr').html(data.addr);
            $('#satoshi_amount').html(sat + addHint);
            $('#btc_amount').html(btc + ' ' + '<i class="fa fa-btc"></i>');
            $('#lat_share_timestamp').html( Math.round(data.list[0].posix_time/1000) );
            $('#lat_share_difficulty').html( data.list[0].difficulty );
            $('#lat_share_yield').html( (data.list[0].amount/1000) + ' Satoshis' );
            getBTCTicker(btc);
            setTimeout( startBTCRefresh, refresh_sec );
        }
    }).fail(function(data) {
        console.log('An unknown Error occurred. Please contact the webmaster.');
        error_cnt++;
        if(error_cnt > 3) {
            alert('An unknown Error occurred. Please contact the webmaster.');
            error_cnt = 0;
        }
    });
}

function getBTCTicker(btc_val) {
    var ticker_url = "https://blockchain.info/de/ticker?"+Date.now();
    $.get(ticker_url).done(function (data) {
        var eur = (data.EUR.last*btc_val).toFixed(8);
        var trend_icon = ' <i class="fa fa-caret-{trend}"></i>';
        var trend = null;
        if(data.EUR.last > lastEUR) {
            trend = 'up';
        } else if (data.EUR.last < lastEUR) {
            trend = 'down';
        }

        if(trend == null && lastTrend == null) {
            trend_icon = '';
        } else {
            if(trend != null) lastTrend = trend;
            trend_icon = trend_icon.replace('{trend}', lastTrend);
        }
        lastEUR = data.EUR.last;
        $('#btcvalue').html(data.EUR.last + ' ' + data.EUR.symbol + trend_icon);
        $('#eur_amount').html(eur + ' ' + data.EUR.symbol);
        resetChangeCounter();
    }).fail(function(data) {
        alert("An unknown Error occurred. Please contact the webmaster.");
    });
}

function changeCounter() {
    if(current_sec < 0) {
        $('.refresh-counter').html('updating now...');
    } else {
        $('.refresh-counter').html('update in ' + current_sec + ' sec.');
        current_sec--;
    }
    setTimeout( changeCounter, 1000 );
}

function resetChangeCounter() {
    current_sec = refresh_sec/1000;
}
