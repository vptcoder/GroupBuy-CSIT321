# 1. Macs Development Environment Configuration

## PHP installation - via brew
```bash
brew install php
brew services start php
```

## Composer installation - using php
```bash
cd Downloads
#download composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

#check if installer is corrupted
php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

#installing composer
php composer-setup.php

#unload installation file once finished
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
```

## NPM installation - via brew
```bash
#installing npm
brew install npm

sudo vim ~/.zshrc 
    #add the following line
    export PATH=/opt/homebrew/Cellar/node/15.10.0_1/bin/node:$PATH

#apply updated .zshrc
source ~/.zshrc
```

# 2. Cloning Project from GitHub - via Visual Studio Code

- Open [GroupbuyGitHub](https://github.com/vptcoder/GroupBuy-CSIT321) in browser
- Select Code
- Copy https://github.com/vptcoder/GroupBuy-CSIT321.git under HTTPS (this URL can also be used)
- Open a new Visual Studio Code window
- Open the Command Palette (Shift+Command+P)
- Find and select - Remote: Open Remote Repository
- Paste the copied .git URL into the Command Palette and press Enter

# 3. Application setup and local deployment
- Open Visual Studio Code Terminal
- run 
    ```bash
    bash pipeline_fresh_macs.sh
    ```
    This script contains all the necessary commands to:
    - install required composer packages (referencing composer.json and composer.lock)
    - install required npm packages (referenceing package.json and package-lock.json)
    - create environment configuration file and generate new application key
    - create empty database, migrate models and seed data
    - build the application
    - deploy the application to localhost at port 8000 (another port will be used if port 8000 is not available)
- The application is deployed and can be used or tested locally.