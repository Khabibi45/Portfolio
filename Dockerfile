# Use the official PHP image with Apache
FROM php:8.2-apache

# Enable mod_rewrite for clean URLs
RUN a2enmod rewrite

# Install system dependencies if needed (optional for basic PHP)
# RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev && docker-php-ext-install gd

# Configure PHP for production logging
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN echo "log_errors = On" >> "$PHP_INI_DIR/php.ini"
RUN echo "error_log = /dev/stderr" >> "$PHP_INI_DIR/php.ini"

# Copy project files to the container
COPY . /var/www/html/

# Set file permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80
