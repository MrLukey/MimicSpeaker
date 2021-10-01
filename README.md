# Slim ToDo App Exercise

## Requirements: 
- show a form to add a new task
- display a list of all the uncompleted tasks underneath
- functionality to mark uncompleted tasks as completed
- a list of completed tasks is available on another page
- completed tasks have a delete button that deletes the task from the db

## Customisations:
- handle errors and log them
- recover deleted tasks
- all tasks and functionality on one page
- format tasks by state
- Bootstrap styling
- Login & signup

## Install the Application
This app was built for Composer. This makes setting up the Slim Framework quick and easy.

Create a new directory with your project name, e.g:

```bash
mkdir SlimToDoApp
```

Once inside the new directory, clone this repo:

```bash
git clone git@github.com:MrLukey/SlimToDoList.git .
```

Once cloned, you must install the slim components by running:

```bash
composer install
```

Run this command in the application directory to run the test suite:
```bash
composer test
```

To run the application locally run:
```bash
composer start
```

Navigate to localhost:8080 in a browser to see the app running.
