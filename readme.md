## Environment variables

* First, rename the file .env.example to .env
* Change APP_URL variable to match your local URL
* Change all the DB Variables to match your local environment
* Save it

##  Installation

Once you get your environment ready to PHP and Laravel(https://laravel.com/docs/5.8/homestead or https://laradock.io/ ), change the directory to the root of the project
and run:

* ./build.sh

This command will install all the dependecies, run the tests and seed the database. 

Since the automated tests erases the database, after you execute it, run the following command:

* php artisan db:seed

This will seed your database with dummy data again.

##  Server side Endpoints

* GET /retailers
* GET /retailers/{retailer_slug}
* POST /retailers
* GET /create/retailers
* POST /retailers
* GET /edit/retailers/{retailer_slug}
* PUT /retailers/{retailer_slug}
  
  
* GET / 
* GET /products
* GET /products/{product_slug}
* PUT /products/{product_slug}  
* POST /products/{product_slug}/subscribe
* POST /products
* GET /create/products
* GET /edit/products/{product_slug}

## API Endpoints

* GET  /api/retailers
* GET /api/retailers/{retailer_id}
* POST /api/retailers
* POST /api/retailers
* PUT /api/retailers/{retailer_id}
* GET /api/products
* GET /api/products/{product_id}
* PUT /api/products/{product_id}
* POST /api/products

