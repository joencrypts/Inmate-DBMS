FROM php:8.1-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configure Apache
RUN a2enmod rewrite
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Create directory for Apache configuration
RUN mkdir -p /etc/apache2/sites-enabled

# Enable the site
RUN a2ensite 000-default.conf

# Create a simple index.php if it doesn't exist
RUN if [ ! -f /var/www/html/index.php ]; then \
    echo '<?php phpinfo(); ?>' > /var/www/html/index.php; \
    fi

# Expose port
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-ctl", "-D", "FOREGROUND"] 