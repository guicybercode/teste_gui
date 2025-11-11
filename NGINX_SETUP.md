# Nginx Setup Guide for Debian/Ubuntu

## Quick Setup Commands

### Option 1: Use the automated script
```bash
chmod +x setup_nginx.sh
sudo ./setup_nginx.sh
```

### Option 2: Manual setup

#### 1. Install Nginx and PHP-FPM
```bash
sudo apt-get update
sudo apt-get install -y nginx php-fpm php-cli php-common
```

#### 2. Copy project to web directory
```bash
sudo mkdir -p /var/www/teste_gui
sudo cp -r /path/to/your/project/* /var/www/teste_gui/
sudo chown -R www-data:www-data /var/www/teste_gui
sudo chmod -R 755 /var/www/teste_gui
sudo chmod 666 /var/www/teste_gui/chat_messages.txt
```

#### 3. Create Nginx configuration
```bash
sudo nano /etc/nginx/sites-available/teste_gui
```

Paste this configuration:
```nginx
server {
    listen 80;
    server_name localhost;  # Change to your domain or IP
    
    root /var/www/teste_gui;
    index index.php index.html index.htm;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.ht {
        deny all;
    }
    
    client_max_body_size 20M;
}
```

#### 4. Enable the site
```bash
sudo ln -s /etc/nginx/sites-available/teste_gui /etc/nginx/sites-enabled/
sudo rm -f /etc/nginx/sites-enabled/default
```

#### 5. Test and restart Nginx
```bash
sudo nginx -t
sudo systemctl restart nginx
sudo systemctl restart php8.1-fpm  # Adjust version (php8.2-fpm, php8.3-fpm, etc.)
sudo systemctl enable nginx
sudo systemctl enable php8.1-fpm
```

#### 6. Check PHP-FPM socket path
If you get errors, check which PHP version is installed:
```bash
ls /var/run/php/
```

Then update the `fastcgi_pass` line in the Nginx config to match (e.g., `unix:/var/run/php/php8.2-fpm.sock`)

## Access Your Site

- Local: http://localhost
- Remote: http://your-server-ip

## Useful Commands

```bash
# Check Nginx status
sudo systemctl status nginx

# Check PHP-FPM status
sudo systemctl status php8.1-fpm  # Adjust version

# View Nginx error logs
sudo tail -f /var/log/nginx/error.log

# View PHP-FPM logs
sudo tail -f /var/log/php8.1-fpm.log  # Adjust version

# Reload Nginx after config changes
sudo nginx -t && sudo systemctl reload nginx

# Restart services
sudo systemctl restart nginx
sudo systemctl restart php8.1-fpm
```

## Troubleshooting

### 502 Bad Gateway
- Check PHP-FPM is running: `sudo systemctl status php*-fpm`
- Verify socket path in Nginx config matches: `ls /var/run/php/`
- Check PHP-FPM logs: `sudo tail -f /var/log/php*-fpm.log`

### Permission Denied
- Fix ownership: `sudo chown -R www-data:www-data /var/www/teste_gui`
- Fix permissions: `sudo chmod -R 755 /var/www/teste_gui`
- Chat file: `sudo chmod 666 /var/www/teste_gui/chat_messages.txt`

### Files not found
- Verify root path in Nginx config: `root /var/www/teste_gui;`
- Check file exists: `ls -la /var/www/teste_gui/index.php`

