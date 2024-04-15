FROM php:7.2-apache

# mod_rewriteモジュールを有効にする
RUN a2enmod rewrite

# PDO MySQL拡張をインストールする
RUN docker-php-ext-install pdo_mysql

# Apacheの設定ファイルをコピーする
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Apacheの設定ファイルを有効にし、サービスを再起動する
RUN a2ensite 000-default && service apache2 restart
