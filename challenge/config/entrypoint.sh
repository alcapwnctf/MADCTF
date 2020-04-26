#!/bin/sh

/usr/sbin/sshd
/etc/init.d/xinetd start
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf