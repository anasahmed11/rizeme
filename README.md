###first clone the project
###composer install
###cp .env.example .env
###php artisan key:generate
###php artisan storage:link
###replace this commands in .env
APP_URL=http://127.0.0.1:8000

DB_DATABASE=rizeme

DB_USERNAME=root

DB_PASSWORD=
###to run seed : php artisan migrate --seed
###to run test cases :php artisan test
###to run the job and schedule of publishing news : 
php artisan queue:work

php artisan schedule:work
###to view the app run this :
 php artisan serve
 
 then go to browser then write : http://127.0.0.1:8000
###to enter dashboard :
http://127.0.0.1:8000/admin/login

email : admin@gmail.com

password:12345678

###news api link :
http://127.0.0.1:8000/api/news

-------------------------------------------------------------------------------------
#docker
### RUN the following command to run the application and its dependencies with mysqld service
docker-compose up -d 
###  NOTE IF APPLICATION FAILS TO RUN CMD COMMANDS , 
###  ENTER APPLICATION CONTAINER WITH DOCKER EXEC -IT APPLICATION_CONTAINER_ID /BIN/BASH
###  THEN RUN COMMANDS IN cmd.sh file inside scripts folder
### to run queue run this php artisan queue:work
### to run schedule run this php artisan schedule:work
