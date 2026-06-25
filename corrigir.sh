#!/bin/bash

echo "🚀 Iniciando a correção do ambiente..."

# 1. Corrigindo o erro do OpenSSL 1.1.1 (libcrypto)
if [ ! -f /lib/x86_64-linux-gnu/libcrypto.so.1.1 ]; then
    echo "📦 Baixando e instalando libssl1.1 para o PHP..."
    wget -q http://security.ubuntu.com/ubuntu/pool/main/o/openssl/libssl1.1_1.1.1f-1ubuntu2.24_amd64.deb
    sudo dpkg -i libssl1.1_1.1.1f-1ubuntu2.24_amd64.deb
    rm libssl1.1_1.1.1f-1ubuntu2.24_amd64.deb
else
    echo "✅ OpenSSL 1.1 já está presente."
fi

# 2. Detectando a versão do PHP e instalando o driver MySQL (could not find driver)
PHP_VERSION=$(php -r 'echo PHP_MAJOR_VERSION.".".PHP_MINOR_VERSION;')
echo "🔍 Versão do PHP detectada: $PHP_VERSION"

echo "🔄 Atualizando repositórios e instalando php$PHP_VERSION-mysql..."
sudo apt-get update -y
sudo apt-get install -y php$PHP_VERSION-mysql

# 3. Rodando os comandos do Laravel para validar
echo "⚡ Limpando o cache do Laravel..."
php artisan config:clear
php artisan cache:clear

echo "🎉 Pronto! Ambiente corrigido. Agora você pode rodar suas migrations."