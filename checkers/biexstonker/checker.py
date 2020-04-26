#!/usr/bin/env python3

import sys
import mysql.connector
import yaml
import random
import string
import requests
from checklib import *

teams_ip = {'172.19.10.11': 'byteforc3', '172.19.10.12': 'invaders', '172.19.10.13': 'dadac0c0', '172.19.10.14': '69ingdeadbabies', '172.19.10.15': 'mr', '172.19.10.16': 'abs0lut3pwn4g3', '172.19.10.17': 'inv4sion', '172.19.10.18': 'infoseciitr', '172.19.10.19': 'zh3r0', '172.19.10.20': 'c4r3t4k3r5', '172.19.10.21': 'noobsinthehouse', '172.19.10.22': 'd4rkc0de', '172.19.10.23': 'citadel', '172.19.10.24': 'dc1ph3r', '172.19.10.25': 'cicada3301', '172.19.10.26': 'batsquad', '172.19.10.27': 'hackrangers', '172.19.10.28': 'teammeta', '172.19.10.29': 'cybercaliphate', '172.19.10.30': 'warmachinelab', '172.19.10.31': 'hijackers', '172.19.10.32': 'cyberknight00', '172.19.10.33': 'deamons', '172.19.10.34': 'noobmaster69', '172.19.10.35': 'teampaladin', '172.19.10.36': 'cyberdefecers', '172.19.10.37': 'boot2noob', '172.19.10.38': 'airbenders', '172.19.10.39': 'pwnth3ml1k3y0u0wnth3m', '172.19.10.40': 'foobar', '172.19.10.41': '3p1d3m1c', '172.19.10.42': 'rougewolves', '172.19.10.43': 'dcua', '172.19.10.44': 'redpwn'}

STOCK_VALUE = 10001

ROOT_PASS = 'MyVeryEpicMysqlR00tp@ssword'
res = (lambda N: ''.join(random.choices(string.ascii_uppercase + string.digits, k = N))) 

EMAIL = f"{res(10)}@google.com"
NAME = res(10)

LOGIN_URI = '/scripts/login.php'
REGISTER_URI = '/scripts/register-action.php'
STONKS_URI = '/home/stonks.php'

def getLoggedInSession(host, username, password):
    s = requests.Session()
    r = s.post(f'http://{host}:8080{LOGIN_URI}', data={'username':username, 'password':password})

    return s

def registerNewUser(host, username, password):
    r = requests.post(f'http://{host}:8080{REGISTER_URI}', data={'username':username, 'password':password, 'email': EMAIL, 'name': NAME, 'submit': True})

    return r

def put(host, flagid, flag, vuln):
    try:
        r = requests.get(f"http://{host}:8080/")
        if r.status_code != 200:
            cquit(Status.DOWN, 'Connection error')
    except:
            cquit(Status.DOWN, 'Connection error')
    
    r = registerNewUser(host, flagid, flag)

    if r.status_code == 200 and 'Account Created Successfully!' in r.text:
        cquit(Status.OK, 'Flag put:'+flagid)
    else:
        cquit(Status.MUMBLE, 'Couldnt put flag:'+r.status_code)


def get(host, flagid, flag, vuln):
    s = getLoggedInSession(host, flagid, flag)
    r = s.get(f'http://{host}:8080/home/dashboard.php')
    if r.status_code == 200 and flagid in r.text:
        cquit(Status.OK, 'Success get')
    else:
        cquit(Status.DOWN, 'incorrect response')
        
    cquit(Status.MUMBLE, 'Unkown GET')

def check(host):
    r = requests.get(f'http://{host}:8080/index.php')
    if r.status_code != 200:
        cquit(Status.DOWN, 'Connection error')

    cquit(Status.OK, "Success check")

if __name__ == '__main__':
    action, *args = sys.argv[1:]
    if action == "check":
        host, *argsextra = args
        check(host)

    elif action == "get":
        host, flagid, flag, vuln = args
        get(host, flagid, flag, vuln)

    elif action == "put":
        host, flagid, flag, vuln = args
        put(host, flagid, flag, vuln)
    else:
        cquit(Status.ERROR, 'System error', 'Unknown action: ' + action)