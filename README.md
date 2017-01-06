Simple eShop
============

[SeoHelis: Task 3 - Simple eShop](https://bitbucket.org/Sauls/seohelis-devdocs/wiki/new-team-member/backend/task3.md) by SeoHelis.

Summary
-------

Create a small web application that must implement:

* User system
    * User can register
    * User can login
    * Logged user can change his password
    * User can logout
* User Items
	* Logged user can add items they want to sell they want to sell with price, description and picture(s)
	* Logged user can assign predefined category(ies) for the item
	* add items to they shoping cart
* User cart
	* Display list of items
	* Total price
	* When user press Buy button in Cart: 
		* If user is not logged in - ask to log in or create account and after that proceed buy process
		* create buy request(s) for user(s), who sells the items, with items that user, who pressed the buy button, is interested buying
* In frontend list of all users selling items
	* Posibility to order by latest items
	* Posibility to order by price (highest, lowest)
	* Filter by predefined categories
	* When clicked on item a page with more detailed information is opened

Examples
--------

* [https://www.vinted.com](https://www.vinted.com)
* [https://us.letgo.com](https://us.letgo.com)

Requirements
------------

* Use css framework ([bootstrap](http://getbootstrap.com/), [foundation](http://foundation.zurb.com/)) or the one you are used to.
* Use js framework ([jQuery](https://jquery.com/), [vue.js](https://vuejs.org/)) or libs that only needs to accomplish the assignment.
* Use php framework ([laravel](https://laravel.com/), [Symfony](https://symfony.com/))
* Use [Coding Standards](../../coding-standards/index.md)
* Write some tests for your classes

Additionally
------------

* Put all your code into a VCS - ([bitbucket](https://bitbucket.org/)) 
* Write a README.md on how to configure and run your application
* Your application should work using PHP builtin server

Most important things during the assessment
------------------------------------------

* Have a great time
* If you don't know or don't understand something - **ASK**! We will do our best to help you in solving your problem.

Project Setup
-------------

Run Docker container:

	$ bin/docker_up

Initialize composer dependencies:

	$ bin/composer_install

Initialize database (requires `root` to clean up `/web/uploads/*`):

	$ sudo bin/db_reset

Init `var` folder (requires `root` to change ownership):

	$ sudo bin/clc

Run tests:

	$ bin/test

Open in browser [localhost:8000](http://localhost:8000).
