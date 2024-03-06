FROM php:7.4

WORKDIR /app
COPY . /app

RUN apt-get update && apt-get install -y zip unzip
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

RUN composer update

CMD ["./vendor/bin/phpunit"]