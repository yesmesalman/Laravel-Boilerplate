### Laravel Boilerplate Guide


#### Requirements
-   ```PHP 7.4.26```


#### rename .env file

-   rename ```.env.example``` as ```.env``` 


#### Update these configs

-   update ```APP_NAME``` in ```.env``` 
-   update ```APP_URL``` in ```.env```
-   update ```DB_DATABASE```, ```DB_USERNAME```, ```DB_PASSWORD``` in ```.env```
-   update ```MAIL_HOST```, ```MAIL_USERNAME```, ```MAIL_PASSWORD```, ```MAIL_FROM_ADDRESS``` in ```.env```
-   update ```STRIPE_KEY```, ```STRIPE_SECRET``` in ```.env```


#### Run these Commands:

-   ``` composer install && php artisan optimize && php artisan migrate && php artisan world:init && php artisan passport:install && php artisan db:seed && php artisan optimize && php artisan config:cache && php artisan config:clear && php artisan key:generate && php artisan route:clear ```


#### Credentials:
-   **Admin** ``` Email: admin@yahoo.com Password: admin123```
-   **Moderator** ``` Email: moderator@yahoo.com Password: admin123```
-   **User** ``` Email: user@yahoo.com Password: admin123```