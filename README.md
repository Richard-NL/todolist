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
The Twig template engine is used for the layout of this app.

#### App layout
The layout for the whole app can be found  in "src/Rsh/Bundle/TodolistBundle/Resources/views/layout.html.twig"
Basically it is a twitter bootstrap default template.

#### Task CRUD templates
The templates for managing tasks are as followed:
- src/Rsh/Bundle/TodolistBundle/Resources/views/Task/list.html.twig (for the overview page of all tasks)
- src/Rsh/Bundle/TodolistBundle/Resources/views/Task/new.html.twig (for creating a new Task)
- src/Rsh/Bundle/TodolistBundle/Resources/views/Task/edit.html.twig (for editting an existing Task)

### Routes
The routes configuration for the whole app can be found in
- src/Rsh/Bundle/TodolistBundle/Resources/config/routing/tasks.yml

### Controller
The Task CRUD flow is dealt with in the Task Controller. This class can be found in:
- src/Rsh/Bundle/TodolistBundle/Controller/TaskController.php

### Entities
Three entities are used for creating Task entries:
- Task
- Priority
- Status
These can be found in the following folder:
- src/Rsh/Bundle/TodolistBundle/Entity

### Validation
The form validation of a Task form in done through the Task entity. The validation configuration for this entity can be found in:
- src/Rsh/Bundle/TodolistBundle/Resources/config/validation.yml

