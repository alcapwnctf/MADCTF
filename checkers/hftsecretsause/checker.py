#!/usr/local/bin/python3

import paramiko, sys, os, random, subprocess, time
from checklib import *
from math import ceil
from Crypto.Cipher import AES
from binascii import hexlify, unhexlify

SLA_FILENAME = "/home/crackme/hftSecretSause_FLAG_dont_delete"
BASE_DIR = os.path.abspath(os.path.dirname(__file__))
KEYPATH=BASE_DIR+"/rootkey"
DICTIONARY=BASE_DIR+"/dictionary"

def choosePasswordFromDictionary(seed):
    random.seed(seed)
    return random.choice(open(DICTIONARY).read().splitlines())

def padText(text):
    text += "\x00"*(ceil(len(text)/16)*16-len(text))
    assert len(text)%16==0
    return text.encode()

def put(host, flagid, flag, vuln):

    password = choosePasswordFromDictionary(flagid)
    encryptedFlag = hexlify(AES.new(password[:16].encode(), AES.MODE_ECB).encrypt(padText(flag))).decode()
    
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


    commands = ["echo crackme:{} | chpasswd".format(password), "echo {}:{} >> {}".format(flagid, encryptedFlag, SLA_FILENAME), "chown -R crackme:crackme {}".format(SLA_FILENAME), "chmod 600 {}".format(SLA_FILENAME)]
    for command in commands:
        client.exec_command(command)
        
    client.close()
    cquit(Status.OK, flagid)


def get(host, flagid, flag, vuln):

    password = choosePasswordFromDictionary(flagid)

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


    stdin, stdout, stderr = client.exec_command("cat {}".format(SLA_FILENAME))
    lines = stdout.read().decode().strip().splitlines()
    client.close()

    for line in lines:
        line = line.split(":")
        if line[0]==flagid:
            if AES.new(password[:16].encode(), AES.MODE_ECB).decrypt(unhexlify(line[1])).decode().rstrip("\x00") == flag:cquit(Status.OK)
            cquit(Status.CORRUPT)
    
    cquit(Status.MUMBLE)


def check(host):

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


    stdin, stdout, stderr = client.exec_command("test -d {} && echo Found".format(SLA_FILENAME.split("/")[0]))
    lines = stdout.read().decode().strip().splitlines()
    client.close()

    if len(lines) == 0:
        cquit(Status.MUMBLE)

    for line in lines:
        if "Found" not in line:
            cquit(Status.MUMBLE)

    cquit(Status.OK)


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