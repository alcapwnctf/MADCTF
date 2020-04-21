FROM pomomondreganto/forcad_base:latest

ADD ./docker_config/webapi/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ADD backend /app
ENTRYPOINT ["/entrypoint.sh"]