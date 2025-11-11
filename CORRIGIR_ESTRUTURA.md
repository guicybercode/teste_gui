# Comandos para corrigir a estrutura de diretórios

# Opção 1: Mover o conteúdo do subdiretório para o diretório principal
sudo mv /var/www/teste_gui/teste_gui/* /var/www/teste_gui/
sudo rmdir /var/www/teste_gui/teste_gui

# Limpar arquivos desnecessários que foram copiados
sudo rm -rf /var/www/teste_gui/potential-adventure
sudo rm -rf /var/www/teste_gui/.bash_history /var/www/teste_gui/.bashrc /var/www/teste_gui/.cache /var/www/teste_gui/.config /var/www/teste_gui/.docker /var/www/teste_gui/.ssh

# Verificar se os arquivos corretos estão no lugar
ls -la /var/www/teste_gui/

# Você deve ver: index.php, chat.php, css/, js/, images/, etc.

# Ajustar permissões novamente
sudo chown -R www-data:www-data /var/www/teste_gui
sudo chmod -R 755 /var/www/teste_gui
sudo chmod 666 /var/www/teste_gui/chat_messages.txt

