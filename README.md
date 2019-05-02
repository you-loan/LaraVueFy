# LaraVueFy

A [tutorial](TUTORIAL.md) about how to use Vue and Vuetify on Laravel.

## Installation

Clone the repository

	git clone https://github.com/andrea-lorusso-yn/LaraVueFy.git LaraVueFy
	
Go into the created folder

	cd LaraVueFy/

Install the dependencies via composer

	composer install
	
Copy a default .env file

	cp .env.example .env

Generate the application key

	php artisan key:generate

Install npm modules

	npm install
	
Let npm compile the sources

	npm run dev

Serve the project and see the result

	php artisan serve 