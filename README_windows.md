# 1. Macs Development Environment Configuration

## PHP installation - via downloaded installer
- download php version 8.0.6 or higher from http://windows.php.net/downloads/
- unzip the downloaded package to c:\php
  - as a result php.ini should be at c:\php\php.ini
- open c:\php\php.ini with text editor and enable the following extensions by removing the comment character ';' at the beginning of the line.
  - extension=curl
  - extension=ffi
  - extension=ftp
  - extension=fileinfo
  - extension=gd
  - extension=gettext
  - extension=gmp
  - extension=intl
  - extension=imap
  - extension=ldap
  - extension=mbstring
  - extension=exif      ; Must be after mbstring as it depends on it
  - extension=mysqli
  - extension=odbc
  - extension=openssl
  - extension=pdo_mysql
  - extension=pdo_odbc
  - extension=pdo_pgsql
  - extension=pdo_sqlite
  - extension=pgsql
  - extension=shmop
- save the edited file.
- Open System Properties within Control Panel
  - Select Advanced tab
  - Select Environment Variables
  - Under system variables, find the Path variable, double-click to edit
  - Click New to add a new path - c:\php
  - Click Ok
  - Click Ok again
  - Click Ok again
 
## Composer installation - via downloaded installer
- download Composer installation file from https://getcomposer.org/Composer-Setup.exe
- Run the installation, select all default settings when prompted

## NPM installation - via downloaded installer
- download NPM installation file from https://nodejs.org/en/download/, select version 14.17.0 for Windows
- Run the installation, select all default settings when prompted

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
    ```bat
    .\pipeline_fresh_windows.bat
    ```
    This script contains all the necessary commands to:
    - install required composer packages (referencing composer.json and composer.lock)
    - install required npm packages (referenceing package.json and package-lock.json)
    - create environment configuration file and generate new application key
    - create empty database, migrate models and seed data
    - build the application
    - deploy the application to localhost at port 8000 (another port will be used if port 8000 is not available)
- The application is deployed and can be used or tested locally.

- To do redeployment without renewing database, run
    ```bat
    .\pipeline_update_windows.bat
    ```
    This script contains all the necessary commands to:
    - install required composer packages (referencing composer.json and composer.lock)
    - install required npm packages (referenceing package.json and package-lock.json)
    - build the application
    - deploy the application to localhost at port 8000 (another port will be used if port 8000 is not available)
- The application is deployed and can be used or tested locally.
