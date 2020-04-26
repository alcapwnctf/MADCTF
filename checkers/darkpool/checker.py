#!/usr/local/bin/python3

import telnetlib, sys, time
from checklib import *

PORT=1337

def put(host, flagid, flag, vuln):
    try:
        tn = telnetlib.Telnet(host,PORT)
    except:
        time.sleep(2)
        try:
            tn = telnetlib.Telnet(host,PORT)
        except:
            cquit(Status.DOWN, "SecretService down for {}".format(host))
    
    tn.read_until(b"> ")
    tn.write(b"A\n")
    tn.read_until(b"> ")
    tn.write(flagid.encode()+b"\n")
    tn.read_until(b"> ")
    tn.write(flag.encode()+b"\n")
    data = tn.read_until(b"\n").decode().strip().split()
    tn.write(b"E\n")
    tn.close()
    if data[0] == "Flag" and data[-1] == flagid:cquit(Status.OK)
    cquit(Status.MUMBLE)


def get(host, flagid, flag, vuln):
    try:
        tn = telnetlib.Telnet(host,PORT)
    except:
        time.sleep(2)
        try:
            tn = telnetlib.Telnet(host,PORT)
        except:
            cquit(Status.DOWN, "SecretService down for {}".format(host))
    
    tn.read_until(b"> ")
    tn.write(b"R\n")
    tn.read_until(b"> ")
    tn.write(flagid.encode()+b"\n")
    tn.read_until(b"\n")
    data = tn.read_until(b"\n").decode().strip().split()
    tn.write(b"E\n")
    tn.close()
    if data[1] == flag:cquit(Status.OK)
    cquit(Status.MUMBLE)

def check(host):
    try:
        tn = telnetlib.Telnet(host,PORT)
    except:
        time.sleep(2)
        try:
            tn = telnetlib.Telnet(host,PORT)
        except:
            cquit(Status.DOWN, "SecretService down for {}".format(host))

    data = list()
    for x in tn.read_until(b"> ").decode().strip().split('\n'):data+=x.split()
    tn.write(b"E\n")
    tn.close()

    if "secret" in data and "flag" in data and "Retrieve" in data:cquit(Status.OK)
    cquit(Status.MUMBLE)



if __name__ == '__main__':
    action, *args = sys.argv[1:]
    if action == "check":
        host, = args
        check(host)
    elif action == "get":
        host, flag_id, flag, vuln = args
        get(host, flag_id, flag, vuln)
    elif action == "put":
        host, flag_id, flag, vuln = args
        put(host, flag_id, flag, vuln)
    else:
        cquit(Status.ERROR, 'System error', 'Unknown action: ' + action)