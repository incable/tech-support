# Working Docker file to host a sample static web page
FROM php:7.2-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
COPY support-master/ /var/www/html/
WORKDIR /var/www/html
RUN ls -la /var/www/html/
EXPOSE 80