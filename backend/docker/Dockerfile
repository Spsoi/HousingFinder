# Используйте официальный образ PHP Alpine в качестве базового образа
FROM php:alpine

# Установка дополнительных зависимостей, которые вам могут понадобиться для вашего проекта
RUN apk update && apk add --no-cache \
    git \
    zip \
    unzip

# Установка расширений PHP, которые ваш проект требует
RUN docker-php-ext-install pdo pdo_mysql

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Копирование файлов вашего проекта в контейнер
COPY . /var/www/html

# Установка рабочей директории контейнера
WORKDIR /var/www/html

# Установка зависимостей из composer.json
RUN composer install --no-scripts --no-autoloader
# RUN chown -R www-data:www-data storage/
# RUN chmod -R 777 storage/

# Запуск веб-сервера PHP для обслуживания вашего приложения
CMD ["php", "-S", "0.0.0.0:80"]