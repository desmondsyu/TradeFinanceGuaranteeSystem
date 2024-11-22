# Use PHP 8.2 with Nginx for production
FROM php:8.2-fpm

# Set the working directory
WORKDIR /var/www

# Install system dependencies, MySQL PDO extension, and Node.js 20.x
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql \
    && apt-get clean

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js 20.x and npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# Copy application files to the container
COPY . .

# Set the correct permissions for Laravel storage and cache directories
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage /var/www/bootstrap/cache

# Install PHP dependencies, including Laravel Breeze
RUN composer install --no-dev --optimize-autoloader

# Install Laravel Breeze for authentication scaffolding
RUN composer require laravel/breeze --dev && \
    php artisan breeze:install blade

# Install Node.js dependencies
RUN npm install

#Installs tailwindcss, postcss, and autoprefixer using npm
RUN npm install \
    tailwindcss \
    postcss \
    autoprefixer && \
    npx tailwindcss init

# Adjust permissions for node_modules to allow execution of Vite
RUN chmod -R 755 node_modules

# Compile assets using Vite
RUN npm run build

# Clear and cache configurations, routes, and views for better performance
RUN php artisan config:clear && php artisan config:cache
RUN php artisan route:clear && php artisan route:cache
RUN php artisan view:clear && php artisan view:cache

# Ensure the Laravel storage and cache directories are writable
RUN chmod -R 775 storage bootstrap/cache

# Serve the application on 0.0.0.0 to make it accessible from outside the container
CMD supervisord -c /etc/supervisor/conf.d/supervisord.conf

# Expose port 8000
EXPOSE 8000
