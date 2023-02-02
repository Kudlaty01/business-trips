FROM php:8.2.1-fpm-alpine

RUN apk add --update linux-headers
RUN apk add --no-cache pcre-dev ${PHPIZE_DEPS} \
    git \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug \
  ;

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY docker/php/php.ini /usr/local/etc/php/php.ini

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

# fix xdebug log error permission
RUN touch /var/log/xdebug.log; \
    chmod 666 /var/log/xdebug.log

CMD ["php-fpm"]