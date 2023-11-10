# Laravel MyCustom

My Customized Package for Laravel

## About

This package uses several packages for Laravel and its own elements to facilitate development.

## Installation

You can install package via composer:

```
composer require takeru-yamamoto/laravel-mycustom
```

## Usage

### Use of Template Publishing Command

```
php artisan vendor:publish --tag=mycustom --force
```

Using this command in CLI will expose files.  
Please refer to the Readme of each repository on Github for details.

### Update vite.config.js

Please follow the three steps below to use the resources included in the package.

1. Include resources/js/mycustom.js within resources/js/app.js
2. Include resources/sass/mycustom.scss within resources/sass/app.scss
3. Confirm that app.js and app.scss are written in input in vite.config.js and run "npm install && npm run dev"
