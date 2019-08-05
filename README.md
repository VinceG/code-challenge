# Code Challenge


I’d like you to build a simple frontend powered by Laravel and Vue.js built on top of this nifty API: https://reqres.in

The app should have the following features:

- It should all be behind a login screen.  Use the login API to validate a login.
- Once logged in, a list of users should be loaded via client side javascript. 
    - The list should display the users avatar, their full name and the email. Feel free to format this however you wish. We’re not testing your design skills, but cleanliness and simplicity is a good attribute to strive for.
    - No pagination is necessary.
    - A button should be positioned in the top right of the user list called “Create User”. This button should open a modal with a form that collects a user’s information and then uses the API to create the new user. Once created, the modal should dismiss and reload the list of users (the created user MIGHT not show on the new list, depending if reqres supports this).
- The twist...
    - I want the reqres API requests to proxy through the laravel app. So instead of the local javascript calling reqres directly, it will call the local laravel app and those requests will be proxied over to reqres. I’ll leave it up to you how to implement this on the laravel side.
    - You should have some basic (read: potentially easy to get-around) logic to prevent direct access to the proxy so ONLY the JS requests can easily use it.
- Bonus Points:  
    - Use laravel cache to cache the users LIST users reqres.in requests for 60s. This is easy, but your implementation is what matters.
    - Setup a few unit tests to ensure the API & proxy are working correctly.



## Installation

```
git clone
cd ../src
composer install && yarn
docker-compose up -d
navigate to localhost:8080
```



## docker-compose-laravel
A pretty simplified docker-compose workflow that sets up a LEMP network of containers for local Laravel development. You can view the full article that inspired this repo [here](https://medium.com/@aschmelyun).


### Usage

To get started, make sure you have [Docker installed](https://docs.docker.com/docker-for-mac/install/) on your system, and then clone this repository. Add your entire Laravel project to the `src` folder, then open a terminal and from this cloned respository's root run `docker-compose build && docker-compose up -d`. 

Open up your browser of choice to [http://localhost:8080](http://localhost:8080) and you should see your Laravel app running as intended. 

Containers created and their ports are as follows:

- **nginx** - `:8080`
- **mysql** - `:3306`
- **php** - `:9000`