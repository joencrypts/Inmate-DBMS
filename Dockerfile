FROM php:8.1-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libjpeg-dev \
    libfreetype6-dev \
    default-mysql-client \
    default-mysql-server \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mysqli \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Configure PHP
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && echo "memory_limit=256M" >> "$PHP_INI_DIR/php.ini" \
    && echo "upload_max_filesize=64M" >> "$PHP_INI_DIR/php.ini" \
    && echo "post_max_size=64M" >> "$PHP_INI_DIR/php.ini" \
    && echo "max_execution_time=600" >> "$PHP_INI_DIR/php.ini"

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Install dependencies and optimize (if composer.json exists)
RUN if [ -f "composer.json" ]; then \
    composer install --no-interaction --no-dev --optimize-autoloader || true; \
    composer dump-autoload --optimize || true; \
    fi

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 storage

# Initialize MySQL and create database
RUN service mysql start \
    && mysql -e "CREATE DATABASE IF NOT EXISTS dbms_prison;" \
    && mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '';" \
    && mysql -e "FLUSH PRIVILEGES;"

# Expose port
EXPOSE 10000

# Start MySQL and PHP server
CMD service mysql start && php -S 0.0.0.0:10000 -t . router.php 