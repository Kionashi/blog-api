## Blog API

This project is a Symfony project with a simple API for a blog.

## Getting Started

These instructions will help you set up and run the project locally for development and testing purposes.

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
