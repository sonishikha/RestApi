Simple Rest Api using core Php


What is Simple Rest Api Project?

It is a simple Rest Api to perform CRUD operations on products data. User can create, read, update and delete product data. 


Prerequisite:

	• Php 7
    • MySql database
    • Php rewrite module should be enabled
    • AllowOverride All and Require all granted should be uncommented in httpd.conf or apache2.conf file.
      Check following link: https://askubuntu.com/questions/421233/enabling-htaccess-file-to-rewrite-path-not-working


Follow these steps before you run the sample:

    • Git clone repository https://github.com/sonishikha/RestApi in your php document root directory.
    • Run mysql file in your mysql Database to get the sample data.
    • You can use postman to test the api. Just import json file in postman and you will get all the requests and testcases already performed.


Getting Started:

To test Rest Api user need to perform basic authorization. For now I have put static username and password to authorize the user. The static credentails are:

username: admin
password: admin

The expected request URL format is as follows:

GET: 
    
    localhost/RestApi/Products
    
    localhost/RestApi/Products/id
    
    localhost/RestApi/Products/product name (Not implemented yet.)
     
POST:

    localhost/RestApi/Products (Send all the parameters via, Post data)

PUT: 

    localhost/RestApi/Products/id (Send all the parameters via x-www-form-urlencoded)

DELETE: 

    localhost/RestApi/Products/id
    
Note: Have covered only CRUD operations for now. Filtering, pagination, search by products name is not yet implemented. 


Running the requests on Postman:

I have already run few request to test working of Rest Api. Please find the json file in git and import the json file in Postman or find the following sharable link: https://app.getpostman.com/run-collection/864c13af85c35ec88653


Versioning:

Used github for versioning. Repository is  https://github.com/sonishikha/RestApi


Acknowledgments:

    Created Rest Api for the first time in my career. I have used Core Php to create this Rest Api.
    
    Tried to use MVC structure to keep code segregated.
    
    Use of .htaceess for url rewriting was fun and learning for me.
    
    Used a coding standard PSR2.
    
    I think application can be more modularized by using autoloading, Custome Exceptions, composer, some good authorization, common controller and model class, etc.
