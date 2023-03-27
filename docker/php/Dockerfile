FROM php:8.2-fpm-bullseye

# Copy php-extension-installer script for easy installation of PHP extensions

COPY --from=mlocati/php-extension-installer:1.4.8 /usr/bin/install-php-extensions /usr/local/bin/

# install the PHP extensions we need

RUN install-php-extensions zip gd xdebug opcache pdo_mysql redis bcmath

# install PHP composer

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_VERSION 2.5.4
ENV COMPOSER_HOME /var/www/.composer

RUN curl -s -f -L -o /tmp/installer.php https://raw.githubusercontent.com/composer/getcomposer.org/baa8937c704cdbf8982a2456f939363b82da0985/web/installer \
    && php -r " \
        \$signature = '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8'; \
        \$hash = hash('SHA384', file_get_contents('/tmp/installer.php')); \
        if (!hash_equals(\$signature, \$hash)) { \
            unlink('/tmp/installer.php'); \
            echo 'Integrity check failed, installer is either corrupt or worse.' . PHP_EOL; \
            exit(1); \
        }" \
    && php /tmp/installer.php --no-ansi --install-dir=/usr/bin --filename=composer --version=${COMPOSER_VERSION} \
    && composer --ansi --version --no-interaction

# copy certificate authority

COPY ./certificate-authority/certificate.cert /usr/local/share/ca-certificates/certificate.crt
RUN update-ca-certificates

# add config overrides

COPY zz-php.ini $PHP_INI_DIR/conf.d/zz-php.ini
COPY zz-www.conf /usr/local/etc/php-fpm.d/zz-www.conf
COPY zz-xdebug.ini $PHP_INI_DIR/conf.d/zz-xdebug.ini
COPY zz-opcache.ini $PHP_INI_DIR/conf.d/zz-opcache.ini
