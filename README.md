# Mimic Speaker

## Overview: 
Mimic Speaker is a small app for generating random text that sounds similar to, but very different from, well known works of literature.

## History:
Originally built as a ToDoList to experiement with the Slim framework, the project evolved into something a bit more fun. It has seen two overhauls; one to condense a multi-page design into a single page, and the other to convert the ToDoList into the MimicSpeaker. Now that it does something more interesting than list text on a page, core functionality will not change.

## Technical Description:
Mimic speaker is a PHP heavy app that processes well known works of literature to produce a simple associative data structure, allowing the creation of psuedo-random arrays of words on demand. Because it records which word follows which, the output looks very similar to real speech, and makes sense... sometimes. 


## Install the Application
This app was built for Composer, making setup of the Slim Framework quick and easy.

Clone the repo:
```bash
git clone git@github.com:MrLukey/MimicSpeaker.git OR https://github.com/MrLukey/MimicSpeaker.git
```

Once cloned, you can install the slim components by running:
```bash
composer install
```

Create a MySQL database called mimic_speaker_database and run the code found in db/mimic_speaker_database.sql 

Once the database is setup, you can run the application locally with:
```bash
composer start
```

Navigate to localhost:8080 in a browser to see the app running.
