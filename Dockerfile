# Use the official PHP image
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www/html

# Copy files to the container
COPY . .

# Install dependencies
RUN apt-get update && \
    apt-get install -y \
        zip \
        unzip \
        libzip-dev && \
    docker-php-ext-install pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies
RUN composer install --no-scripts --no-autoloader

# Generate autoload files
RUN composer dump-autoload

# Expose port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
