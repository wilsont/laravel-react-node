# Laravel React Testing Project

This is a sample project(POC) that make Laravel works with ReactJS with server side render by a local express server

## Requirements
* PHP 5.6+
* Node 4.0.0+
* Laravel 5.0+

## To install everything for the project
```sh
$ composer install
$ npm i
```

### Go the node-server folder
```sh
$ npm i
```

### Run the php with artisan command
```sh
$ php artisan serve --port 8822`
```

### Run gulp watch , it will start the node express server as well (default 3000 port)
```sh
$ gulp watch
```

### Notes
* app/React/React.php provides function to talks to the local express server
* app/Provider/ReactServiceProvider.php register the provider and the blade directive
* resources/assets/components.js includes all the JSX file packed for express server and browser (client side rendering)
* resources/assets/global.js register Jquery (not a must for this project actually) to window.$ and react_ujs for client side rendering