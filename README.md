## Synopsis
This is a todo webapp in which you can manage your todo tasks online

## Bundles/Libraries added
- braincrafted bundle to include twitter bootstrap dependencies
- doctrine/doctrine-fixtures-bundle to load required data
- knplabs/knp-paginator-bundle for pagination and sorting


## Motivation
Running a household either by yourself or with someone else can sometimes be a bit chaotic and there often is some communication overhead
when for example calling your spouse to decide what groceries you need to be pick up when coming back from work.
Using a webapp you can simply put in tasks that need to be done and share the list of what remains to be done.


## Installation
Before you can run the app/console commands you will have to adjust the file "app/config/parameters.yml" to match your db settings.
Afterwards you can run the commands below:
- git clone git@github.com:Richard-NL/todolist.git
- run "composer install"
- make app/logs and app/cache writable
- run command "app/console doctrine:database:create" for creating the database
- run command "app/console doctrine:schema:create" for creating the tables in the database
- run "app/console fixtures:load" for loading the status and priority entries required for a task
OR:
If you are running on a *nix machine clone the repository  and then run "install.sh" on the webserver

## Requirements
- Apache/Nginx
- MySql/MariaDb or Postgresql
- PHP

## Code elaboration
### Templates
#### App layout
For the layout I used the Twig template engine in combination with twitter bootstrap.
The layout for the whole app can be found  in "src/Rsh/Bundle/TodolistBundle/Resources/views/layout.html.twig".

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

