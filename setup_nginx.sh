#!/bin/bash

# Nginx Setup Script for Debian/Ubuntu
# Project folder: teste_gui

set -e

echo "=========================================="
echo "Nginx Setup for Simple Web Dashboard"
echo "=========================================="
echo ""

# Update package list
echo "Updating package list..."
sudo apt-get update

# Install Nginx and PHP-FPM
echo "Installing Nginx and PHP-FPM..."
sudo apt-get install -y nginx php-fpm php-cli php-common

# Get the full path to the project (adjust if needed)
PROJECT_PATH="/var/www/teste_gui"
PROJECT_NAME="teste_gui"

echo ""
echo "Setting up project directory..."
echo "Project path: $PROJECT_PATH"

# Create project directory if it doesn't exist
sudo mkdir -p $PROJECT_PATH

# Copy project files (assuming you're running this from the project directory)
echo "Copying project files..."
sudo cp -r * $PROJECT_PATH/ 2>/dev/null || echo "Note: Make sure to copy your project files to $PROJECT_PATH"

# Set permissions
echo "Setting permissions..."
sudo chown -R www-data:www-data $PROJECT_PATH
sudo chmod -R 755 $PROJECT_PATH
sudo chmod 666 $PROJECT_PATH/chat_messages.txt 2>/dev/null || echo "chat_messages.txt will be created automatically"

# Create Nginx configuration
echo "Creating Nginx configuration..."
sudo tee /etc/nginx/sites-available/$PROJECT_NAME > /dev/null <<EOF
server {
    listen 80;
    server_name localhost;  # Change to your domain or IP
    
    root $PROJECT_PATH;
    index index.php index.html index.htm;
    
    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }
    
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.ht {
        deny all;
    }
    
    # Increase upload size if needed
    client_max_body_size 20M;
}
EOF

# Enable the site
echo "Enabling Nginx site..."
sudo ln -sf /etc/nginx/sites-available/$PROJECT_NAME /etc/nginx/sites-enabled/

# Remove default site (optional)
echo "Removing default Nginx site..."
sudo rm -f /etc/nginx/sites-enabled/default

# Test Nginx configuration
echo "Testing Nginx configuration..."
sudo nginx -t

# Start and enable services
echo "Starting services..."
sudo systemctl start php8.1-fpm 2>/dev/null || sudo systemctl start php8.2-fpm 2>/dev/null || sudo systemctl start php8.3-fpm 2>/dev/null || echo "PHP-FPM version may vary"
sudo systemctl enable php8.1-fpm 2>/dev/null || sudo systemctl enable php8.2-fpm 2>/dev/null || sudo systemctl enable php8.3-fpm 2>/dev/null || echo "PHP-FPM version may vary"

sudo systemctl restart nginx
sudo systemctl enable nginx

echo ""
echo "=========================================="
echo "Setup completed!"
echo "=========================================="
echo ""
echo "Your site should be available at: http://localhost"
echo ""
echo "To check status:"
echo "  sudo systemctl status nginx"
echo "  sudo systemctl status php*-fpm"
echo ""
echo "To view logs:"
echo "  sudo tail -f /var/log/nginx/error.log"
echo ""

