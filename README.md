SeoHelis
========

[Task 3 - Simple eShop](https://bitbucket.org/Sauls/seohelis-devdocs/wiki/new-team-member/backend/task3.md) by SeoHelis.

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
