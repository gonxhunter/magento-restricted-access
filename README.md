# Phucct_RestrictedAccess


## Description
Prevent access to the frontend of a website for unauthenticated (not logged in) users.

## Installation

```shell
# You must be in Magento root directory
composer require phucct/magento2-restricted-access:dev-master
php bin/magento cache:clean
php bin/magento setup:upgrade
# Execute setup:di:compile only if the store is in production mode
php bin/magento setup:di:compile