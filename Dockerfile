FROM php:7.2-apache

# mod_rewriteモジュールを有効にする
RUN a2enmod rewrite

# PDO MySQL拡張をインストールする
RUN docker-php-ext-install pdo_mysql

# Apacheの設定を変更するなどの追加の設定があればここに追加する

# Apacheを再起動する
RUN service apache2 restart

COPY apache-config.conf /etc/apache2/sites-available/000-default.conf
