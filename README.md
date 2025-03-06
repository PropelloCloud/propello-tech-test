<p align="center">
    <img width="200px" src="./public/assets/logo.png" alt="Build Status">
</p>


## Environment Requirements

In order to set up your development environment it is recommended that the following are installed on your machine:

- Composer
- PHP v8.2
- NPM v10.2.3

Alternately if this is not a practical solution (for example on a Windows machine) you can implement 
[Devilbox](http://devilbox.org/), or similar, container for local development

## Getting Started

In order to set up your development environment you should simply need to run the following commands:

```shell
# If not already cloned
git clone https://github.com/PropelloCloud/propello-tech-test.git
cd propello-tech-test

cp .env.example .env
composer install
php artisan migrate
php artisan key:generate
npm install
npm run dev
php artisan serve
```

Environment should then be available at [127.0.0.1:8000](http://127.0.0.1:8000)

## Tasks

Please note, we do not necessarily expect you to complete all the below tasks, we simply ask
that you complete as much as possible within a 2-3 hour timeframe.

1. The "Task Edit" form errors on submit, discover and resolve the bug.
2. We wish to be able to add tags against task items, the requirements are as follows:
   1. User is able to create, edit & delete tags.
   2. Tags require a `name` property.
   3. User is able to assign multiple tags to a `Task`.
   4. Tags are only accessible by the user who created them.
   5. Tags associated with a `Task` can be amended/removed.
3. Currently, when some forms are submitted the user is re-directed without any clear 
indication that their submission has been successfully handled. Add a new success message
component and implement wherever appropriate.

