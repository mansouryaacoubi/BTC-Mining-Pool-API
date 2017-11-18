#!/usr/bin/env

import requests
from time import sleep, time
import os

filename = 'stats.csv'

while True:
    req = requests.get('https://yaacoubi.com/btc')
    req = req.json()
    sat = str(round(req['num1']/1000))
    hrt = req['hr_time'] # human readable time
    tmstamp = str(round(time()))
    csvstr = hrt + ';' + sat + '\n'
    if not os.path.exists(filename):
        csvstr = 'Timestamp; Satoshis\n' + csvstr
    with open(filename, 'a') as f:
        f.write(csvstr)
    print('[' + tmstamp + '] => ' + sat + ' Satoshis mined.')
    sleep(5*60)
