## How to Run the Project
 1. clone the project.
    -> git clone https://github.com/alidtx/multivendor-ecommerce.git
 2. Generate ENV
    -> copy .env.example .env
 3. Key Generate
    -> php artisan key:generate
 4. create database and add database on env file.

 5. Run Migration command 
    -> php artisan migrate:fresh
 6. Run seeder command 
   -> php artisan db:seed --class=DatabaseSeeder
 7. To listen the queue, run.
    ->php artisan  queue:listen
 8. To generate all ordered invoice, run custom command.
    -> php artisan invoice:generate

## Guidlines

-> All the queue listener and job effect you will find in the laravel log file.I did it to save time.

-> Find out the **postman**  collection to check endpoint that in the zipfile in the email.

-> Role in the user table through enum <br> so when you are try to login, see if it is buyer, seller or admin.

 ## Endpoint
 
##For login: {{baseUrl}}/login
##For Register: {{baseUrl}}/register
##For LogOut: {{baseUrl}}/logout

## For buyer:
-> {{baseUrl}}/buyer/orders
-> {{baseUrl}}/buyer/orders/list   
-> {{baseUrl}}/buyer/orders/invoices
## For Seller 
-> {{baseUrl}}/seller/orders/successful
-> {{baseUrl}}/seller/orders/unsuccessful   
-> {{baseUrl}}/seller/orders/balance

   

    
