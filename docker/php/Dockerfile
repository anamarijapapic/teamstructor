FROM php:8.2-fpm-bullseye

# Copy php-extension-installer script for easy installation of PHP extensions

COPY --from=mlocati/php-extension-installer:2.1.28 /usr/bin/install-php-extensions /usr/local/bin/

# install the PHP extensions we need

RUN install-php-extensions zip gd xdebug opcache pdo_mysql bcmath exif

# install PHP composer

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_VERSION 2.5.8
ENV COMPOSER_HOME /var/www/.composer

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer --version=${COMPOSER_VERSION} \
    && composer --ansi --version --no-interaction

# copy certificate authority

COPY ./certificate-authority/certificate.cert /usr/local/share/ca-certificates/certificate.crt
RUN update-ca-certificates

# add config overrides

COPY zz-php.ini $PHP_INI_DIR/conf.d/zz-php.ini
COPY zz-www.conf /usr/local/etc/php-fpm.d/zz-www.conf
COPY zz-xdebug.ini $PHP_INI_DIR/conf.d/zz-xdebug.ini
COPY zz-opcache.ini $PHP_INI_DIR/conf.d/zz-opcache.ini
