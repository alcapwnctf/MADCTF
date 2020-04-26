#!/usr/bin/env python3

import os
import traceback

import argparse
import shutil
import subprocess
import time
import yaml

BASE_DIR = os.path.dirname(os.path.abspath(__file__))
CONFIG_DIR = os.path.join(BASE_DIR, 'backend', 'config')
DOCKER_COMPOSE_FILE = 'docker-compose.yml'

CONFIG_FILENAME = 'config.yml'

def run_command(command, cwd=None, env=None):
    p = subprocess.Popen(command, cwd=cwd, env=env)
    rc = p.wait()
    if rc != 0:
        print('[-] Failed!')
        exit(1)


def setup_db(config):
    postgres_env_path = os.path.join(
        BASE_DIR,
        'environ',
        'postgres.env',
    )

    db_config = config['storages']['db']
    host = db_config['host']
    port = db_config['port']
    user = db_config['user']
    password = db_config['password']
    db = db_config['dbname']

    postgres_config = [
        "# THIS FILE IS MANAGED BY 'control.py'",
        f'POSTGRES_HOST={host}',
        f'POSTGRES_PORT={port}',
        f'POSTGRES_USER={user}',
        f'POSTGRES_PASSWORD={password}',
        f'POSTGRES_DB={db}',
    ]

    with open(postgres_env_path, 'w') as f:
        f.write('\n'.join(postgres_config))


def setup_redis(config):
    redis_env_path = os.path.join(
        BASE_DIR,
        'environ',
        'redis.env',
    )

    redis_config = config['storages']['redis']
    host = redis_config.get('host', 'redis')
    port = redis_config.get('port', 6379)
    password = redis_config.get('password', None)

    redis_config = [
        "# THIS FILE IS MANAGED BY 'control.py'",
        f'REDIS_HOST={host}',
        f'REDIS_PORT={port}',
        f'REDIS_PASSWORD={password}',
    ]

    with open(redis_env_path, 'w') as f:
        f.write('\n'.join(redis_config))


def setup_flower(config):
    flower_env_path = os.path.join(
        BASE_DIR,
        'environ',
        'celery.env',
    )

    flower_config = config['flower']
    flower_username = flower_config['username']
    flower_password = flower_config['password']
    flower_config = [
        "# THIS FILE IS MANAGED BY 'control.py'",
        f'FLOWER_BASIC_AUTH={flower_username}:{flower_password}',
    ]

    with open(flower_env_path, 'w') as f:
        f.write('\n'.join(flower_config))


def setup_rabbitmq(config):
    rabbitmq_env_path = os.path.join(
        BASE_DIR,
        'environ',
        'rabbitmq.env',
    )

    rabbitmq_config = config['storages']['rabbitmq']
    host = rabbitmq_config.get('host', 'rabbitmq')
    port = rabbitmq_config.get('port', 5672)
    user = rabbitmq_config['user']
    password = rabbitmq_config['password']
    vhost = rabbitmq_config['vhost']

    rabbitmq_config = [
        "# THIS FILE IS MANAGED BY 'control.py'",
        f'RABBITMQ_HOST={host}',
        f'RABBITMQ_PORT={port}',
        f'RABBITMQ_DEFAULT_USER={user}',
        f'RABBITMQ_DEFAULT_PASS={password}',
        f'RABBITMQ_DEFAULT_VHOST={vhost}',
    ]

    with open(rabbitmq_env_path, 'w') as f:
        f.write('\n'.join(rabbitmq_config))


def setup_config(_args):
    conf_path = os.path.join(CONFIG_DIR, CONFIG_FILENAME)
    config = yaml.load(open(conf_path), Loader=yaml.FullLoader)
    setup_db(config)
    setup_redis(config)
    setup_flower(config)
    setup_rabbitmq(config)


def setup_worker(args):
    conf_path = os.path.join(CONFIG_DIR, CONFIG_FILENAME)
    config = yaml.load(open(conf_path), Loader=yaml.FullLoader)

    # create config backup
    backup_path = os.path.join(CONFIG_DIR, f'config_backup_{int(time.time())}.yml')
    with open(backup_path, 'w') as f:
        yaml.dump(config, f)

    # patch config host variables to connect to the right place
    config['storages']['redis']['host'] = args.redis
    config['storages']['db']['host'] = args.database
    config['storages']['rabbitmq']['host'] = args.rabbitmq

    with open(conf_path, 'w') as f:
        yaml.dump(config, f)

    setup_config(args)


def print_tokens(_args):
    res = subprocess.check_output(
        ['docker-compose', '-f', DOCKER_COMPOSE_FILE, 'exec', 'webapi', 'python3', '/app/scripts/print_tokens.py'],
        cwd=BASE_DIR,
    )

    print(res.decode().strip())


def print_file_exception_info(_func, path, _exc_info):
    print(f'File {path} not found')


def reset_game(_args):
    data_path = os.path.join(BASE_DIR, 'docker_volumes/postgres/data')
    shutil.rmtree(data_path, onerror=print_file_exception_info)

    run_command(
        ['docker-compose', '-f', DOCKER_COMPOSE_FILE, 'down', '-v', '--remove-orphans'],
        cwd=BASE_DIR,
    )


def build(_args):
    run_command(
        ['docker-compose', '-f', DOCKER_COMPOSE_FILE, 'build'],
        cwd=BASE_DIR,
    )


def start_game(args):
    command = [
        'docker-compose', '-f',
        DOCKER_COMPOSE_FILE,
        'up', '--build', '--no-recreate', '-d',
        '--scale', f'celery={args.instances}',
    ]
    run_command(command, cwd=BASE_DIR)


def scale_celery(args):
    command = [
        'docker-compose',
        '-f', DOCKER_COMPOSE_FILE,
        'up', '-d',
        '--no-recreate',
        '--no-build',
        '--scale', f'celery={args.instances}',
        'celery',
    ]
    run_command(command, cwd=BASE_DIR)


def run_worker(args):
    # patch configuration
    setup_worker(args)

    command = [
        'docker-compose', '-f',
        DOCKER_COMPOSE_FILE,
        'up', '--build', '-d',
        '--scale', f'celery={args.instances}',
        'celery',
    ]
    run_command(command, cwd=BASE_DIR)


if __name__ == '__main__':
    parser = argparse.ArgumentParser(description='Control ForcAD')
    subparsers = parser.add_subparsers()

    setup_parser = subparsers.add_parser('setup', help='Transfer centralized config to environment files')
    setup_parser.set_defaults(func=setup_config)

    print_tokens_parser = subparsers.add_parser('print_tokens', help='Print team tokens')
    print_tokens_parser.set_defaults(func=print_tokens)

    reset_parser = subparsers.add_parser('reset', help='Reset the game & cleanup')
    reset_parser.set_defaults(func=reset_game)
    reset_parser.add_argument('-f', '--fast', action='store_true', help='Use faster build compose file')

    build_parser = subparsers.add_parser('build', help='Build the images, don\'t run')
    build_parser.set_defaults(func=build)
    build_parser.add_argument('-f', '--fast', action='store_true', help='Use faster build with prebuilt images')

    start_parser = subparsers.add_parser('start', help='Start the forcad, building if necessary (with cache)')
    start_parser.set_defaults(func=start_game)
    start_parser.add_argument('-f', '--fast', action='store_true', help='Use faster build with prebuilt images')
    start_parser.add_argument('-i', '--instances', type=int, metavar='N', default=1,
                              help='Number of celery worker instances', required=False)

    scale_celery_parser = subparsers.add_parser('scale_celery', help='Scale the number of celery worker containers')
    scale_celery_parser.set_defaults(func=scale_celery)
    scale_celery_parser.add_argument('-i', '--instances', type=int, metavar='N',
                                     help='Number of celery worker instances', required=True)

    worker_parser = subparsers.add_parser('worker', help='Start the celery workers only')
    worker_parser.set_defaults(func=run_worker)
    worker_parser.add_argument('-i', '--instances', type=int, metavar='N', default=1,
                               help='Number of celery worker instances', required=False)
    worker_parser.add_argument('-f', '--fast', action='store_true', help='Use faster build with prebuilt images')
    worker_parser.add_argument('--redis', type=str,
                               help='Redis address for the worker to connect', required=True)
    worker_parser.add_argument('--rabbitmq', type=str,
                               help='RabbitMQ address for the worker to connect', required=True)
    worker_parser.add_argument('--database', type=str,
                               help='PostgreSQL address for the worker to connect', required=True)

    parsed = parser.parse_args()

    try:
        parsed.func(parsed)
    except Exception as e:
        tb = traceback.format_exc()
        print('Got exception:', e, tb)
        exit(1)
