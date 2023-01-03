FROM nanoninja/php-fpm:8.1

MAINTAINER Sergey Kozlov "hello@sergeykozlov.ru"


RUN docker-php-ext-install fileinfo

ADD . .

#ENTRYPOINT ["tail", "-f", "/dev/null"]
