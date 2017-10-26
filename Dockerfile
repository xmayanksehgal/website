FROM php:5.6-apache


RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install -y \
    && apt-get install curl  php5-cli git -y \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get install php5-gd -y

RUN curl --silent --location https://deb.nodesource.com/setup_4.x | bash -
RUN apt-get install --yes nodejs
RUN apt-get install --yes build-essential

ADD . /var/www/skills-project/
WORKDIR /var/www/skills-project/

RUN composer install --ignore-platform-reqs
RUN npm install -g grunt-cli
RUN npm install
RUN grunt --force



EXPOSE 80
RUN chmod a+rwx -R /var/www/skills-project
COPY apache-config.conf /etc/apache2/sites-enabled/000-default.conf
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf


CMD /usr/sbin/apache2ctl -D FOREGROUND
