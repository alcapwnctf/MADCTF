PYTHON=/usr/bin/env python3

all: build

build: setup
	${PYTHON} control.py start


setup: challenges
	${PYTHON} setup.py docker-compose.yml

challenges:
	gcc -o ./challenge/secretservice/secretservice ./challenge/secretservice/secretservice.c 

build-team-containers: challenges
	docker-compose build team1

clean:
	docker-compose stop
	docker-compose rm

kill-clean:
	docker-compose kill
	docker-compose rm