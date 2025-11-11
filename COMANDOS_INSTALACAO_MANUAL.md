# Comandos para instalação manual do servidor Nginx + PHP-FPM no Debian

# ============================================
# 1. INSTALAR NGINX E PHP-FPM
# ============================================
sudo apt-get update
sudo apt-get install -y nginx php-fpm php-cli php-common

# ============================================
# 2. VERIFICAR VERSÃO DO PHP INSTALADA
# ============================================
ls /var/run/php/
# Anote a versão (ex: php8.1-fpm.sock, php8.2-fpm.sock, php8.3-fpm.sock, php8.4-fpm.sock)

# ============================================
# 3. COPIAR PROJETO PARA O DIRETÓRIO WEB
# ============================================
sudo mkdir -p /var/www/teste_gui
sudo cp -r /root/bin/teste_gui/* /var/www/teste_gui/

# ============================================
# 4. AJUSTAR PERMISSÕES
# ============================================
sudo chown -R www-data:www-data /var/www/teste_gui
sudo chmod -R 755 /var/www/teste_gui
sudo touch /var/www/teste_gui/chat_messages.txt
sudo chmod 666 /var/www/teste_gui/chat_messages.txt
sudo chown www-data:www-data /var/www/teste_gui/chat_messages.txt

# ============================================
# 5. CRIAR CONFIGURAÇÃO DO NGINX
# ============================================
sudo nano /etc/nginx/sites-available/teste_gui

# Cole este conteúdo (ajuste o fastcgi_pass conforme sua versão do PHP):
# server {
#     listen 80;
#     server_name localhost;
#     
#     root /var/www/teste_gui;
#     index index.php index.html index.htm;
#     
#     location / {
#         try_files $uri $uri/ /index.php?$query_string;
#     }
#     
#     location ~ \.php$ {
#         include snippets/fastcgi-php.conf;
#         fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
#         fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
#         include fastcgi_params;
#     }
#     
#     location ~ /\.ht {
#         deny all;
#     }
#     
#     client_max_body_size 20M;
# }

# Salve e feche (Ctrl+X, Y, Enter)

# ============================================
# 6. ATIVAR O SITE E REMOVER O DEFAULT
# ============================================
sudo ln -s /etc/nginx/sites-available/teste_gui /etc/nginx/sites-enabled/
sudo rm -f /etc/nginx/sites-enabled/default

# ============================================
# 7. TESTAR CONFIGURAÇÃO DO NGINX
# ============================================
sudo nginx -t

# ============================================
# 8. INICIAR E HABILITAR SERVIÇOS
# ============================================
# Substitua php8.4-fpm pela versão que você encontrou no passo 2
sudo systemctl start php8.4-fpm
sudo systemctl enable php8.4-fpm
sudo systemctl restart nginx
sudo systemctl enable nginx

# ============================================
# 9. VERIFICAR STATUS DOS SERVIÇOS
# ============================================
sudo systemctl status nginx
sudo systemctl status php8.4-fpm

# ============================================
# 10. VERIFICAR SE OS ARQUIVOS ESTÃO NO LUGAR CERTO
# ============================================
ls -la /var/www/teste_gui/
# Deve mostrar: index.php, chat.php, css/, js/, images/, etc.

# ============================================
# 11. TESTAR O SITE
# ============================================
# Acesse: http://localhost ou http://seu-ip-do-servidor

# ============================================
# COMANDOS ÚTEIS PARA TROUBLESHOOTING
# ============================================
# Ver logs de erro do Nginx:
# sudo tail -f /var/log/nginx/error.log

# Ver logs do PHP-FPM:
# sudo tail -f /var/log/php8.4-fpm.log

# Recarregar configuração do Nginx após mudanças:
# sudo nginx -t && sudo systemctl reload nginx

# Reiniciar serviços:
# sudo systemctl restart nginx
# sudo systemctl restart php8.4-fpm

