## Blog API

This is a simple Symfony project with a API for a blog.

## Getting Started

This project only contains the API. The frontend can be located in the [following repository](https://github.com/Kionashi/blog-vue) 

The documentation of the API's endpoints can be found [here](https://documenter.getpostman.com/view/2414022/2sA35D53Jr)


### Prerequisites

- PHP 7.2 or higher
- Composer

### Installation

1. Clone the repository.
2. Run `composer install` to install the dependencies.
3. Run `symfony server:start` to start the project in the local server

### Run tests

1. Run `php bin/phpunit`

### Run phpstan

1. Run `vendor/bin/phpstan analyse src --level 7`

### Run cs fixer

1. Run `vendor\bin\php-cs-fixer fix src`
