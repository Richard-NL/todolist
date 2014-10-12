## Synopsis

At the top of the file there should be a short introduction and/ or overview that explains **what** the project is. This description should match descriptions added for package managers (Gemspec, package.json, etc.)

## Code Elaboration
- braincrafted bundle to include twitter bootstrap dependencies
- doctrine fixtures to load required data
-

## Motivation
Running a household either by yourself or with someone else can sometimes be a bit choatic and there often is some communication overhead
when for example calling your spouse to decide what grosseries need to be picked up when comming back from work.
Using a webapp you can simply put in tasks that need to be done and share this list.

## Requirements
- Apache and mysql
- PHP


## Installation
- composer install
- app/config/parameters.yml
- app/console doctrine:schema:create database
- app/console fixtures:load


