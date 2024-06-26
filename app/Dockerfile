FROM dunglas/frankenphp:1.1.0

#Base dependencies
RUN apt-get -y update && apt-get -y install \
    git \
    zip \
    curl \
    unzip \
    libicu-dev \
    zlib1g-dev \
    g++ \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/* \
    && apt-get -y autoremove

#Symfony CLI
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash \
    && apt install symfony-cli


#PHP Configuration
RUN pecl install xdebug \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo_pgsql opcache intl \
    && docker-php-ext-enable pdo_pgsql opcache xdebug \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

#Composer installation
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


WORKDIR /app

#Set the caddyfile
COPY ../caddy/Caddyfile /etc/caddy/Caddyfile

#Get the composer files
#COPY composer.json composer.lock .env /app/
#COPY bin/console /app/bin/

#Composer dependencies
ENV COMPOSER_ALLOW_SUPERUSER=1
#RUN composer install


#Copy the project files
COPY .. /app

EXPOSE 7070