TeneJob Laravel API Demo

----------

Table of contents:

- [TeneJob Laravel API Demo](#oowordpressnonces)
  * [Disclaimer](#disclaimer)
  * [Introduction](#introduction)
    + [Problem domain](#problem-domain)
    + [Solution](#solution)
    + [Implementation requirements](#implementation-requirements)
    + [Data input example](#data-input-example)
  * [Local development](#local-development)
    + [Requirements](#requirements)
    + [Get a copy of the project](#get-a-copy-of-the-project)
    + [Setup the Docker environment, Laradock](#setup-the-docker-environment-laradock)
    + [Laravel initial setup](#laravel-initial-setup)
    + [Read the API documentation](#read-the-api-documentation)
    + [MailDev](#maildev)
    + [Run the Tests](#run-the-tests)
  * [Laradock errors](#laradock-errors)
    + [Main problems I faced installing Laradock](main-problems-i-faced-installing-laradock)

----------

# TeneJob Laravel API Demo

## Disclaimer

This is a demo project to provide an example of my skills for building a [REST](https://en.wikipedia.org/wiki/Representational_state_transfer) compliant API, using [Laravel](http://www.php.net/), writing [PHPUnit](https://phpunit.de/) unitary tests and, taking advantage of tools like [Composer](https://getcomposer.org/) (a dependency manager for PHP), [Git](https://git-scm.com/) (a distributed version control system) and, the [Unix Shell](https://en.wikipedia.org/wiki/Unix_shell). The full development environment is built on top of [Docker](https://www.docker.com/) (using the [Laradock](http://laradock.io/) project). Also reflects my knowledge of modern development platforms like [GitHub](https://github.com/) (an online source code repositories hub).

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

Structure example of the JSON data that the `/api/matchings/auto-generate` endpoint will expect:

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

### Setup the Docker environment, Laradock

1. Enter the laradock folder and rename env-example to .env.

`cp env-example .env`

2. Open the `.env` file of this project (tenejob-laravel-api) and set the following:

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

3. Build an run the containers:

`docker-compose up -d nginx mysql workspace maildev`

4. Access to the MySQL Command-line Client inside the `mysql` container:

`docker-compose exec mysql mysql -u root -proot`

5. Create the database for the app:

`CREATE DATABASE tenejob;`

6. To install the defined dependencies for your project (don't execute Composer inside the workspace as is not recommended to run it as root), just run the *Composer* install command into the project root directory using the *Terminal.app* (if you are using *macOS*) or with your preferred *Shell*:

`php composer.phar install`

You may want to look into [the official Composer guidelines for Installing Dependencies](https://getcomposer.org/doc/01-basic-usage.md#installing-dependencies) for more details.
> **:warning: If you used the `--filename` option on the *Composer* installation**
> - Maybe you installed your *Composer* using the `--filename` installer option, for example in this way:
> `php composer-setup.php --filename=composer`
> In that case, you should run `composer install` in order to install the dependencies.

7. Laradock introduces the Workspace Image, as a development environment. It contains a rich set of helpful tools, all pre-configured to work and integrate with almost any combination of Containers and tools you may choose. We should use this Workspace container to execute the Laravel migration files.

`docker-compose exec workspace bash`

8. Run the Laravel migration files to create all the tables into the MySQL container.

`artisan migrate`

9. Open your browser and visit localhost:

`http://localhost`

----------

### Laravel initial setup

After installing Laravel, you may need to configure some permissions. Directories within the storage and the bootstrap/cache directories should be writable by your web server or Laravel will not run.

First, enter your Laradock Workspace:

`docker-compose exec workspace bash`

`chmod -R 777 ./storage ./bootstrap`


Set your application key to a random string.

`artisan key:generate`

----------

### Read the API documentation

Read the API documentation through the Swagger web interface at:

`http://localhost/api/docs`

----------

### Maildev

If you want to use the "forgot password" feature, the email with the link to restore your password will be sent to MailDev (a local mail server for local development). You can easely acces the web interface at:

`http://localhost:1080/`

----------

### Run the Tests

The *Unitary Tests* has been made using [PHPUnit](https://phpunit.de/).

Assuming that you have all the dependencies installed using *Composer*, you can run the *Unitary Tests* by simply executing entering the Docker Workspace and typing the following command in the root directory of the project:

`phpunit`

The project have some basic unit tests but, the testing environment are not configured properly so, is expected to get all of them throw a Fail o Error message.

----------

## Laradock errors

----------

### Main problems I faced installing Laradock

----------

This are the main problems (and the solutions I've found) I face executing the `docker-compose up` command the first time, when Docker downloads and installs all the containers needed.

1. Problems with the `mysql` Docker volume:

Delete the folder ~/.laradock/data/mysql in my Mac machine. and everything works.

2. Service `aws` failed to build:

Follow the [instruccions](https://github.com/laradock/laradock/issues/1156#issuecomment-335210337) written in this specific comment on a GitHub thread of the Laradock project repository.

3. SQLSTATE[HY000] [2054] The server requested authentication method unknown to the client:

Follow the [instruccions](https://github.com/laradock/laradock/issues/1392#issuecomment-368320353) written in this specific comment on a GitHub thread of the Laradock project repository.
