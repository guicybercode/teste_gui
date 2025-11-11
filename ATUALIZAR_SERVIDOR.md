# Comandos para atualizar o servidor com as mudanças

# ============================================
# 1. NO SEU COMPUTADOR LOCAL (se necessário)
# ============================================
# Fazer commit das mudanças (se ainda não fez)
git add .
git commit -m "Update: Modern dark theme design"
git push origin main  # se quiser salvar no repositório remoto

# ============================================
# 2. NO SERVIDOR - Atualizar arquivos
# ============================================

# Opção A: Se você tem os arquivos atualizados em /root/teste_gui no servidor
sudo cp -r /root/teste_gui/* /var/www/teste_gui/

# Opção B: Se você quer fazer pull do git no servidor (se o diretório é um repo git)
cd /var/www/teste_gui
sudo git pull origin main

# Opção C: Se você está copiando do seu computador local via SCP
# (Execute no seu computador local, não no servidor)
# scp -r /caminho/local/projeto_droplet/* root@seu-servidor:/var/www/teste_gui/

# ============================================
# 3. AJUSTAR PERMISSÕES (sempre necessário após copiar)
# ============================================
sudo chown -R www-data:www-data /var/www/teste_gui
sudo chmod -R 755 /var/www/teste_gui
sudo chmod 666 /var/www/teste_gui/chat_messages.txt
sudo chown www-data:www-data /var/www/teste_gui/chat_messages.txt

# ============================================
# 4. VERIFICAR SE OS ARQUIVOS FORAM ATUALIZADOS
# ============================================
ls -la /var/www/teste_gui/css/style.css
# Verificar data de modificação

# ============================================
# 5. LIMPAR CACHE DO NAVEGADOR
# ============================================
# No navegador: Ctrl+F5 ou Ctrl+Shift+R para forçar reload
# Ou abra em modo anônimo para testar

# ============================================
# COMANDOS RÁPIDOS (tudo de uma vez)
# ============================================
# Copiar e ajustar permissões:
sudo cp -r /root/teste_gui/* /var/www/teste_gui/ && \
sudo chown -R www-data:www-data /var/www/teste_gui && \
sudo chmod -R 755 /var/www/teste_gui && \
sudo chmod 666 /var/www/teste_gui/chat_messages.txt && \
sudo chown www-data:www-data /var/www/teste_gui/chat_messages.txt

