## Synopsis
This is a todo webapp in which you can manage your todo tasks online

## Bundles/Libraries added
- braincrafted bundle to include twitter bootstrap dependencies
- doctrine/doctrine-fixtures-bundle to load required data
- knplabs/knp-paginator-bundle for pagination and sorting


## Motivation
Running a household either by yourself or with someone else can sometimes be a bit chaotic and there often is some communication overhead
when for example calling your spouse to decide what groceries need to be picked up when coming back from work.
Using a webapp you can simply put in tasks that need to be done and share the list.


## Installation
Before you can run the app/console commands you will have to adjust the file "app/config/parameters.yml" to match your db settings.
Afterwards you can run the commands below:

- composer install
- app/console doctrine:schema:create database
- app/console fixtures:load

## Requirements
- Apache/Nginx
- MySql/MariaDb or Postgresql
- PHP

## Code elaboration
### Template
### Routes
### Controller
### Entities