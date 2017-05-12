## Summary
Mustache MVC is a micro php framework framed for you that wants some practicality in your project but does not want all the robust features of a great Framework.

The main idea of Mustache is already to bring an MVC structure ready.
In the Models part, you will have a dynamic system for using entities, where, once the attributes are correctly filled according to what has been defined in your Database (MariaDB), insert, update, fetch and delete information are Made with few lines of code, without having to keep typing querys!

Mustache also comes with the Bootstrap framework configured, but nothing prevents you from working your front end in the way that pleases you the most.

## Installation
Clone this repository (Branch Master or the Release of your choice) or download the zip and place it in a directory where your web server has access.

If you are going to work with a specific package, you can edit the composer.json file by placing the dependencies that you find necessary in your project

If you are going to work with a specific vendor, you can edit the composer JSON file and then just run the command
```
composer install
cp config.dist.ini config.ini
```
To develop locally, you must use the command:
```
cd public
php -S 127.0.0.1:8888 router.php
```

Then just put the address http://127.0.0.1:8888/ in your browser and check if the Mustache home page is loading correctly

I'm currently working on a more complete documentation page to use the built-in commands, but the initial mustache structure already brings a created example of a Users framework.

To see the internal commands of the framework, you can type the command below:
```
php cli
```
Remember and edit the config.ini file with your server settings. You can add new configuration lines to your liking, they will all be converted into php constant

Feel free to contribute to the growth of Mustache. It was done as a framework study and has a lot to grow too! Your cooperation will be very welcome!