# Comandos para verificar e corrigir o problema

# 1. Verificar se o CSS foi atualizado no servidor
ls -la /var/www/teste_gui/css/style.css

# 2. Ver o início do arquivo CSS para confirmar que tem o tema escuro
head -20 /var/www/teste_gui/css/style.css

# 3. Se o arquivo não foi atualizado, copiar novamente
sudo cp -r /root/teste_gui/css/* /var/www/teste_gui/css/
sudo cp -r /root/teste_gui/js/* /var/www/teste_gui/js/

# 4. Ajustar permissões novamente
sudo chown -R www-data:www-data /var/www/teste_gui
sudo chmod -R 755 /var/www/teste_gui

# 5. Verificar qual diretório o Nginx está servindo
sudo cat /etc/nginx/sites-available/teste_gui | grep root

# 6. Se necessário, copiar tudo novamente
cd /root/teste_gui
sudo cp -r * /var/www/teste_gui/
sudo chown -R www-data:www-data /var/www/teste_gui
sudo chmod -R 755 /var/www/teste_gui
sudo chmod 666 /var/www/teste_gui/chat_messages.txt

