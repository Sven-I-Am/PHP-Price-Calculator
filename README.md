# PHP-Price-Calculator
PHP Price Calculator challenge BeCode



### Step 1: add the database to the project
We're using PHPStorm and it's built-in DBMS, here are the steps we followed to get accessto the database within our project.

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