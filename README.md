# Laravel Technical Assessment

## Instructions
1. Create a new repository in your Github account by cloning this repo
2. Establish an initial commit with the provided code.
3. Complete the functional requirements below & commit these changes to your repository. Open a PR with your changes so that they can be reviewed.
4. Share your repository with us.

## Setup

### System Requirements
-   Docker Desktop
-   WSL2 (Windows only)

Start by forking the repository to your own GitHub account. Then clone the forked repository to your local machine.

```bash
git clone https://github.com/your-username/laravel-assessment-template
cd laravel-technical-assessment
```

We use [Laravel Sail](https://laravel.com/docs/12.x/sail) so you should have good working knowledge of Docker. Start by copying over your env example file.

```bash
cp .env.example .env
```

And then let's install sail.

### Running the application

Start the application using sail.

You should now be able to access the application at `http://localhost`.

You can stop the application with `Ctrl+C` and then run `docker compose down` to remove the containers.

## Requirements

This assessment is to see how your write clean, readable code, and how you structure your application. We're not awarding points on frontend styling but you can use whatever framework if you like.

The application should:

-   Seed a database with at least 5 actors and at least 3 movies per actor
-   Use Eloquent to define the relationship between actors and movies
-   Have a view that displays the list of actors and their associated movies
-   Also include one input that allows the list of actors to be filtered. This can either be done with just PHP or with JavaScript, whichever you prefer. We're just looking for the end result.
-   Have a view with one input that allows the user to search people via the Star Wars API (SW-API: https://swapi.dev/documentation#people) and then displays the data.
    -   The API call should be done on the back end.
    -   The SW-API call is a performance bottleneck, please implement some enhancements that will improve response times within our application
-   Build some test cases which cover the actor/movie filtering behaviour using `Livewire::test()`
-   Build some test cases which mock the SW-API and confirm the search and display works there as intended

You should use [Laravel Livewire](https://livewire.laravel.com/) for your views and actions.


## Instructions for this repository

This technical assesment was developed and finished following the requirements above. In this small instructions, I will indicate how you should use this repository and project to test and see if everything was accomplished.

### Installation & Setup

Follow these steps to set up and run the application:

#### 1. Clone the Repository

```bash
git clone https://github.com/nabiedma/laravel-technical-assessment.git
cd laravel-technical-assessment
```

#### 2. Install Dependencies

```bash
composer install
```

#### 3. Start the Development Environment

```bash
./vendor/bin/sail up -d
```

#### 4. Generate Application Key

```bash
./vendor/bin/sail artisan key:generate
```

#### 5. Run Database Migrations with Seeders

```bash
./vendor/bin/sail artisan migrate --seed
```

#### 6. Build Frontend Assets

```bash
./vendor/bin/sail npm run dev
```

### Access the Application

Once all steps are completed, you can access the application at:

```
http://localhost
```

You can access the application pages using the example seeded user:

```
email: test@example.com
password: password
```

In addition, you can use Laravel Authentication provided in the Laravel Starter Kit and create a new user through the ```/login``` page.

### Running Tests

To run the feature tests, execute:

```bash
./vendor/bin/sail artisan test --testsuite=Feature
```

*Note: Only feature tests are included in this assessment.*

### Stopping the Application

To stop the development environment:

```bash
./vendor/bin/sail down
```

### Side Notes

When developing and solving this technical assesment, I encountered some interesting points and want to mention:

- *When implementing the use of the Star Wars API, the provided URL for the API requests has an expired SSL certificate, this was making it imposible to make a request via the HTTP Facade from Laravel, since it needs the request to be safe via CURL options.
Just to For Production: Never disable SSL verification in production environments. This is only acceptable for development/testing.*

What we did was to add the withOptions method to the HTTP get request, with the option 'verify' set to ```false```:

```php
$response = Http::withOptions([
                'verify' => false,
                'timeout' => 10,
            ])->get('http://swapi.dev/api/people/', [
                'search' => $query
            ]);
```