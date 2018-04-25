# Agenda

This is my first web app using [Laravel](http://laravel.com/) and [Vue.js](https://vuejs.org/) frameworks.
Agenda is like its name says, it will store reminders for you and it advise you via email when the set time ends.

*It still be in development, so if you want to try it, you will need to **configure** your environment and the **.env** file.*

*In this guide you'll configure a crontab beacuse is needed to send emails, also the DB driver used is MySQL server 5.7*

## Features

- Create, delete or modify reminders, you can set a date and time, if is a payment and how much do you pay, add a location and information contact [**Still in development certain functionality**].
- Archive reminders
- Advise you via email when set time end.
- [**Still in development**] Create your own category to group your reminders.
- Uses [Google Maps Api](https://developers.google.com/maps/web/) to help you autocomplete a location.
- Send a confirmation token via email to register a new user.
- [**Soon**] Make charts about how much do you paid for in certain period.

## Setup

First you need to clone or download this repository, also you need to have installed [Composer](https://getcomposer.org/) and [Node.js](https://nodejs.org/en/).

### Composer

You need to create a fresh Laravel 5.5 installation anywhere you want, you only need to extract the **vendor** folder.

To install Laravel 5.5 execute the next command:

    composer create-project --prefer-dist laravel/laravel project_name 5.5

Copy the **vendor** folder to the root of the downloaded/clone repository.

### Configure your env file

Copy the **.env.example** file and rename it to **.env**, you have to configure the next variables:

For DB connection:

- **DB_CONNECTION**=mysql #<- or other driver do you need
- **DB_HOST**=127.0.0.1
- **DB_PORT**=3306 #<- MySQL port
- **DB_DATABASE**=db_name
- **DB_USERNAME**=user
- **DB_PASSWORD**=password

For Laravel Task Scheduler:

- **QUEUE_DRIVER**=database

For Laravel Email Sender, for use your own Gmail account you have to set a new [App Password](https://support.google.com/mail/answer/185833?hl=en) [**NOTE:** you have to setup [2-Step Verification](https://www.google.com/landing/2step/), to activate App Pasword option], in this case use Custom App Password option device:

- **MAIL_DRIVER**=smtp
- **MAIL_HOST**=smtp.gmail.com #<- Gmail smtp
- **MAIL_PORT**=587
- **MAIL_USERNAME**=your_account@gmail.com
- **MAIL_PASSWORD**=your_password_app
- **MAIL_ENCRYPTION**=tls
- **MAIL_FROM_ADDRESS**=your_account@gmail.com
- **MAIL_FROM_NAME**="Agenda Assistant"

### Generate the APP_KEY

In the root Agenda project path, open command line and execute:

    php artisan key:generate

### Create the DB

Create a database called as same as the **DB_DATABASE** variable and execute the next command on the root project:

    php artisan migrate

### Node.js dependencies

Open your command line, go to your root Agenda project path and execute the next command to download all dependencies:

    npm install

### Google Maps API KEY

You can get your API KEY from [Google Developers](https://developers.google.com/maps/web/) page, also you have to enable this 2 API's for that KEY:

- Google Maps JavaScript API
- Google Places API Web Service

Once you have the KEY, go to this file **Agenda\resources\assets\js\app.js** and change the label *API_KEY* for your key.

### Compile modules and vue's files

Open your command line, go to your root Agenda project path and execute the next command to compile all dependencies:

    npm run watch


### Configure a cronjob or task scheduler

Configure a cronjob in linux or a task scheduler to execute the next command every minute:

    /path/to/php /path/to/project/artisan schedule:run
