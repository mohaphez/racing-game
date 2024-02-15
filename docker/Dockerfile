FROM php:8.0-cli

WORKDIR /app

COPY . /app/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-scripts --no-autoloader

RUN composer dump-autoload --optimize

CMD ["php", "src/index.php"]