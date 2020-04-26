#!/usr/bin/python3

import mysql.connector, subprocess, string, random, sys, os, yaml, time
from pathlib import Path

TEAMNAMES = list()
ROOTPASSWORD = ""
CWD=""
DBIP=""
EXCLUDED = ["db","traefik","teampage","webapi","nginx","redis","postgres","flower","rabbitmq","initializer","gevent_flag_submitter","celery","celerybeat"]

def genPassword(size=20):
    letters = string.ascii_letters+string.digits
    return ''.join(random.choice(letters) for i in range(size))

def getOutput(command):
    process = subprocess.Popen(command, stdout=subprocess.PIPE)
    stdout = process.communicate()[0]
    return str(stdout.strip().decode()[1:-1]), process.returncode

def deleteAllUsers(dbName, teamList=TEAMNAMES):
    mydb = mysql.connector.connect(
        host = DBIP,
        user="root",
        passwd=ROOTPASSWORD
    )
    cursor = mydb.cursor()

    cursor.execute("SELECT user FROM mysql.user WHERE user NOT LIKE 'root' AND user NOT LIKE 'gameserver';")
    
    users=list()

    for userTuple in cursor:
        user=userTuple[0]
        users.append(user)
    
    for user in users:
        cursor.execute("DROP USER '{}'@'%';".format(user))
        cursor.execute("DROP database {};".format(user))
        print("Deleted {}".format(user))
    
    print("Deleted all users")


def addAllUsers(name, teamList=TEAMNAMES):
    mydb = mysql.connector.connect(
        host = DBIP,
        user="root",
        passwd=ROOTPASSWORD
    )
    cursor = mydb.cursor()
    
    for team in teamList:
        password = genPassword()
        cursor.execute("CREATE USER '{}'@'%' IDENTIFIED BY '{}';".format(team, password))
        cursor.execute("CREATE DATABASE {}".format(team))
        cursor.execute("GRANT INSERT, SELECT, UPDATE ON {}.* TO '{}'@'%'".format(team,team))
        cursor.execute("USE {};".format(team))
        cursor.execute("CREATE TABLE flag (id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, flag TEXT DEFAULT NULL, flagid TEXT DEFAULT NULL);")
        cursor.execute("CREATE TABLE talking (id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, username varchar(255) NOT NULL, query TEXT NOT NULL, filename TEXT NOT NULL, type varchar(255) NOT NULL);")

        cursor.execute("CREATE TABLE trade_events (id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, creation_time DATETIME DEFAULT CURRENT_TIMESTAMP, player_id int(11) NOT NULL, ticker varchar(255) NOT NULL, type varchar(255) NOT NULL, value FLOAT NOT NULL);")

        cursor.execute("CREATE TABLE stonks (id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, ticker varchar(255) NOT NULL UNIQUE, name TEXT NOT NULL, value FLOAT NOT NULL);")
        cursor.execute("""INSERT INTO stonks (ticker, name, value) VALUES("AAPL", "Apple Inc.", 300);""")
        cursor.execute("""INSERT INTO stonks (ticker, name, value) VALUES("GOOG", "Alphabet Inc.", 1300);""")
        cursor.execute("""INSERT INTO stonks (ticker, name, value) VALUES("TSLA", "Tesla Inc.", 700);""")
        cursor.execute("""INSERT INTO stonks (ticker, name, value) VALUES("MSFT", "Microsoft Corporation", 170);""")
        cursor.execute("""INSERT INTO stonks (ticker, name, value) VALUES("AMZN", "Amazon.com Inc.", 2400);""")
        cursor.execute("""INSERT INTO stonks (ticker, name, value) VALUES("JNJ", "Johnson & Johnson", 150);""")
        cursor.execute("""INSERT INTO stonks (ticker, name, value) VALUES("FB", "Facebook Inc.", 180);""")
        cursor.execute("""INSERT INTO stonks (ticker, name, value) VALUES("JPM", "JPMorgan Chase & Co", 90);""")
        
        cursor.execute("CREATE TABLE login (id int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT, name varchar(255) NOT NULL, username varchar(255) NOT NULL, status varchar(255) NOT NULL, ip varchar(255) NOT NULL, time varchar(255) NOT NULL);")
        cursor.execute("CREATE TABLE players (id int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT, name varchar(800) NOT NULL, username varchar(800) NOT NULL, password varchar(800) NOT NULL, email varchar(800) DEFAULT NULL, money int NOT NULL, usertype int(255) NOT NULL, ip varchar(800) NOT NULL, creation_date DATETIME DEFAULT CURRENT_TIMESTAMP);")
        print("Added {}:{}".format(team,password))
        with open("{}/environ/{}.env".format(os.getcwd(),team),"w") as f:
            f.write('''DBUSER={}\nDBPASS={}\nDBHOST=db\nDBNAME={}\n'''.format(team,password,team))
    
    cursor.close()
    print("Generated all users")

def initDB():
    getOutput(["docker-compose","up","--detach","--no-recreate", "db"])

if __name__ == "__main__":

    yamlfile=yaml.load(open("docker-compose.yml"), Loader=yaml.FullLoader)

    ROOTPASSWORD=yamlfile['services']['db']['environment'][0].split("=")[1]
    dbCntrName=yamlfile['services']['db']['container_name']
    CWD = os.getcwd()

    try:
        os.mkdir("{}/environ".format(CWD))
    except:
        pass

    for key in yamlfile['services']:
        if key not in EXCLUDED:
            TEAMNAMES.append(key)
            if not os.path.isfile("{}/environ/{}.env".format(CWD,key)):Path("{}/environ/{}.env".format(CWD,key)).touch()


    getOutput(["python3", "control.py", "setup"])
    getOutput(["docker-compose", "up", "--detach", "--no-recreate", "db"])
    DBIP, r = getOutput(["docker", "inspect", "-f", "'{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}'", dbCntrName])
    print("Got DB IP as {}".format(DBIP))
    print("Waiting for database to be ready")
    while True:
        o, r = getOutput(["mysqladmin","ping","-h", DBIP, "--silent"])
        if r==0:
            break
        time.sleep(1)
    print("Database is ready")
    
    
    deleteAllUsers(dbCntrName)
    addAllUsers(dbCntrName)
    getOutput(["docker-compose", "up", "--detach", "--remove-orphans"] + TEAMNAMES)