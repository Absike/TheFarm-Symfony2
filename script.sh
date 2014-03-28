#!/bin/bash

#by @Hassan Absike

clear

tput setaf 7
echo "Starting... Cleaning and granting permissions to cache and logs..."
tput sgr0
rm -rf app/cache/d*
rm -rf app/cache/p*
rm -rf app/cache/t*
rm -rf app/logs/*
chmod -R 777 app/cache
chmod -R 777 app/logs
tput setaf 7
echo "OK"
tput sgr0

while getopts "ubdichr" opt; do
  case $opt in
    u)
      tput setaf 7
      echo "Composer selfupdate..."
      tput sgr0
      php composer.phar selfupdate -v --profile
      tput setaf 7
      echo "OK"
      tput sgr0
      tput setaf 7
      echo "Composer install & update..."
      tput sgr0
      php composer.phar update -v --profile --optimize-autoloader
      tput setaf 7
      echo "OK"
      tput sgr0
      ;;
    b)
      tput setaf 7
      echo "Bower install & update..."
      tput sgr0
      bower update --allow-root
      tput setaf 7
      echo "OK"
      tput sgr0
      ;;
    d)
      tput setaf 7
      echo "Assetic dump..."
      tput sgr0
      php app/console assetic:dump --env=prod --no-debug --verbose
      tput setaf 7
      echo "OK"
      tput sgr0
      ;;
    i)
      tput setaf 7
      echo "Assets install..."
      tput sgr0
      php app/console assets:install web --symlink --verbose
      tput setaf 7
      echo "OK"
      tput sgr0
      ;;
    c)
      tput setaf 7
      echo "Cache clear..."
      tput sgr0
      php app/console cache:clear --env=dev --no-warmup
      php app/console cache:clear --env=prod
      tput setaf 7
      echo "OK"
      tput sgr0
      ;;
    r)
      tput setaf 7
      echo "Restart apache server..."
      tput sgr0
      apachectl restart
      tput setaf 7
      echo "OK"
      tput sgr0
      ;;
    h)
      tput setaf 7
      echo "Usage: ./script [-u][-b][-d][-i][-s][-f][-c][-t][-h][-r]"
      echo "Additional options:"
      echo -e "\t [-u] => composer self[u]pdate & update"
      echo -e "\t [-b] => bower install & update"
      echo -e "\t [-d] => assetic:[d]ump"
      echo -e "\t [-i] => assets:[i]nstall"
      echo -e "\t [-c] => cache:[c]lear"
      echo -e "\t [-h] => [h]elp"
      echo -e "\t [-r] => service apachectl [r]estart"
      echo "Default it [rm -rf /cache/d* /cache/p*] + [chmod -R 777 /cache /logs]"
      echo -e "\n"
      tput sgr0
      ;;
    *)
      echo "Invalid option. See correct usage with [-h]."
      ;;
  esac
done

tput setaf 7
echo "Finishing... Granting permissions to cache and logs..."
chmod -R 777 app/cache
chmod -R 777 app/logs
echo "Done! You can now refresh your app!"
tput sgr0
