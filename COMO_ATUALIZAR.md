# Como Atualizar o Site Após Instalação

## Opção 1: Atualizar via Git (Recomendado)

Se você fez alterações no repositório local e quer atualizar no servidor:

```bash
# 1. No servidor, entrar no diretório do projeto
cd /var/www/teste_gui

# 2. Se o diretório já é um repositório git:
sudo git pull origin main

# 3. Ajustar permissões após atualização
sudo chown -R www-data:www-data /var/www/teste_gui
sudo chmod -R 755 /var/www/teste_gui
sudo chmod 666 /var/www/teste_gui/chat_messages.txt
```

## Opção 2: Copiar arquivos atualizados manualmente

Se você fez alterações localmente e quer copiar para o servidor:

```bash
# 1. No servidor, fazer backup (opcional mas recomendado)
sudo cp -r /var/www/teste_gui /var/www/teste_gui.backup

# 2. Copiar arquivos atualizados do seu computador local para o servidor
# Se você tem acesso SSH do seu computador local:
scp -r /caminho/local/projeto_droplet/* root@seu-servidor:/var/www/teste_gui/

# OU se você já está no servidor e tem os arquivos em /root/teste_gui:
sudo cp -r /root/teste_gui/* /var/www/teste_gui/

# 3. Ajustar permissões
sudo chown -R www-data:www-data /var/www/teste_gui
sudo chmod -R 755 /var/www/teste_gui
sudo chmod 666 /var/www/teste_gui/chat_messages.txt

# 4. Preservar o arquivo de chat (se não quiser perder as mensagens)
# O chat_messages.txt não será sobrescrito se você não copiar ele
```

## Opção 3: Atualizar arquivos específicos

Para atualizar apenas arquivos específicos:

```bash
# Exemplo: atualizar apenas index.php
sudo cp /root/teste_gui/index.php /var/www/teste_gui/
sudo chown www-data:www-data /var/www/teste_gui/index.php
sudo chmod 644 /var/www/teste_gui/index.php

# Exemplo: atualizar apenas CSS
sudo cp -r /root/teste_gui/css/* /var/www/teste_gui/css/
sudo chown -R www-data:www-data /var/www/teste_gui/css
sudo chmod -R 755 /var/www/teste_gui/css
```

## Opção 4: Editar diretamente no servidor

Para fazer pequenas alterações diretamente no servidor:

```bash
# Editar arquivo
sudo nano /var/www/teste_gui/index.php

# Depois ajustar permissões
sudo chown www-data:www-data /var/www/teste_gui/index.php
sudo chmod 644 /var/www/teste_gui/index.php
```

## Limpar cache do navegador

Após atualizar, limpe o cache do navegador:
- Chrome/Edge: Ctrl+Shift+Delete ou Ctrl+F5
- Firefox: Ctrl+Shift+Delete ou Ctrl+F5
- Ou abra em modo anônimo para testar

## Verificar se atualizou

```bash
# Ver data de modificação dos arquivos
ls -la /var/www/teste_gui/

# Ver conteúdo de um arquivo específico
cat /var/www/teste_gui/index.php | head -20
```

## Dicas Importantes

1. **Sempre preserve chat_messages.txt**: Não copie este arquivo se quiser manter as mensagens do chat
2. **Faça backup antes de grandes mudanças**: `sudo cp -r /var/www/teste_gui /var/www/teste_gui.backup`
3. **Ajuste permissões sempre**: Após copiar arquivos, ajuste as permissões
4. **Não precisa reiniciar Nginx**: Mudanças em arquivos PHP/HTML são aplicadas imediatamente

