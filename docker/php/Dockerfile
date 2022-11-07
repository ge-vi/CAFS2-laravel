FROM php:8.1.11-fpm-alpine3.16

RUN apk update \
	apk upgrade

RUN apk add bash

#RUN apk add nodejs npm

RUN apk add --update \
		$PHPIZE_DEPS \
		freetype-dev \
		git \
		libjpeg-turbo-dev \
		libpng-dev \
	&& docker-php-ext-configure gd --with-jpeg --with-freetype \
	&& docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql

COPY ./conf/* /usr/local/etc/php/conf.d

# https://getcomposer.org/doc/00-intro.md#docker-image
COPY --from=composer/composer /usr/bin/composer /usr/bin/composer
