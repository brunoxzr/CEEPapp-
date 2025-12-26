FROM php:8.3-fpm

# Dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql zip

# Diretório da aplicação
WORKDIR /var/www

# Copia arquivos
COPY . .

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Instala dependências
RUN composer install --no-dev --optimize-autoloader

# Permissões Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# Porta
EXPOSE 8080

# Start
CMD php artisan serve --host=0.0.0.0 --port=8080
