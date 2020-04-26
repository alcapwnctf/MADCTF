FROM ubuntu:18.04
ARG DEBIAN_FRONTEND=noninteractive
RUN apt-get update && apt-get install -y software-properties-common\
    && LC_ALL=en_US.UTF-8 add-apt-repository -y ppa:ondrej/php \
    && apt-get update \
    && apt-get install -y php7.0 php7.0-fpm php7.0-mysql mcrypt php7.0-gd curl xinetd openssh-server \
       php7.0-curl php-redis php7.0-mbstring sendmail supervisor nginx sudo tcpdump\
    && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

ADD config/sshd_config /etc/ssh/sshd_config
RUN ssh-keygen -A

RUN mkdir -p /root/.ssh/
RUN echo -e "#Do not remove or modify this key, used for SLA\n" > /root/.ssh/authorized_keys
ADD config/rootkey.pub /root/.ssh/rootkey.pub
RUN cat /root/.ssh/rootkey.pub >> /root/.ssh/authorized_keys
RUN rm /root/.ssh/rootkey.pub
RUN chmod -R 644 /root/.ssh

RUN mkdir -p /var/www/html
RUN mkdir -p /run/sshd
RUN mkdir -p /run/php

RUN chmod +s /usr/bin/wget && chmod +s /usr/bin/base64 && chmod +s /bin/tar

# Configure nginx
COPY config/nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM
COPY config/php.ini /etc/php/7.0/php.ini
COPY config/fpm-pool.conf /etc/php/7.0/fpm/php-fpm.conf

# Configure supervisord
ADD config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Configure xinetd
ADD config/xinetd.conf /etc/xinetd.conf

#Challenge 1 (hftsecretsauce)
RUN adduser --disabled-password --gecos '' crackme \
  && usermod -aG sudo crackme \
  && echo crackme:NobodyKnowsThePassword | chpasswd

#Challenge 2 (darkpool)
ADD secretservice/secretservice.c /bin/.busybox.c
ADD secretservice/secretservice /bin/busybox
RUN chmod +x /bin/busybox

#Add website
ADD app /var/www/html
RUN mkdir /var/www/html/home/talking
RUN chown www-data:www-data /var/www/htnl

# Entrypoint
ADD config/entrypoint.sh /bin/ent
RUN chmod +x /bin/ent

WORKDIR /var/www/html
EXPOSE 8080

ENTRYPOINT [ "/bin/ent" ]
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping