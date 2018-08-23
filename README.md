# laravel-jwt-auth
Larave jwt auth with refresh token flow

// For Deploy in HEROKUAPP
Manually fire following command in Heroku Conosle
 "php artisan clear-compiled",
 "php artisan optimize",
 "chmod -R 777 public/"

 Add Requred env variable in Config Vars

for setup database add add-ons "Heroku Postgres"
after adding them click or open "https://data.heroku.com/"
open your db and view credentials in setting add ther credential in config vars at "https://dashboard.heroku.com/apps/laravel-jwt-auth/settings"

database setup is ready now you have to add your APP_KEY in config vars

example:
_______________________________________________
| KEY         |             VALUE               |
------------------------------------------------
| APP_KEY     |  YOUR KEY STARTIG FROM "base64" |
------------------------------------------------

run all artisan comand in heroku console