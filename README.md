# RUN the following command to run the application and its dependencies with mysqld service
docker-compose up -d 

# NOTE IF APPLICATION FAILS TO RUN CMD COMMANDS , 
# ENTER APPLICATION CONTAINER WITH DOCKER EXEC -IT APPLICATION_CONTAINER_ID /BIN/BASH
# THEN RUN COMMANDS IN cmd.sh file inside scripts folder
#to run queue run this php artisan queue:work
#if the docker not work fine run this command
#first clone the project
#composer install
#cp .env.example .env
#replace this commands in .env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=convertedin
DB_USERNAME=root
DB_PASSWORD=
#php artisan migrate --seed
#php artisan test
#php artisan queue:work
