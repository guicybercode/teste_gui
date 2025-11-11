# Comandos para copiar o projeto para /var/www/teste_gui

# Se o projeto está em /root/bin/teste_gui:
sudo cp -r /root/bin/teste_gui/* /var/www/teste_gui/

# OU se o projeto está em outro local, primeiro encontre onde está:
# find /root -name "index.php" -type f 2>/dev/null

# Depois ajuste as permissões:
sudo chown -R www-data:www-data /var/www/teste_gui
sudo chmod -R 755 /var/www/teste_gui

# Criar o arquivo de chat se não existir:
sudo touch /var/www/teste_gui/chat_messages.txt
sudo chmod 666 /var/www/teste_gui/chat_messages.txt
sudo chown www-data:www-data /var/www/teste_gui/chat_messages.txt

