FROM php:8-fpm

RUN  --mount=type=bind,from=mlocati/php-extension-installer:latest,source=/usr/bin/install-php-extensions,target=/usr/local/bin/install-php-extensions \
    apt-get update \
    && apt-get install -y --no-install-recommends poppler-utils git libpq-dev \
    && install-php-extensions  pdo_pgsql pgsql xdebug \
#    && install-php-extensions pcov xdebug \
    && apt-get clean && apt-get autoremove -y

COPY .docker/app/php.ini $PHP_INI_DIR/conf.d/
