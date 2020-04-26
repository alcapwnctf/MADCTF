#!/usr/bin/env python3

import sys
import mysql.connector
import yaml
import requests
from checklib import *

# yml = yaml.load(open('/app/config/config.yml'), Loader=yaml.FullLoader)
# yml_teams_ip = (lambda team_list: {k['ip']: k['name'] for k in team_list})
# teams_ip = yml_teams_ip(yml['teams'])

teams_ip = {'172.19.10.11': 'byteforc3', '172.19.10.12': 'invaders', '172.19.10.13': 'dadac0c0', '172.19.10.14': '69ingdeadbabies', '172.19.10.15': 'mr', '172.19.10.16': 'abs0lut3pwn4g3', '172.19.10.17': 'inv4sion', '172.19.10.18': 'infoseciitr', '172.19.10.19': 'zh3r0', '172.19.10.20': 'c4r3t4k3r5', '172.19.10.21': 'noobsinthehouse', '172.19.10.22': 'd4rkc0de', '172.19.10.23': 'citadel', '172.19.10.24': 'dc1ph3r', '172.19.10.25': 'cicada3301', '172.19.10.26': 'batsquad', '172.19.10.27': 'hackrangers', '172.19.10.28': 'teammeta', '172.19.10.29': 'cybercaliphate', '172.19.10.30': 'warmachinelab', '172.19.10.31': 'hijackers', '172.19.10.32': 'cyberknight00', '172.19.10.33': 'deamons', '172.19.10.34': 'noobmaster69', '172.19.10.35': 'teampaladin', '172.19.10.36': 'cyberdefecers', '172.19.10.37': 'boot2noob', '172.19.10.38': 'airbenders', '172.19.10.39': 'pwnth3ml1k3y0u0wnth3m', '172.19.10.40': 'foobar', '172.19.10.41': '3p1d3m1c', '172.19.10.42': 'rougewolves', '172.19.10.43': 'dcua', '172.19.10.44': 'redpwn'}
ROOT_PASS = 'MyVeryEpicMysqlR00tp@ssword'

def insertFlag(cursor, flag, flagid):
    cursor.execute(f"""INSERT INTO flag(flag, flagid) VALUES('{flag}', '{flagid}')""")

def getFlag(cursor, flagid):
    r = cursor.execute(f"""SELECT * FROM flag WHERE flagid='{flagid}'""")
    return cursor.fetchone()

def put(host, flagid, flag, vuln):
    try:
        r = requests.get(f"http://{host}:8080/")
        if r.status_code != 200:
            cquit(Status.DOWN, 'Connection error')
    except:
            cquit(Status.DOWN, 'Connection error')
    
    try:
        mydb = mysql.connector.connect(
            host='172.19.10.10',
            user='root',
            database=teams_ip[host], 
            passwd=ROOT_PASS,
            autocommit=True
        )

        cursor = mydb.cursor()
    except:
        cquit(Status.DOWN, 'Connection error')

    insertFlag(cursor, flag, flagid)
    cquit(Status.OK, 'Success put:'+flagid)

def get(host, flagid, flag, vuln):
    try:
        mydb = mysql.connector.connect(
            host='172.19.10.10',
            user='root',
            database=teams_ip[host], 
            passwd=ROOT_PASS,
            autocommit=True
        )

        cursor = mydb.cursor()
    except:
        cquit(Status.DOWN, 'Connection error')

    flagTable = getFlag(cursor, flagid)
    if flagid in flagTable or flag in flagTable:
        cquit(Status.OK)
    else:
        cquit(Status.CORRUPT)

    cquit(Status.MUMBLE)

def check(host):
    try:
        r = requests.get(f"http://{host}:8080/")
        if r.status_code != 200:
            cquit(Status.DOWN, 'Connection error')
    except:
            cquit(Status.DOWN, 'Connection error')

    try:
        mydb = mysql.connector.connect(
            host='172.19.10.10',
            user='root',
            database=teams_ip[host], 
            passwd=ROOT_PASS,
            autocommit=True
        )

        cursor = mydb.cursor()
    except:
        cquit(Status.DOWN, 'Connection error')

    cquit(Status.OK)

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