FROM nginx:1.15.9-alpine

COPY ./docker_config/teamapp/conf/ /etc/nginx/conf.d/
COPY ./teamapp/frontend /var/www/front

CMD ["nginx", "-g", "daemon off;"]