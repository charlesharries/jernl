



# Jernl

## Installation

To install all of the template files, run the following script from the root of your project's directory:

```
bash -c "$(curl -s https://raw.githubusercontent.com/CFPB/development/main/open-source-template.sh)"
```

----

# Project Title

**Description**:  It's journaling, with a calendar. Sort of based on the old Seinfeld yarn re: keeping the chain going, partly a solution to not wanting to pay for Notion.

Other things to include:

  - **Technology stack**: Laravel 7
  - **Status**:  Beta
  - **Links to production or demo instances**: https://jernl.charlesharri.es/


**Screenshot**:

![](https://raw.githubusercontent.com/charlesharries/jernl/main/screenshot.jpg)


## Dependencies

This project requires a standard LEMP/LAMP stack as well as Composer and Yarn. 

## Installation

  - Clone the repository
  - Install Composer dependencies with `composer install`
  - Install Yarn dependencies with `yarn install`
  - Create `.env` file with your environment variables in (see .env.example for sample .env)
  - Set your Laravel application key with `php artisan key:generate`
  - Run database seeding to set up required DB tables with `php artisan db:seed`
  - Build for production by running `yarn production`
  - (Optional) If you are working locally, use [Valet](https://laravel.com/docs/8.x/valet) to `valet link jernl && valet secure` the `public` directory. If you're deploying this to a live server, I'd recommend using [Forge](https://forge.laravel.com/)
  - Head over to the site in a browser and register for an account
  - Jernl.