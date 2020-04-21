#!/usr/bin/python3

import mysql.connector, subprocess, string, random, sys, os, yaml, time
from pathlib import Path

TEAMNAMES = list()
ROOTPASSWORD = ""
CWD=""
DBIP=""
EXCLUDED = ["db","traefik","webapi","nginx","redis","postgres","flower","rabbitmq","initializer","gevent_flag_submitter","celery","celerybeat"]

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
        user=userTuple[0].decode()
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
        cursor.execute("CREATE TABLE levels (id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, level int(11) NOT NULL, question varchar(255) NOT NULL, answer varchar(800) NOT NULL, image varchar(255) NOT NULL, html varchar(255) DEFAULT NULL, description varchar(255) NOT NULL, hint varchar(800) NOT NULL);")
        cursor.execute("CREATE TABLE login (id int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT, name varchar(255) NOT NULL, username varchar(255) NOT NULL, status varchar(255) NOT NULL, ip varchar(255) NOT NULL, time varchar(255) NOT NULL);")
        cursor.execute("CREATE TABLE players (id int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT, uid int(255) NOT NULL, name varchar(800) NOT NULL, username varchar(800) NOT NULL, password varchar(800) NOT NULL, email varchar(800) DEFAULT NULL, level int(255) NOT NULL, status int(255) NOT NULL, usertype int(255) NOT NULL, ip varchar(800) NOT NULL, time varchar(800) NOT NULL);")
        cursor.execute("CREATE TABLE status (id int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT, status int(255) NOT NULL);")
        cursor.execute("CREATE TABLE submits (id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, name varchar(255) NOT NULL, username varchar(255) NOT NULL, answer varchar(255) NOT NULL, level varchar(255) NOT NULL, status varchar(255) NOT NULL, ip varchar(255) NOT NULL, time varchar(255) NOT NULL);")
        print("Added {}:{}".format(team,password))
        with open("{}/environ/{}.env".format(os.getcwd(),team),"w") as f:
            f.write('''DBUSER={}\nDBPASS={}\nDBHOST=db\nDBNAME={}\n'''.format(team,password,team))
    
    cursor.close()
    print("Generated all users")

def initDB():
    getOutput(["docker-compose","up","--detach","--no-recreate", "db"])

if __name__ == "__main__":

    if len(sys.argv) < 2:
        print("Usage {} docker-compose.yml".format(sys.argv[0]))
        sys.exit(1)

    yamlfile=yaml.load(open(sys.argv[1]), Loader=yaml.FullLoader)

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
        time.sleep(5)
        print(".", end="")
        if r==0:
            break
    print("Database is ready")
    
    
    deleteAllUsers(dbCntrName)
    addAllUsers(dbCntrName)
    # getOutput(["docker-compose", "up", "--detach", "--no-recreate", "--remove-orphans"])