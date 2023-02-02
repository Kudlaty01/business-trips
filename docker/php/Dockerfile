FROM php:8.2.1-fpm-alpine

RUN apk add --no-cache git

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN set -eux; \
	composer clear-cache
ENV PATH="${PATH}:/root/.composer/vendor/bin"

RUN docker-php-ext-install -j$(nproc) \
    mysqli \
    pdo_mysql \
    ;


WORKDIR /application
COPY composer.json composer.lock ./
RUN set -eux; \
	mkdir -p /application/var/cache/dev /application/var/log; \
    chmod -R 777 var/cache var/log; \
	composer dump-autoload --classmap-authoritative --no-dev; \
    ls


CMD ["php-fpm"]