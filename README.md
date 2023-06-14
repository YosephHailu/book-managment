
## Setup

This is a very minimal book store management api for demonstration purpose 
I used Laravel v-10.10 to develop it
And Laradock to dockerize the website. [laradock](https://laradock.io/getting-started/#installation) check this link to setup laradock

-  Clone this repository
-  Clone laradock on your project root directory:
    - git submodule add https://github.com/Laradock/laradock.git.
-  Edit your web server sites configuration. (cd into laradock directory and copy .env.example to .env ) 
    - cp .env.example .env
    - change php version to 8.2
- Finally run docker-compose up nginx phpmyadmin
