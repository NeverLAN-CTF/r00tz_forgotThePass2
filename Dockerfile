FROM richarvey/nginx-php-fpm

MAINTAINER Zane Durkin <zane@zemptech.com>

RUN \
    apk update && \
    apk add mariadb && \
    apk add mariadb-client && \
    apk add mariadb-dev && \
    apk add openssl

RUN echo "[include]" >> /etc/supervisord.conf && \
    echo "files = /etc/supervisor/conf.d/*.conf" >> /etc/supervisord.conf

COPY other/mysql.conf /etc/supervisor/conf.d/

RUN \
    export MYSQL_PASS=$(openssl rand -hex 100) && \
    echo $MYSQL_PASS > /root/pass_root && \
    export MYSQL_PASS=$(openssl rand -hex 100) && \
    echo $MYSQL_PASS > /root/pass_web

COPY other/db.sql /root/db.sql

RUN \
    sed -i 's/<password_web>/'$(cat /root/pass_web)'/g' /root/db.sql && \
    sed -i 's/<password_root>/'$(cat /root/pass_root)'/g' /root/db.sql

RUN \
    mysql_install_db --user=mysql && \
    /bin/bash -c "usr/bin/mysqld_safe &" && \
    sleep 5 && \
    mysql -u root  < /root/db.sql

RUN \
    sed -i 's/mysqli.default_socket=/mysqli.default_socket=\/run\/mysqld\/mysqld.sock/' /etc/php5/conf.d/php.ini && \
    rm /var/www/html/*

COPY web /var/www/html

# set up php file with password
RUN sed -i 's/<password_web>/'$(cat /root/pass_web)'/g' /var/www/html/db.php

RUN \
    rm /root/db.sql && \
    rm /root/pass_web && \
    rm /root/pass_root

