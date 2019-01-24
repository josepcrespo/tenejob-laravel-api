You can visit a demo of the project visiting the following Heroku App instance:

[https://tenejob-laravel-api.herokuapp.com/](https://tenejob-laravel-api.herokuapp.com/)

<p align="center">
  <img width="1072" height="auto" src="https://raw.githubusercontent.com/josepcrespo/tenejob-laravel-api/master/screenshots/index.png">
</p>

----------

Table of contents:

- [TeneJob Laravel API Demo](#tenejob-laravel-api-demo)
  * [Disclaimer](#disclaimer)
  * [Introduction](#introduction)
    + [Problem domain](#problem-domain)
    + [Solution](#solution)
    + [Implementation requirements](#implementation-requirements)
    + [Data input example](#data-input-example)
    + [Data input validations](#data-input-validations)
  * [Local development](#local-development)
    + [Requirements](#requirements)
    + [Get a copy of the project](#get-a-copy-of-the-project)
    + [Setup the _Docker_ environment, _Laradock_](#setup-the-_docker_-environment,-_laradock_)
    + [Possible _Laradock_ installation errors](#possible-_laradock_-installation-errors)
    + [_Laravel_ initial setup](#_laravel_-initial-setup)
    + [Read the _API_ documentation](#read-the-_api_-documentation)
    + [_MailDev_ or _Mailtrap_ email server](#_maildev_-or-_mailtrap_-email-server)
    + [Run the Tests](#run-the-tests)
  * [Deployment on _Heroku_](#deployment-on-_heroku_)
    + [Install the _Heroku CLI_](#install-the-_heroku-cli_)
    + [Initializing a _Git_ repository](#initializing-a-_git_-repository)
    + [Creating a _Procfile_](#creating-a-_procfile_)
    + [Creating a new application on _Heroku_](#creating-a-new-application-on-_heroku_)
    + [Setting a _Laravel_ encryption key](#setting-a-_laravel_-encryption-key)
    + [Pushing to _Heroku_](#pushing-to-_heroku_)
    + [Provision your _Heroku_ instance with a compatible _MySQL_ add-on](#provision-your-_heroku_-instance-with-a-compatible-_mysql_-add-on)
    + [Run the _Laravel_ migrations](#run-the-_laravel_-migrations)
    + [Open your shiny app deployed on _Heroku_](#open-your-shiny-app-deployed-on-_heroku_)
  * [Bibliography](#bibliography)
    + [_Heroku_](#_heroku_)
    + [Project development tools](#project-development-tools)
    

----------

# TeneJob Laravel API Demo

## Disclaimer

This is a demo project to provide an example of my skills for building a [REST](https://en.wikipedia.org/wiki/Representational_state_transfer) compliant API, using [Laravel](https://laravel.com/), writing [PHPUnit](https://phpunit.de/) unitary tests and, taking advantage of tools like [Composer](https://getcomposer.org/) (a dependency manager for [PHP](http://www.php.net/)), [Git](https://git-scm.com/) (a distributed version control system) and, the [Unix Shell](https://en.wikipedia.org/wiki/Unix_shell). The full development environment is built on top of [Docker](https://www.docker.com/) (using the [Laradock](https://laradock.io/) project). Also reflects my knowledge of modern development platforms like [GitHub](https://github.com/) (an online source code repositories hub).

This project has not been wrote in any case thinking to be used in production, but can be used as you wants under your total responsability. You can also fork it and, use as a foundation for your own project if you found it useful.

----------

## Introduction

The temporary recruitment agency called TeneJob wants to optimize the way they assign their workers to the different shifts of the jobs they work with.

In order to help them with this mission, you need to build an API endpoint that will accept a list of workers and shifts and return the best pairing options.

----------

### Problem domain

The problem has 3 main entities: Worker, Shifts, and Matchings.

A Worker has a weekly availability which is the days of the week (not including weekends) they can work. For example, a worker might only be able to work on Mondays and Wednesdays. Also, a worker might have a payrate, which is the amount of money paid to him for each shift he works on.

A Shift is a piece of work that needs to be done by a worker. To simplify the problem, you can consider a shift takes a whole day to be completed.

A Matching is the pairing of one worker with one shift. Two rules apply to shifts:
* A worker can only work on one shift during the same day
* A shift can only be matched with one worker

----------

### Solution

This API provides an endpoint that receives a list of workers and a list of shifts and returns the optimal list of matchings. A list of matchings is optimal if each worker is paired with at least one shift. In some scenarios, the algorithm won't able to get an optimal solution. In that case, the algorithm detects the situation and returns a message indicating this.

----------

### Implementation requirements

Build a dockerized system that can run as a docker container, to test the solution. This requirement is mandatory.
The endpoint input and output should be sent in JSON format and it need to be REST compliant. The structure and an example of these are provided in the next section of this README.md file.
 
This project demo focuses on:
* Organization of the code, the structure, scaffold and design patterns
* The efficiency to generate the matchings
* Documentation and code readability
* Good development practices:
  + Unit tests
  + Input data validation o Error handling

----------

### Data input example

Structure example of the _JSON_ data that the `/api/matchings/auto-generate` endpoint will expect:

```javascript
{
  "workers": [
    {
      "id": 1,
      "availability": ["Monday", "Wednesday"],
      "payrate": 7.50
    },
    {
      "id": 2,
      "availability": ["Monday", "Tuesday", "Thursday"],
      "payrate": 9.00
    },
    {
      "id": 3,
      "availability": ["Monday", "Friday"],
      "payrate": 18.00
    },
    {
      "id": 4,
      "availability": ["Monday", "Tuesday", "Friday"],
      "payrate": 12.25
    }
  ],
  "shifts": [
    {
      "id": 1,
      "day": ["Monday"]
    },
    {
      "id": 2,
      "day": ["Tuesday"]
    },
    {
      "id": 3,
      "day": ["Wednesday"]
    },
    {
      "id": 4,
      "day": ["Thursday"]
    }
  ]
}
```

----------

### Data input validations

The `/api/matchings/auto-generate` endpoint will validate the data sent through _POST_.

One of the validations to be considered first of all is that all the `shifts` and `workers` should already exist on the database. The endpoint will validate that each ID of `shifts` and `workers` exists on the DB and, it will also compare the data of each `shift` and `worker` against the each ones stored on the DB. The endpoint will also return verbose error messages if invalid data is sent. So, consider login trough the web interface and put some data for your testing purposes.

----------

## Local development

In this section, you can get the instructions to setup this project on your local machine for development and testing purposes.

----------

### Requirements

This project has a few mandatory requirements. Make it sure you you have installed:

[Git](https://git-scm.com/downloads) >= 2.13

[Docker Engine](https://www.docker.com/get-started) >= 17.12

----------

### Get a copy of the project

Clone the project (and it's git submodules) using [Git](https://git-scm.com/):

`git clone --recurse-submodules https://github.com/josepcrespo/tenejob-laravel-api.git`

----------

### Setup the _Docker_ environment, _Laradock_

1. Enter the `/laradock` folder and rename _env-example_ to _.env_.

`cp env-example .env`

2. Open the `.env` file of this project (_tenejob-laravel-api_) and set the following:

> DB_CONNECTION=mysql  
> DB_HOST=mysql  
> DB_PORT=3306  
> DB_DATABASE=tenejob  
> DB_USERNAME=root  
> DB_PASSWORD=root  
> REDIS_HOST=redis  
> QUEUE_HOST=beanstalkd  
> MAIL_DRIVER=smtp  
> MAIL_HOST=maildev  
> MAIL_PORT=25  
> MAIL_USERNAME=null  
> MAIL_PASSWORD=null  
> MAIL_ENCRYPTION=null  

3. Execute the following command inside the `laradock` folder, to build an run the containers:

`docker-compose up -d nginx mysql workspace maildev`

4. Execute the following command inside the `laradock` folder, to get access to the _MySQL Command-line Client_ inside the `mysql` container:

`docker-compose exec mysql mysql -u root -proot`

5. Create the database for the app:

`CREATE DATABASE tenejob;`

6. To install the defined dependencies for your project (don't execute _Composer_ inside the workspace as is not recommended to run it as root), just run the `composer install` command into the project root directory using the *Terminal.app* (if you are using *macOS*) or with your preferred *Shell*:

`php composer.phar install`

You may want to look into [the official Composer guidelines for Installing Dependencies](https://getcomposer.org/doc/01-basic-usage.md#installing-dependencies) for more details.
> **:warning: If you used the `--filename` option on the *Composer* installation**
> - Maybe you installed your *Composer* using the `--filename` installer option, for example in this way:
> `php composer-setup.php --filename=composer`
> In that case, you should run `composer install` in order to install the dependencies.

7. _Laradock_ introduces the _Workspace Image_, as a development environment. It contains a rich set of helpful tools, all pre-configured to work and integrate with almost any combination of _Containers_ and tools you may choose. We should use this workspace container to execute the _Laravel_ migration files.

`docker-compose exec workspace bash`

8. Run the _Laravel_ migration files to create all the tables into the _MySQL_ container.

`artisan migrate`

9. Open your browser and visit localhost:

`http://localhost`

----------

### Possible _Laradock_ installation errors

This are the main problems (and the solutions) I've found executing the `docker-compose up` command the first time, when _Docker_ downloads and installs all the containers needed.

1. Problems with the `mysql` _Docker_ volume:

Everything works again after deleting the data folder of the `mysql` _Docker_ volume:  

`rm ~/.laradock/data/mysql`  

(This is the path in my _macOS_ machine)

2. Service `aws` failed to build:

As pointed [here](https://github.com/laradock/laradock/issues/1156#issuecomment-335210337), a _GitHub_ thread of the _Laradock_ project repository. You should:  

`mkdir aws/ssh_keys/`  
`touch aws/ssh_keys/id_rsa.pub`  
`docker-compose build --no-cache`

3. SQLSTATE[HY000] [2054] The server requested authentication method unknown to the client:

As pointed [here](https://github.com/laradock/laradock/issues/1392#issuecomment-368320353), a _GitHub_ thread of the _Laradock_ project repository. You should:  

Change `MYSQL_VERSION` to `5.7` in `laradock/.env` and, then execute:  

`docker-compose build --no-cache mysql`

----------

### _Laravel_ initial setup

After installing _Laravel_, you may need to configure some permissions. Directories within the storage and the `bootstrap/cache` directories should be writable by your web server or _Laravel_ will not run.

First, enter your _Laradock Workspace_:

`docker-compose exec workspace bash`  
`chmod -R 777 ./storage ./bootstrap`


Set your application key to a random string.

`artisan key:generate`

----------

### Read the _API_ documentation

Read the _API_ documentation through the _Swagger Web Interface_ at:

`http://localhost/api/docs`

----------

### _Maildev_ or _Mailtrap_ email server

If you want to use the "forgot password" feature…

On your local development environment with _Laradock_:  
the email with the link to restore your password will be sent to _MailDev_ (a local mail server for local development). You can easily access the web interface at:

`http://localhost:1080/`

On the _Heroku_ instance environment:
the email with the link to restore your password will be sent to _Mailtrap Heroku Add-on_ (a local mail server for testing purposes). You can easily access the web interface at:

`https://heroku.mailtrap.io/inboxes/520364/messages`

----------

### Run the Tests

The *Unitary Tests* has been made using [PHPUnit](https://phpunit.de/).

Assuming that you have all the dependencies installed using *Composer*, you can run the *Unitary Tests* by simply executing entering the _Docker Workspace_ and typing the following command in the root directory of the project:

`phpunit`

The project have some basic unit tests but, the testing environment are not configured properly so, is expected to get all of them throw a _Fail_ o _Error_ message.

----------

## Deployment on _Heroku_

----------

### Install the _Heroku CLI_

First of all, install the _Heroku CLI_ in order to be able to continue with the following steps. To do so, execute the following command in case you are using _macOS_ and have [Homebrew](https://brew.sh/) installed. In other cases, please read on the _Heroku Dev Center_ the [official documentation for installing the command line interface](https://devcenter.heroku.com/articles/heroku-cli#download-and-install).

`brew install heroku/brew/heroku`

----------

### Initializing a _Git_ repository

Initialize a _Git_ repository in the root of the project if you don't already have one.  

`git init`  

Commit any changes you want to deploy into the master branch (this is the one used by _Heroku_ to deploy new changes into his servers).

----------
 
### Creating a _Procfile_

`echo web: vendor/bin/heroku-php-apache2 public/ > Procfile`  
`git add .`  
`git commit -m "Procfile for Heroku"`  

----------
 
### Creating a new application on _Heroku_

`heroku create [your-app-name]`
 
The string that you uses on the placeholder of `[your-app-name]` on the command above will be your name on your _Heroku Dashboard_ and also, the sub-domain of the URL provided by _Heroku_ for you application. In the case of this project, the command was executed as following:

`heroku create tenejob-laravel-api`  

and, the resulting URL for the app is:

https://tenejob-laravel-api.herokuapp.com/   
 
----------
 
### Setting a _Laravel_ encryption key

`heroku config:set APP_KEY=$(php artisan --no-ansi key:generate --show)`

Also, you need to set all the keys/values stored on your `.env` file but with the appropriate values for your _Heroku_ instance. This project's config variables can be set using the _Heroku Dashboard_ if you login into your app instance at [heroku.com](https://heroku.com/).

----------

### Pushing to _Heroku_

`git push heroku master`

----------

### Provision your _Heroku_ instance with a compatible _MySQL_ add-on

Add ClearDB:  
`heroku addons:create cleardb:ignite`

Retrieve the values of your ClearDB setup to be able to connect to your app with the Heroku DB:  
`heroku config | grep CLEARDB_DATABASE_URL`

For example, from this URL:  
`mysql://b6de34rj38adfad3:a10cd36db@us-cdbr-iron-east-05.cleardb.net/heroku_c40fa7a488382ef?reconnect=true`  

- the string between `mysql://` and `:` is your `DB_USERNAME` i.e b6de34rj38adfad3
- the string between `:` and `@` is your `DB_PASSWORD` i.e `a10cd36db`
- the string between `@` and the next `/` is your `DB_HOST` i.e `us-cdbr-iron-east-05.cleardb.net`
- the string between `/` and `?` is your `DB_DATABASE` i.e `heroku_c40fa7a488382ef`  

You should set all this values on your _Heroku App Dashboard_ or using the _Heroku CLI_.

----------

### Run the _Laravel_ migrations

`heroku run php artisan migrate`

----------

### Open your shiny app deployed on _Heroku_

`heroku open`

----------

## Bibliography

### Project development tools

[Laravel, a MVC PHP Framework based on Symfony](https://laravel.com/)  
[Laradock, a full PHP development environment for Docker](https://laradock.io/)  
[Docker, operating system level virtualization](https://docker.com/)  
[Git, a distributed version control system](https://git-scm.com/)  

### _Heroku_

[Getting Started on Heroku with PHP](https://devcenter.heroku.com/articles/getting-started-with-php)  
[The Heroku CLI](https://devcenter.heroku.com/articles/heroku-cli)  
[Getting Started with Laravel on Heroku](https://devcenter.heroku.com/articles/getting-started-with-laravel)  
[Configuration and Config Vars](https://devcenter.heroku.com/articles/config-vars)  
[ClearDB Mysql](https://devcenter.heroku.com/articles/cleardb)  
[Rename your Heroku app](https://devcenter.heroku.com/articles/renaming-apps#updating-git-remotes)

How to deploy a _Laravel 5_ app to _Heroku_ step by step:

- [Tutorial 1, by Elusoji Sodeeq on January 2018](https://medium.com/@sdkcodes/how-to-deploy-a-laravel-app-to-heroku-24b5cb33fbe) 
- [Tutorial 2, by Connor Leech on August 2017](https://dev.to/connor11528/deploy-a-laravel-5-app-to-heroku).