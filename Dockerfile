# Используем базовый образ с PHP
FROM yiisoftware/yii2-php:8.1-fpm

# Копируем файлы приложения
COPY . /app

# Настройка прав доступа
WORKDIR /app
RUN chown -R www-data:www-data .

# Установка зависимостей через Composer
WORKDIR /app/backend
RUN composer install --prefer-dist --no-progress --no-interaction

# Экспортируем порт 9000 для PHP-FPM
EXPOSE 9000

# Запускаем Yii2 приложение с помощью composer serve
CMD ["composer", "serve"]