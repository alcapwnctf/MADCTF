FROM pomomondreganto/forcad_base:latest

ADD ./docker_config/gevent_flag_submitter/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ADD backend /app

ENTRYPOINT ["/entrypoint.sh"]