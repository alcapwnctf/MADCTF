#!/usr/local/bin/python3

import paramiko, sys, os, time
from checklib import *
from requests import get as GET


FILEPATH ="/var/www/html"
SLA_FILENAME = {
    "1":"/heaven/",
    "2":"/home/",
    "3":"/scripts/"
}

BASE_DIR = os.path.abspath(os.path.dirname(__file__))
KEYPATH=BASE_DIR+"/rootkey"

def put(host, flagid, flag, vuln):

    flagfile = FILEPATH+SLA_FILENAME[vuln]+flagid
    
    key = paramiko.RSAKey.from_private_key_file(KEYPATH)
    client = paramiko.SSHClient()
    client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    try:
        client.connect(hostname = host, username = "root", pkey = key)
    except:
        time.sleep(2)
        try:
            client.connect(hostname = host, username = "root", pkey = key)
        except:
            cquit(Status.DOWN, 'Connection error')

    commands = ["echo {} > {}".format(flag, flagfile), "chown -R www-data:www-data {}".format(flagfile), "chmod 400 {}"]
    for command in commands:
        client.exec_command(command)
        
    client.close()
    cquit(Status.OK)


def get(host, flagid, flag, vuln):
    try:
        r = GET("http://{}:8080{}".format(host,SLA_FILENAME[vuln]+flagid))
    except:
        cquit(Status.DOWN)

    if r.status_code != 200:cquit(Status.MUMBLE)
    if r.text.strip() == flag:cquit(Status.OK)
    cquit(Status.CORRUPT)
    


def check(host):

    try:
        r = GET("http://{}:8080/index.php".format(host))
    except Exception as e:
        cquit(Status.DOWN)
    if r.status_code == 200: 
        cquit(Status.OK)
    cquit(Status.MUMBLE)


if __name__ == '__main__':
    action, *args = sys.argv[1:]
    if action == "check":
        host, = args
        check(host)

    elif action == "get":
        host, flagid, flag, vuln = args
        get(host, flagid, flag, vuln)

    elif action == "put":
        host, flagid, flag, vuln = args
        put(host, flagid, flag, vuln)
    else:
        cquit(Status.ERROR, 'System error', 'Unknown action: ' + action)