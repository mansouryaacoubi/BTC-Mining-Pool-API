import requests
from time import sleep, time

while True:
    r = requests.get('https://yaacoubi.com/btc?stats')
    sat = str(r.json()['num1']/1000)
    tmstamp = str(round(time()))
    print('[' + tmstamp + '] => ' + sat + ' Satoshis mined.')
    sleep(5*60)