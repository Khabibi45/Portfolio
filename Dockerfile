# Use the official PHP image with Apache
FROM php:8.2-apache

# Enable mod_rewrite for clean URLs (if needed)
RUN a2enmod rewrite

# Copy project files to the container
COPY . /var/www/html/

# Set file permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80
