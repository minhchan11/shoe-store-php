# Shoe Tracker Database

### Site to view brands and stores of shoes

#### By Minh Phuong

## Description

This website will track shoes and stores

## Setup/Installation Requirements

##### Create Database and Tables
* In a command window:
```sql
> /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot
> CREATE DATABASE shoes;
> USE shoes;
> CREATE TABLE brands (id serial PRIMARY KEY, name VARCHAR(255));
> CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR(255));
> CREATE TABLE brands_stores (id serial PRIMARY KEY, brand_id int, shoe_id int);
```
* Clone to local machine
* Navigate to downloaded folder, into the "web folder"
* Type in cmd window "php -S localhost:8000"
* Navigate to http://localhost:8888/phpMyAdmin/?lang=en in web browser of choice
* Import the database.sql.zipped from the folder
* Navigate to http://localhost:8888/ web browser of choice

## Specifications

#### Shoe Class

* The DeleteAll method for the Shoe class will delete all rows from the shoes table.
  * Example Input: none
  * Example Output: nothing

* The GetAll method for the Shoe class will return an empty list if there are no entries in the Shoe table.
  * Example Input: N/A
  * Example Output: empty list

* The Equals method for the Shoe class will return true if the Shoe in local memory matches the Shoe pulled from the database.
  * Example Input:  
> Local: "Gucci" , id is 1;
> Database: "Gucci" , id is 1;

  * Example Output: `true`

* The Save method for the Shoe class will save new shoes to the database.
  * Example Input:  
> Save ("Gucci"),

  * Example Output: no return value

* The Save method for the Shoe class will assign an id to each new instance of the Shoe class.
  * Example Input:  
> New shoe: "Gucci" ,`local id: 0`, Save();

  * Example Output:  
> "Gucci" , `database-assigned id`  

* The GetAll method for the Shoe class will return all shoe entries in the database in the form of a list.
  * Example Input:  
> "Gucci" , id is 10 ; Save();"Versace", id is 11 ; Save(); GetAll()

  * Example Output:
> `{Gucci object}, {Versace object}`

* The Find method for the Shoe class will return the Shoe as defined in the database.
  * Example Input:
> Find ("Gucci")

  * Example Output:
> "Gucci" , `database-assigned id`

* The Update method for the Shoe class will return the Shoe with the new shoe name and instructions.
  * Example Input:
> "Gucci" , id is 1; Update("D&G");

  * Example Output:
> "D&G" , id is 1

* The DeleteThis method for the Shoe class will delete the shoe from the list of Shoe.
  * Example Input:
> DeleteThis ("Gucci"); GetAll()

  * Example Output:
> `{No Doubt object}, {Versace object}`

* The Search method for the Shoe class will return a list of Shoes with matched name.
  * Example Input:
> Search ("Gucci")

  * Example Output:
> `{Gucci object}`


#### Store class
* The DeleteAll method for the Store class will delete all rows from the stores table.
  * Example Input: none
  * Example Output: nothing

* The GetAll method for the Store class will return an empty list if there are no entries in the Store table.
  * Example Input: N/A
  * Example Output: empty list

* The Equals method for the Store class will return true if the Store in local memory matches the Store pulled from the database.
  * Example Input:  
> Local: "Manhattan Square" , id is 1;
> Database: "Manhattan Square" , id is 1;

  * Example Output: `true`

* The Save method for the Store class will save new stores to the database.
  * Example Input:  
> Save ("Manhattan Square"),

  * Example Output: no return value

* The Save method for the Store class will assign an id to each new instance of the Store class.
  * Example Input:  
> New store: "Manhattan Square" ,`local id: 0`, Save();

  * Example Output:  
> "Manhattan Square" , `database-assigned id`  

* The GetAll method for the Store class will return all store entries in the database in the form of a list.
  * Example Input:  
> "Manhattan Square" , id is 10 ; Save();"Seattle", id is 11 ; Save(); GetAll()

  * Example Output:
> `{Manhattan Square object}, {Seattle object}`

* The Find method for the Store class will return the Store as defined in the database.
  * Example Input:
> Find ("Manhattan Square")

  * Example Output:
> "Manhattan Square" , `database-assigned id`

* The Update method for the Store class will return the Store with the new store name and instructions.
  * Example Input:
> "Manhattan Square" , id is 1; Update("34th St");

  * Example Output:
> "34th St" , id is 1

* The DeleteThis method for the Store class will delete the store from the list of Store.
  * Example Input:
> DeleteThis ("Manhattan Square"); GetAll()

  * Example Output:
> `{34th St object}, {Stadium object}`

* The Search method for the Store class will return a list of Stores with matched name.
  * Example Input:
> Search ("Manhattan Square")

  * Example Output:
> `{Manhattan Square object}`


#### Shoe && Store classes
* The AddShoe method for the Store class will save a shoes associated with that store.
  * Example Input:
> AddShoe("Gucci")

  * Example Output: nothing

* The GetShoe method for the Store class will return the list of shoes associated with that store.
  * Example Input:
> GetShoe("Manhattan Square")

  * Example Output:
> `{Gucci object},{Versace object}`

* The DeleteShoes method for the Store class delete the entries that connects the shoe ids with the store.
  * Example Input:
  > DeleteShoes("34th St"), GetShoe("34th St")

  * Example Output: null

* The DeleteThisShoe method for the Store class delete the singular entry that connects the shoe id with the store.
  * Example Input:
  > DeleteThisShoe("34th St","GreenDay"), GetShoe("34th St")

  * Example Output:
  > `{No Doubt object},{Versace object}`

* The AddStore method for the Shoe class will save a store associated with that shoe.
  * Example Input:
> AddStore("34th St")

  * Example Output: nothing

* The GetStore method for the Shoe class will return the list of stores associated with that shoe.
  * Example Input:
> GetStore("Gucci")

  * Example Output:
> `{34th St object}, {Stadium object}`

* The DeleteStores method for the Store class delete the entries that connects the shoe ids with all the associated store.
  * Example Input:
  > DeleteStores("Gucci"), GetStore("Gucci")

  * Example Output: null

#### User Interface
* The user can add a new Shoe using the "Add Shoe" form.
  * Example Input:  
  New Shoe: "Gucci", id is 1; *add Shoe*
  * Example Output:  
  All Shoes Page: "Gucci, No Doubt"

* The user can add a new Store using the "Add store" form.
  * Example Input:  
    New store: "Manhattan Square", id is 10; *add Store*
  * Example Output:  
    All stores: "Manhattan Square", "34th St"

* The user can click on any store in the stores list to view the store's details
  * Example Input:  
    *click* "Manhattan Square"
  * Example Output: "Manhattan Square", List of store tags

* The user can click on any shoe to view a list of all stores in that the shoe and it's tags.
  * Example Input:  
    *click* "Gucci"
  * Example Output: "Gucci", list of stores in Gucci (eg Manhattan Square)

* The user can edit a store's store name on the store's page.
  * Example Input:  
    *click* "Manhattan Square"  
     New store name: "Manhattan 34th St"  
  * Example Output: "Manhattan 34th St"

* The user can delete a store using a link on the store's page .
  * Example Input:  
     *click* "Manhattan Square"  
     *delete*  
  * Example Output: Return to Stores Page

* The user can edit a shoe's name on the shoe's page.
  * Example Input:    
   *click* "Gucci"  
  * Example Output: "D&G"

* The user can delete a shoe using a link on the shoe's page .
  * Example Input:  
   *click* "Gucci"  
   *delete click*  
  * Example Output: Return to Shoes Page

* The user can search using store name for an store using the search form.
  * Example Input:
    *search* "Manhattan"
  * Example Output: "Manhattan Square"

* The user can search using shoe name for an shoe using the search form.
  * Example Input:  
    *search* "Green"
  * Example Output: "Gucci"

* The user can add a store to a shoe using selection form.
  * Example Input:  
    "Gucci" *add* "Manhattan Square"
  * Example Output: "Gucci", "Manhattan Square"

* The user can remove a store from a shoe using selection form.
  * Example Input:  
    "Gucci" *remove* "Manhattan Square"
  * Example Output: "Gucci", "34th St"

* The user can remove all stores from a shoe using selection form.
  * Example Input:  
    "Gucci" *remove all*
  * Example Output: "Gucci"

* The user can add a shoe to a store using a selection form.
  * Example Input:  
  "Manhattan Square" *add* "Gucci"
  * Example Output: "Manhattan Square", "Gucci"

* The user can remove a shoe from a store using selection form.
  * Example Input:  
    "Manhattan Square" *remove* "Gucci"
  * Example Output: "Manhattan Square", "Versaces"

* The user can remove all stores from a shoe using selection form.
  * Example Input:  
    "Manhattan Square" *remove all*
  * Example Output: "Manhattan Square"

## Support and contact details

Please contact Minh Phuong mphuong@kent.edu with any questions, concerns, or suggestions.


## Technologies Used

This web application uses:
* PHP
* Silex
* mySql

****

### License

*This project is licensed under the MIT license.*

Copyright (c) 2017 _**Minh Phuong**_
