# The one where OOP and Databases meet!
### exercise in week 8 (08/11/2021 - 12/11/2021) of our BeCode training
## Challenge
This week we're taking our knowledge of OOP and adding Databases to the mix with this exercise where we attempt to create a price calculator.  
The database provided by [BeCode](https://github.com/becodeorg/ANT-Lamarr-5.34/tree/main/2.The-Hill/php/6.oop-pricecalculator) contains 3 tables:
* customer
* customer-group
* product

## The objective of this exercise

* Figure out how to access information in a database from a PHP project
* Manipulate the information in a way to show it on the page
* Using information from 1 table to access information from another table and using both to calculate a result
* Work in a small team
* Split up tasks
* Stick to the 4-day deadline

## Tools and languages used

|  | Description | Who? |
| ----------- | ----------- |----------|
| ![ubuntu](IMG/ubuntu-logo.png) | Running Ubuntu 20.04 | Sven|
| ![windows10](IMG/windows-10-logo.png) | Running Windows 10 | Reinout |
| ![php-storm](IMG/phpstorm-logo.jpeg) | Working with PHPStorm as IDE | Both |
| ![php](IMG/php-logo.jpg) | Main language used is PHP | Both |
| ![git](IMG/git-logo.png) | Using git for version control | Both |
| ![github](IMG/github-logo.png) | Hosting my files on github | Both |

## Timeline

* Day 1 (:date:08/11/2021)
    * assignment was given at 9AM with short briefing and Q&A by coach [Tim](https://github.com/Timmeahj)
    * we split off into groups of 2. We worked together before, so we decided to do so again on this project
    * This time Reinout got control of the repository and created the `PHP-Price-Calculator` repo on `GitHub`
    * After both having read through the mission briefing we got stuck in on figuring things out
    * It took us a good 2 hours to work out how to gain access to the database inside our project in PHPStorm, but hey, we did it!
    * The rest of day 1 was spent experimenting with how to visualize the data we wanted to access
      * By 5PM we had found a way to generate a dropdown list for our customers and our products
      * But since the code resembled a war-zone we decided to start fresh on DAY2!
* Day 2 (:date:09/11/2021)
    * After a short update from our coach we scrapped the project and started fresh
    * This time it only took 10 minutes to get access to the database in our brand-new project, and I managed to write out the steps we took to get there:
    * ### Step 1: add the database to the project :heavy_check_mark:
      * We're using PHPStorm, and it's built-in DBMS, here are the steps we followed to get access to the database within our project.
        1. Add the `resources` folder to the project ROOT
        2. On the right-hand-side of the screen is a tab called "Database", click on it
        3. Click the `+` to add a `data source` based on MySQL
        4. Fill in the pop-up using your SQL username and password and click `ok`
        5. You should now see your data source in the `database` tab
        6. Right-click on your new data-source and choose `new-schema`
        7. Name it what you want, this is your database name, we'll be needing this later on when we do the PDO call
        8. Once you've created the new `schema` go to your .sql file, right-click and choose `run`
        9. Set the target schema to be your newly created `schema` and click `run`
        10. You should now have a database you can call on from inside your project
    * ### Step 2: Create the file structure using an [MVC Patern](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller) :heavy_check_mark:
      * Reinout created the basic file structure we would use throughout the project
        * There's an entity for each table of information we will be needing as well as `Loaders` for all customers and all products
        * The basic `getters` were written as well
          * The`getPrice` in `class Product` has the conversion to Euro/Pound price built in
    * ### Step 3: Show all customers and products(with their base price) in a dropdown `<select>` element :heavy_check_mark:
      * For this we need to call on the `customer` table in our database using PDO
      * We created a connection class to connect to our MySQL database
      * Using the return from that we go into our Loaders and query the information in the tables
      * The loaders structure the queried results into an array that can then be used to visualize through the view
    * ### Step 4: query the database based on the `$_POST` variables :heavy_check_mark:
      * saving the `$_POST` in `$_SESSION` variables and using those to query the database and construct new customer and new product with
      * we can now show which customer chose which product in a table format
      * we can also access the customer discounts
      * NEXT UP: write a `calculator` class to handle the calculations from the given data
    * ### Step 5: calculate the discounted price
      * so far we can calculate the discounted price based on customer discounts
      * We still need to implement a model for the group discount calculations and then add that to the price calculator
* Day 3 (:date:10/11/2021)
  * First thing this morning we walked through all our code up to this point and added `// comments` to explain what each part does
    * This is for clarification to ourselves in the future or for anyone who happens to read/work with this code
  * We also did some minor aesthetic fixes
  * Get to coding the group discounts :exclamation:
    * Created separate model `customerGroup` to calculate the total fixed discounts and the best variable discount
    * Updated the calculator to implement the group discounts
    * Made sure the end price is never negative
    * Showing the end start price and end price on the screen
    * cleaned up code
    * merged groupDiscounts into one method `setDiscounts`
      * merged getvardiscount loop with getfixdiscount loop
      * only need 1 parentID now
    * added more info to the price table calculation
    * styled the page a little bit
    * next up: separate the calculations out of the view
    


## To Do

This to do list is for personal use, the full to do list is added at the start of the challenge and as we complete
objectives they will be moved up into the timeline section and ticked off using emotes such as :heavy_check_mark:

### must-haves
1. A dropdown where you can select a Product and a Customer and you get the basic information of the product + the price. :heavy_check_mark:
2. Use a MVC pattern. You can use the MVC Boilerplate. :heavy_check:
3. Use separate objects for importing the entities with SQL, and for managing the entities. :heavy_check_mark:

### Nice to have
1. An actual login page for a customer
2. A table where you can see in detail how the price is calculated
3. The possibility to have different prices for different quantities (look, 1 EUR per item for 1, 0.9 EUR per item for 100, ...)
4. A category page for the different products