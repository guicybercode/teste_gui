#!/bin/bash

# Installation script for Simple Web Dashboard
# Supports Debian, Ubuntu, and Arch Linux

set -e

echo "=========================================="
echo "Simple Web Dashboard - Installation Script"
echo "=========================================="
echo ""

# Detect OS
if [ -f /etc/os-release ]; then
    . /etc/os-release
    OS=$ID
elif [ -f /etc/debian_version ]; then
    OS="debian"
elif [ -f /etc/arch-release ]; then
    OS="arch"
else
    echo "Error: Unable to detect OS. This script supports Debian, Ubuntu, and Arch Linux."
    exit 1
fi

echo "Detected OS: $OS"
echo ""

# Function to install on Debian/Ubuntu
install_debian_ubuntu() {
    echo "Installing dependencies for Debian/Ubuntu..."
    echo ""
    
    # Update package list
    sudo apt-get update
    
    # Install PHP and Apache
    sudo apt-get install -y php php-cli php-common apache2
    
    # Enable Apache modules
    sudo a2enmod rewrite
    
    # Set permissions
    sudo chown -R www-data:www-data /var/www/html 2>/dev/null || true
    
    echo ""
    echo "Installation completed!"
    echo ""
    echo "Next steps:"
    echo "1. Copy this project to /var/www/html/ or your web root directory"
    echo "2. Set proper permissions: sudo chown -R www-data:www-data /path/to/project"
    echo "3. Make chat_messages.txt writable: sudo chmod 666 /path/to/project/chat_messages.txt"
    echo "4. Start Apache: sudo systemctl start apache2"
    echo "5. Enable Apache on boot: sudo systemctl enable apache2"
    echo "6. Open http://localhost in your browser"
}

# Function to install on Arch Linux
install_arch() {
    echo "Installing dependencies for Arch Linux..."
    echo ""
    
    # Update package database
    sudo pacman -Sy
    
    # Install PHP and Apache
    sudo pacman -S --noconfirm php apache
    
    # Enable Apache modules
    sudo sed -i 's/#LoadModule rewrite_module/LoadModule rewrite_module/' /etc/httpd/conf/httpd.conf 2>/dev/null || true
    
    echo ""
    echo "Installation completed!"
    echo ""
    echo "Next steps:"
    echo "1. Copy this project to /srv/http/ or your web root directory"
    echo "2. Set proper permissions: sudo chown -R http:http /path/to/project"
    echo "3. Make chat_messages.txt writable: sudo chmod 666 /path/to/project/chat_messages.txt"
    echo "4. Start Apache: sudo systemctl start httpd"
    echo "5. Enable Apache on boot: sudo systemctl enable httpd"
    echo "6. Open http://localhost in your browser"
    echo ""
    echo "Note: You may need to edit /etc/httpd/conf/httpd.conf to set:"
    echo "  LoadModule php_module modules/libphp.so"
    echo "  AddHandler php-script .php"
    echo "  Include conf/extra/php_module.conf"
}

# Main installation logic
case $OS in
    debian|ubuntu)
        install_debian_ubuntu
        ;;
    arch|archlinux)
        install_arch
        ;;
    *)
        echo "Error: Unsupported OS: $OS"
        echo "This script supports: Debian, Ubuntu, and Arch Linux"
        exit 1
        ;;
esac

echo ""
echo "=========================================="
echo "Installation script completed!"
echo "=========================================="

