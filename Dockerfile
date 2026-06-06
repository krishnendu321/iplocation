FROM php:8.3-apache

COPY . /var/www/html/

RUN mkdir -p /var/www/html/logs && \
    chmod -R 777 /var/www/html/logs

EXPOSE 80