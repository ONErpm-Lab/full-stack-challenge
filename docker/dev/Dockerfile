FROM openswoole/openswoole:25.2-php8.4-alpine

RUN apk add --no-cache redis libzip-dev libpng-dev bash curl nano supervisor nginx nodejs npm

RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql \
&& docker-php-ext-enable opcache \
&& pecl install redis && docker-php-ext-enable redis \
&& docker-php-ext-install pdo_mysql zip gd pcntl

RUN echo "* * * * * php /var/www/artisan schedule:run >> /dev/null 2>&1" >> /etc/crontabs/root

WORKDIR /var/www
COPY . .
COPY ./docker/php.ini /usr/local/etc/php/conf.d/php-custom.ini
COPY ./docker/nginx.conf /etc/nginx/http.d/localhost.conf
COPY ./docker/dev/worker.ini /etc/supervisor.d/worker-custom.ini

EXPOSE 8000

CMD ["sh", "-c", "supervisord -n -c /etc/supervisord.conf"]