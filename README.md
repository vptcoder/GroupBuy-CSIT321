# Project Instruction

## environment setup — 2021-01-14
```bash
    #install php
    brew install php

    #start php service
    brew services start php

    #check requirements: -> done
    php -m
    [PHP Modules]
    bcmath #required
    bz2
    calendar
    Core
    ctype #required
    curl
    date
    dba
    dom
    exif
    fileinfo #required
    filter
    ftp
    gd
    hash
    iconv
    json #required
    ldap
    libxml
    mbstring #required
    mysqli
    mysqlnd
    openssl #required
    pcre
    PDO #required
    pdo_mysql
    pdo_sqlite
    Phar
    posix
    readline
    Reflection
    session
    shmop
    SimpleXML
    snmp
    soap
    sockets
    SPL
    sqlite3
    standard
    sysvmsg
    sysvsem
    sysvshm
    tidy
    tokenizer #required
    wddx
    xml #required
    xmlreader
    xmlrpc
    xmlwriter
    xsl
    zlib

    [Zend Modules]

    #cd to Downloads folder to download composer
    cd Downloads

    #download and installing composer
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"

    #move composer to PATH directory
    mv composer.phar /usr/local/bin/composer

    #add composer bin to PATH
    cd ~
    vim .zshrc
    		#add line
    		export PATH=~/.composer/vendor/bin:$PATH

    #apply updated .zshrc
    source .zshrc

    #download laravel using composer
    composer global require laravel/installer

    #check that laravel is downloaded
    ls $HOME/.composer/vendor/bin
    laravel #it is downloaded

    #download commercetools php sdk using composer
    composer global require commercetools/php-sdk

    #check that the sdk is downloaded
    ls $HOME/.composer/vendor/bin
    ctp-tlscheck.php        laravel #it is downloaded
```

## create laravel project and first commit to git — 2021-01-14 -- van only
Build an e-commerce application using Laravel and Vue - Part 1: Application Setup [https://blog.pusher.com/ecommerce-laravel-vue-part-1/]

```bash
    #create laravel project
    laravel new GroupBuy_CSIT321

    #navigate to created project (it is located at ~/GroupBuy_CSIT321
    cd GroupBuy_CSIT321

    #setup git in local
    git init

    #add all files in folder to git
    git add . 

    #create git commit
    git commit -m 'laravel project created'

    #connect to github
    git remote add origin https://github.com/vptcoder/GroupBuy-CSIT321.git

    #create local feature branch
    git checkout -b feature_base

    #check existing local branches
    git branch

    #switch local branch
    git checkout feature_base

    #track local branch to remote branch -- IMPORTANT(1): link them together
    git branch --set-upstream-to=origin/feature_base feature_base

    #commit again to make local latest version
    git add .
    git commit -m 'make latest'

    #pull to sync local and remote
    git pull --allow-unrelated-histories

    #push to remote -- IMPORTANT(2): do (1) so that when you push here there's no need to state local branch and remote branch
    git push

    #now all local changes exists in feature_base remote branch
```

## git setup and pull on Windows
```

```

## git setup and pull on Mac

## standard procedure  of every development session
```bash
    #1. get latest
    
    #2. do your developement work
    
    #3. get latest
    git pull
    #4. push your work to github
```
