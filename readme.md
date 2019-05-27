## Environment variables


## Installation

Once you get your environment ready(Homestead or Laradock), change the directory to the root of the project
and run:

* ./build.sh

This command will install all the dependecies, run the tests and seed the database. 

Since the automated tests erases the database, after you execute it, run the following command:

* php artisan db:seed

This will seed your database with dummy data again. 
