# Video App

Simple SPA which allows users to:

- create and login to an account,
- upload and remove videos,
- sort them in playlists, collect statistics,
- provide similar videos according to the users recently watched videos,
- search videos using multiple criterias

Essentially making a VERY simplified version of Youtube.
This project is made to prepare for the SkillsLatvia 2024 finals.

## Tech stack

**Client:** ReactJS (v18.2.0), TailwindCSS

**API:** Laravel (v11), Docker + Sail

## Deploy

This is a quick step-by-step guide how the get the project running on your local machine

### API deployment

1. Navigate to the API folder: `cd api`
2. Install vendors: `composer install`
3. Sail up: `./vendor/bin/sail up`
4. Run database migrations: `./vendor/bin/sail artisan migrate`
5. Run database seeders: `./vendor/bin/sail artisan db:seed`

### Frontend deployment

1. Navigate to the client folder: `cd client`
2. Install node modules: `npm install`
3. Start it up: `npm start`