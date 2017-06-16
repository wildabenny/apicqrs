#!/usr/bin/env bash
sudo rm -rf ./app/cache/d*
sudo chmod -R 775 ./app
sudo chown -R marcin:www-data ./app
php ./app/console cache:clear -e dev
sudo chmod -R 775 ./app
sudo chown -R marcin:www-data ./app