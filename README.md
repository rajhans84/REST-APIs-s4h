# PHP-Architecture-with-Slim-Framework-3

Setting up the environment for running this app:

1. Install wamp server and make the necessary config for running wamp server in localhost
2. Install MySql server for database connectivity
3. Install composer
   - By visiting the link- https://getcomposer.org/download/
4. Push the project folder to www root folder in your wamp server
5. Run the script file from project folder -> db folder in your MySql server
   - It will create your schema, tables with data required for running this app


Packages made config to run this app:

1. composer - https://getcomposer.org/download/
2. slim framework - http://www.slimframework.com/docs/start/installation.html
   - If you installed composer, then open the project main folder in command prompt and run the command:
     composer require slim/slim "^3.0"
3. twig-view
   - Open your project folder in cmd prompt and run the command:
     composer require slim/twig-view
4. validations
   - Open your project folder in cmd prompt and run the command:
     composer require respect/validation
5. cross-site request forgery (security)
   - Open your project folder in cmd prompt and run the command:
     composer require slim/csrf
6. For showing flash messages
   - Open your project folder in cmd prompt and run the command:
     composer require slim/flash
