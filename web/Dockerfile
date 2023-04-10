FROM php:8.2-apache
LABEL maintainer="Atriox Banished atriox.banished@hotmail.com"
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get update && apt-get upgrade -y
