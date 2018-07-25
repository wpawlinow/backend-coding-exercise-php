FROM php:7.2-fpm

LABEL maintainer="Wojciech Pawlinów"

WORKDIR /app

RUN apt-get update \
	&& apt-get install -y \
		libicu-dev \
		zip \
		gettext \
		libbz2-dev \
		bzip2 \
		libxml2-dev \
		zlib1g-dev \
		nginx

RUN docker-php-ext-configure \
        opcache \
	&& docker-php-ext-install \
	    opcache \
	    dom \
	    pdo \
	    gettext \
	    mbstring \
	    zip \
	    bz2 \
	    bcmath  \
	&& docker-php-ext-configure \
    	intl  \
	&& pecl install \
	    apcu \
	&& docker-php-ext-enable \
        apcu

RUN curl -sS https://getcomposer.org/installer | php \
	&& mv composer.phar /usr/local/bin/ \
	&& ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

RUN curl -OL https://phar.phpunit.de/phpunit.phar \
	&& chmod 755 phpunit.phar \
	&& mv phpunit.phar /usr/local/bin/ \
	&& ln -s /usr/local/bin/phpunit.phar /usr/local/bin/phpunit

COPY ./ /app

COPY ./docker/app/docker-php-entrypoint.sh /usr/local/bin/docker-php-entrypoint
RUN rm -rf /etc/nginx/sites-enabled/*
COPY ./docker/app/app-vhost.conf /etc/nginx/sites-enabled
RUN chmod +x /usr/local/bin/docker-php-entrypoint

RUN apt-get autoremove \
    && apt-get autoclean \
    && apt-get clean  \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

EXPOSE 80
