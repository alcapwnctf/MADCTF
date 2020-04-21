FROM pomomondreganto/forcad_base:latest

ADD ./docker_config/initializer/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ADD backend /app

ENTRYPOINT ["/entrypoint.sh"]