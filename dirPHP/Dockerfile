FROM nanoninja/php-fpm:8.1

MAINTAINER Sergey Kozlov "hello@sergeykozlov.ru"

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        imagemagick php-xml php-curl php-gd zip unzip php-zip php-xml php-curl php-gd \
    && docker-php-ext-configure gd imagick zip \
    && docker-php-ext-install -j$(nproc) gd imagick zip

RUN pecl install redis curl xml mbstring imagick gd imagick \
    && docker-php-ext-enable redis curl xml mbstring imagick gd imagick

RUN apt-get update \
	&& apt-get install -y \
		libfreetype6-dev \
		libpng-dev \
		libjpeg-dev \
	&& docker-php-ext-configure gd \
		--with-freetype-dir=/usr/include/ \
		--with-jpeg-dir=/usr/include/ \
		--with-png-dir=/usr/include/ \
	&& docker-php-ext-install -j$(nproc) \
		gd \
	&& apt-get purge -y \
		libfreetype6-dev \
		libpng-dev \
		libjpeg-dev

RUN apt-get update \
	&& apt-get install -y \
		libmagickwand-dev --no-install-recommends \
		ghostscript --no-install-recommends \
	&& pecl install \
		imagick \
	&& docker-php-ext-enable \
		imagick \
	&& apt-get purge -y \
		libmagickwand-dev

RUN docker-php-ext-install gd

RUN pecl install gd \
    && docker-php-ext-enable gd

#install some base extensions
RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-install zip

ADD . .

#ENTRYPOINT ["tail", "-f", "/dev/null"]
