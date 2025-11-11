# ============================================
# COMANDOS COMPLETOS PARA INSTALAÇÃO DO SERVIDOR
# Debian/Ubuntu - Nginx + PHP-FPM
# ============================================

# 1. INSTALAR NGINX E PHP-FPM
sudo apt-get update
sudo apt-get install -y nginx php-fpm php-cli php-common

# 2. VERIFICAR VERSÃO DO PHP INSTALADA
ls /var/run/php/
# Anote a versão (ex: php8.4-fpm.sock)

# 3. CRIAR DIRETÓRIO WEB
sudo mkdir -p /var/www/teste_gui

# 4. COPIAR PROJETO PARA O DIRETÓRIO WEB
sudo cp -r /root/teste_gui/* /var/www/teste_gui/

# 5. CORRIGIR ESTRUTURA (mover conteúdo do subdiretório se existir)
sudo mv /var/www/teste_gui/teste_gui/* /var/www/teste_gui/ 2>/dev/null || true
sudo rmdir /var/www/teste_gui/teste_gui 2>/dev/null || true

# 6. LIMPAR ARQUIVOS DESNECESSÁRIOS
sudo rm -rf /var/www/teste_gui/.bash_history
sudo rm -rf /var/www/teste_gui/.bashrc
sudo rm -rf /var/www/teste_gui/.cache
sudo rm -rf /var/www/teste_gui/.cargo
sudo rm -rf /var/www/teste_gui/.cloud-locale-test.skip
sudo rm -rf /var/www/teste_gui/.config
sudo rm -rf /var/www/teste_gui/.docker
sudo rm -rf /var/www/teste_gui/.hex
sudo rm -rf /var/www/teste_gui/.local
sudo rm -rf /var/www/teste_gui/.mix
sudo rm -rf /var/www/teste_gui/.profile
sudo rm -rf /var/www/teste_gui/.ssh
sudo rm -rf /var/www/teste_gui/.wget-hsts
sudo rm -rf /var/www/teste_gui/potential-adventure

# 7. AJUSTAR PERMISSÕES
sudo chown -R www-data:www-data /var/www/teste_gui
sudo chmod -R 755 /var/www/teste_gui
sudo touch /var/www/teste_gui/chat_messages.txt
sudo chmod 666 /var/www/teste_gui/chat_messages.txt
sudo chown www-data:www-data /var/www/teste_gui/chat_messages.txt

# 8. VERIFICAR ARQUIVOS (deve mostrar index.php, chat.php, css/, js/, images/)
ls -la /var/www/teste_gui/

# 9. CRIAR CONFIGURAÇÃO DO NGINX
sudo tee /etc/nginx/sites-available/teste_gui > /dev/null <<'EOF'
server {
    listen 80;
    server_name localhost;
    
    root /var/www/teste_gui;
    index index.php index.html index.htm;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.ht {
        deny all;
    }
    
    client_max_body_size 20M;
}
EOF

# 10. AJUSTAR VERSÃO DO PHP NO CONFIG (substitua php8.4-fpm.sock pela versão encontrada no passo 2)
# Se sua versão for diferente, edite o arquivo:
# sudo nano /etc/nginx/sites-available/teste_gui
# E altere a linha: fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;

# 11. ATIVAR O SITE E REMOVER O DEFAULT
sudo ln -s /etc/nginx/sites-available/teste_gui /etc/nginx/sites-enabled/
sudo rm -f /etc/nginx/sites-enabled/default

# 12. TESTAR CONFIGURAÇÃO DO NGINX
sudo nginx -t

# 13. INICIAR E HABILITAR SERVIÇOS
# Ajuste a versão do PHP conforme encontrado no passo 2
sudo systemctl start php8.4-fpm
sudo systemctl enable php8.4-fpm
sudo systemctl restart nginx
sudo systemctl enable nginx

# 14. VERIFICAR STATUS DOS SERVIÇOS
sudo systemctl status nginx
sudo systemctl status php8.4-fpm

# 15. VERIFICAR LOGS (se houver problemas)
# sudo tail -f /var/log/nginx/error.log
# sudo tail -f /var/log/php8.4-fpm.log

# ============================================
# PRONTO! O site deve estar disponível em:
# http://localhost ou http://seu-ip-do-servidor
# ============================================

