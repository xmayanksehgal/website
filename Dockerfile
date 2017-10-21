FROM php:7.0-apache


RUN apt-get update && \
    apt-get install curl  php5-cli git -y && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
    
RUN curl --silent --location https://deb.nodesource.com/setup_4.x | bash -
RUN apt-get install --yes nodejs
RUN apt-get install --yes build-essential

COPY . /var/www/skills-project/
WORKDIR /var/www/skills-project/

RUN composer install
RUN npm install
RUN grunt --force