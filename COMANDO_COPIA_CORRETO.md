# Comando correto para copiar o projeto

# O projeto está em /root/teste_gui (não /root/bin/teste_gui)
sudo cp -r /root/teste_gui/* /var/www/teste_gui/

# OU se você já está dentro da pasta:
cd /root/teste_gui
sudo cp -r . /var/www/teste_gui/

# Depois continue com os comandos de permissão:
sudo chown -R www-data:www-data /var/www/teste_gui
sudo chmod -R 755 /var/www/teste_gui
sudo touch /var/www/teste_gui/chat_messages.txt
sudo chmod 666 /var/www/teste_gui/chat_messages.txt
sudo chown www-data:www-data /var/www/teste_gui/chat_messages.txt

