#!/usr/local/bin/python3

import paramiko, sys, os, subprocess
from checklib import *

BASE_DIR = os.path.abspath(os.path.dirname(__file__))
KEYPATH=BASE_DIR+"/rootkey"
flagfile = "/rootflag"

def put(host, flagid, flag, vuln):
    
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

    commands = ['echo "{}:{}" >> {}'.format(flagid, flag, flagfile), "chown -R root:root {}".format(flagfile), "chmod 400 {}"]
    for command in commands:
        client.exec_command(command)
        
    client.close()
    cquit(Status.OK)


def get(host, flagid, flag, vuln):

    key = paramiko.RSAKey.from_private_key_file(KEYPATH)
    client = paramiko.SSHClient()
    client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    try:
        client.connect(hostname = host, username = "root", pkey = key)
    except:
        cquit(Status.DOWN, 'Connection error')


    stdin, stdout, stderr = client.exec_command("cat {} | grep {}".format(flagfile, flagid))
    lines = stdout.read().decode().strip().splitlines()
    client.close()

    for line in lines:
        line = line.split(":")
        if line[0]==flagid:
            if line[1] == flag:cquit(Status.OK)
            cquit(Status.CORRUPT)
    
    cquit(Status.MUMBLE)
    


def check(host):

    if not subprocess.call(["ping", "-c", "2", host]): cquit(Status.OK)
    cquit(Status.DOWN)


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