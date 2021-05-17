# Project Instruction

## environment setup — 2021-01-14
### part 1 (macs) - laravel requirements
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

### part 1 (windows) - laravel requirements
```bash
    #install wamp
    sourceforge.net/projects/wampserver/postdownload
    Install and choose default options
    
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
    
    #install composer
    https://getcomposer.org/doc/00-intro.md
    Download and run Composer-Setup.exe

    #download laravel using composer
    composer global require laravel/installer
    composer require stripe/stripe-php

    #check that laravel is downloaded
    ls $HOME/.composer/vendor/bin
    laravel #it is downloaded

```

### part 2 (macs) - npm requirements
```bash
    #installing npm (THIS IS BIG)
    brew install npm

    sudo vim ~/.zshrc 
        #add the following line
        export PATH=/opt/homebrew/Cellar/node/15.10.0_1/bin/node:$PATH

    #apply updated .zshrc
    source ~/.zshrc

    #install vue related modules using npm
    npm install vue-router
    npm install vue
    npm install vuex
    npm install vue-waypoint
    npm install vue-owl-carousel
    npm install --save-dev @stripe/stripe-js
```

### part 2 (windows) - npm requirements
```bash
    #installing npm (THIS IS BIG)
    https://www.npmjs.com/get-npm
    Download and install .msi

    #install vue related modules using npm
    npm install vue-router
    npm install vue
    npm install vuex
    npm install vue-waypoint
    npm install vue-owl-carousel
    npm install --save-dev @stripe/stripe-js
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

## git setup and pull
```
    Clone the project using assigned  branch
    
    #make sure all requirements are installed
    cd <your project folder>
    npm install laravel-mix@latest --save-dev
    composer update --no-scripts
    
    #edit .env file to your own environment
    #if you use windows, rename the following file and edit  DB_DATABASE to your own path
    .env.windows -> .env
    #if you use windows, rename the following file and edit  DB_DATABASE to your own path
    .env.macs -> .env
    
    #in terminal/cmd, do
    php artisan key:generate
    php artisan passport:install

    #compile the app
    npm run dev
    
    #publish the app
    php artisan server
```

# GIT STANDARD OPERATING PROCEDURES
## standard procedure of every development session
```bash
    #1. get latest before starting to code
    git pull
    
    #2. do code code code
    code code code
    
    #3. get latest before submitting your changes
    git pull
    
    #4. push your work to github (git stage is same as git add)
    git stage <file with changes that you want to submit> #if you want to submit individual file that's changed
    git stage all #if you want to submit everything that's changed
    
    git commit -m "your submissing message" #this will prepare a submission in your local laptop
    git push #this will push all your prepared submissions (commits) to github server.
    
    
```

## example diagram of git process
```base
Time  Local     Server-feature    Server-master     Explainations
 |      1 <---pull--- 1 - - - - - - - - 1           dev-1 make sure local files are up-to-date with server files, everything is on version 1
 |      |
 |     code                                         dev-1 update 10 files
 |      |
 |     stage                                        dev-1 choose 3 files to submit
 |      |
 |     commit                                       dev-1 make those 3 files become official -> version 2
 |      |
 |      2-----push--> 2                             dev-1 submit version 2 to server for approval 
 |                    |
 |                  verify                          dev-2 make sure the version 2 is good
 |                    |
 |            create pull request                   dev-2 ask user-3 to apply version 2 to the master branch 
 |                    |
 |                    2-----merge-----> 2           dev-3 applies version 2 to the master branch
 |                                      |
 |                                    deploy        dev-3 deploys the updated master branch
 |                                      |
 |                                 --the end--      users can now see use the app v2.0
 |                          
 V   
```

# DURING DEVELOPMENT
## to clean and recreate database with new schema
```bash
    #1. make migration
    #see database/migrations/
    #example 1 : php artisan make:migration create_users_table --create=users
    #example 2 : php artisan make:migration add_votes_to_users_table --table=users 
    php artisan make:migration file_name 
    
    #2. change migration file

    #3. change seeder file
    
    #4. delete all existing tables and create fresh
    php artisan migrate:fresh --seed

    #5. re-install passport to create Personal access client for user account management
    php artisan passport:install
```

# PIPELINE
```bash
    #> install composer
    #> install npm
    composer global require laravel/installer
    composer require stripe/stripe-php
    composer update --no-scripts
    composer install
    npm install

    npm install laravel-mix@latest --save-dev
    npm install vue-router
    npm install vue
    npm install vuex
    npm install vue-waypoint
    npm install vue-owl-carousel
    npm install --save-dev @stripe/stripe-js

    .env.template -> .env
    php artisan key:generate

    php artisan migrate:fresh --seed

    php artisan passport:install

    npm run dev
    php artisan config:cache
    php artisan server
```