FROM nanoninja/php-fpm:8.1

MAINTAINER Sergey Kozlov "hello@sergeykozlov.ru"


RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        imagemagick \
    && docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd


RUN apk add --update --upgrade --no-cache --virtual \
        imagemagick \
        imagemagick-dev

# this causes warning, but in my case is used to install some other extensions which I have removed from this example.
RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories

RUN printf "\n" | pecl install \
		imagick && \
		docker-php-ext-enable --ini-name 20-imagick.ini imagick

ADD https://github.com/mlocati/docker-php-extension-installer/releases/download/1.4.25/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \ 
		install-php-extensions gd xdebug

ADD . .

#ENTRYPOINT ["tail", "-f", "/dev/null"]
