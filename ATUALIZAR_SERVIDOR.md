# Comandos para atualizar o servidor

# ============================================
# OPÇÃO 1: Se você tem o repositório git no servidor
# ============================================
cd /var/www/teste_gui
sudo git pull origin main
sudo chown -R www-data:www-data /var/www/teste_gui
sudo chmod -R 755 /var/www/teste_gui
sudo chmod 666 /var/www/teste_gui/chat_messages.txt

# ============================================
# OPÇÃO 2: Se você tem os arquivos em /root/teste_gui
# ============================================
sudo cp -r /root/teste_gui/* /var/www/teste_gui/
sudo chown -R www-data:www-data /var/www/teste_gui
sudo chmod -R 755 /var/www/teste_gui
sudo chmod 666 /var/www/teste_gui/chat_messages.txt

# ============================================
# OPÇÃO 3: Clonar/Atualizar do GitHub diretamente
# ============================================
cd /var/www
sudo rm -rf teste_gui
sudo git clone https://github.com/guicybercode/teste_gui.git
sudo chown -R www-data:www-data /var/www/teste_gui
sudo chmod -R 755 /var/www/teste_gui
sudo touch /var/www/teste_gui/chat_messages.txt
sudo chmod 666 /var/www/teste_gui/chat_messages.txt
sudo chown www-data:www-data /var/www/teste_gui/chat_messages.txt
