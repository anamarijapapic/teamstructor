# Teamstructor

## Table of Contents

* [General Info](#general-info)
* [Features](#features)
* [Technologies](#technologies)
* [Database Model](#database-model)
* [Getting Started](#getting-started)
* [Credits](#credits)

## General Info

Teamstructor is a web application that serves as a teamwork platform. Users can form teams in which team members have access to team projects. Inside each project team members can discuss and store useful resources relevant for that project.

> Project created as a college undergraduate final thesis:  
> SRC146 - Final Thesis  
> University of Split - University Department of Professional Studies

## Features

`TO-DO`

## Technologies

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)  
![Livewire](https://img.shields.io/badge/Livewire-4E56A6.svg?style=for-the-badge&logo=Livewire&logoColor=white)  

![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)
![phpMyAdmin](https://img.shields.io/badge/phpMyAdmin-6C78AF.svg?style=for-the-badge&logo=phpMyAdmin&logoColor=white)  
![Nginx](https://img.shields.io/badge/nginx-%23009639.svg?style=for-the-badge&logo=nginx&logoColor=white)  
![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)  

![Composer](https://img.shields.io/badge/Composer-885630.svg?style=for-the-badge&logo=Composer&logoColor=white)
![NPM](https://img.shields.io/badge/NPM-%23CB3837.svg?style=for-the-badge&logo=npm&logoColor=white)  

![Visual Studio Code](https://img.shields.io/badge/Visual%20Studio%20Code-0078d7.svg?style=for-the-badge&logo=visual-studio-code&logoColor=white) 

## Database Model

![Simple Database Model](https://user-images.githubusercontent.com/92815435/227921312-1d30b686-1ebc-4d18-ba05-4380bc21626a.png)

## Getting started

### Requirements

You should have the following installed with respective minimal versions:

- [Docker](https://www.docker.com/community-edition) 18.06 bundled with docker-compose
- [NodeJS](https://nodejs.org/en/) 16.x LTS bundled with npm

### Running the Application

1. Install and update all the requirements above
2. Clone the repo: `git clone git@github.com:anamarijapapic/teamstructor.git`
3. Copy `.env.example` to `.env`
4. Copy `src/teamstructor-app/.env.example` to `src/teamstructor-app/.env`
5. Use Node version defined in `.nvmrc` file by running: `nvm use`
6. Install all JS dependencies by running: `npm install`
7. Install JS dependencies by running: `npm install` from `src/teamstructor-app/` directory
8. Append the line `127.0.0.1   teamstructor.test` to your `/etc/hosts` file
9. Generate your local certificate (setup HTTPS) by running: `npm run addcert`
10. Do a initial build of the website assets by running: `npm run build` from `src/teamstructor-app/` directory
11. Check that Docker Desktop is running, then build and start the local web server for the first time: `docker-compose up`
12. Install Composer dependencies: `docker exec -it teamstructor_php composer install`
13. Generate application key: `docker exec -it teamstructor_php php artisan key:generate`
14. Create symbolic link for storage: `docker exec -it teamstructor_php php artisan storage:link`
15. Alter folder permissions for `src/teamstructor-app/storage` & `src/teamstructor-app/bootstrap` folders: `sudo chmod -R 777 src/teamstructor-app/storage/ src/teamstructor-app/bootstrap/`
16. Open [MinIO Dashboard](http://localhost:9000/) in your browser and login using default root credentials `minioadmin:minioadmin`
 - Create a bucket with bucket name `teamstructor-bucket` and change its access policy to `public`
 - Create access key and copy access key value to `AWS_ACCESS_KEY_ID` and secret key value to `AWS_SECRET_ACCESS_KEY` defined in `src/teamstructor-app/.env`
17. Run database migrations & seed the database: `docker exec -it teamstructor_php php artisan migrate:fresh --seed`
18. Open [https://teamstructor.test/](https://teamstructor.test/) in your browser
19. Work with the code in the directory.

### Working With the 'dev' Environment

#### Laravel w/ Docker - Notes

To run **Artisan** commands from terminal run command from repo root directory:  
`docker exec -it teamstructor_php php artisan <command>`

#### Useful Docker Commands

- `docker-compose up` starts the docker environment, you can stop it with a single `cmd/ctrl+c`
- `docker-compose build` re-builds all the containers
- `docker-compose stop` stops containers
- `docker-compose down` stops and removes the containers and their volumes
- `docker ps` lists all running containers on the system, useful to track down ones that are unintentionally keeping the ports used.
  Note: All commands must be run at the repo root directory.

#### Managing the Database

A DB administration tool, [phpMyAdmin](https://www.phpmyadmin.net), is available at http://localhost:8080/.
You can connect to MySQL yourself using the port `3306` on `localhost` from your host. Username and password is `root`.

A simple web interface to manage Redis databases, [phpRedisAdmin](https://github.com/erikdubbelboer/phpRedisAdmin), is available at http://localhost:8085/.

#### Testing Mail Sending

[MailHog](https://github.com/mailhog/MailHog) Web UI, an email testing tool for developers, is available at http://localhost:8025/.

## Credits

* [Anamarija Papić](https://github.com/anamarijapapic)
