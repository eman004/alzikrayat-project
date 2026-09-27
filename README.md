# Alzikrayat — Photo Sharing Web Application

## Project Name

Alzikrayat (Advanced Web Technologies — Course Project 1)

## Simple Description

Alzikrayat is a photo sharing web app I built for this project. The main rule was no frameworks (no Laravel, no ORM, no routing library), so I wrote my own small MVC structure and my own router in plain PHP instead of using something ready-made. The goal was to actually understand how these things work under the hood instead of just calling functions that a framework normally handles for me.

The app lets you register, log in, upload photos to a shared gallery, look at other people's photos, and leave comments. Passwords are hashed with Bcrypt, login state is handled with sessions, and there's a cookie that remembers your last login for 7 days.

## Technologies

- Backend: PHP (plain OOP, no framework), PDO for the database
- Database: MySQL 
- Frontend: HTML5, CSS3, Bootstrap 5, a bit of JavaScript
- Local server: Apache through XAMPP

## What's included

- A manual router I wrote myself (core/Router.php) that uses regex to match routes like /photo/{id} — no routing library
- One entry point for the whole app (public/index.php), with .htaccess redirecting everything there
- Controllers, Models, and Views kept in separate folders (MVC)
- Register and login with Bcrypt password hashing
- Sessions for login state, and the navbar changes depending on whether you're logged in
- A last_login cookie that lasts 7 days
- Photo upload with a check on file extension before saving
- A gallery page showing all photos, and a detail page for each one with its comments
- You can only delete your own photos, not other people's
- All SQL queries use PDO prepared statements, so no raw string concatenation of user input
- User input like comments gets passed through htmlspecialchars() before being stored

## Project structure

- config/ — the database connection file
- core/ — the base Model, base Controller, and the Router
- controllers/ — AuthController, PhotoController, CommentController
- models/ — User, Photo, Comment
- views/ — split into auth/, photos/, and layout/
- public/ — index.php, .htaccess, and the images/uploads/ folder where uploaded photos actually get saved

## Routes

- GET / — homepage / gallery
- GET /about — about page
- GET /photo/create — upload form
- POST /photo/store — handles the upload
- GET /photo/{id} — view one photo and its comments
- GET /photo/{id}/delete — delete a photo (only if it's yours)
- POST /comment/store — add a comment
- GET /login and POST /login — login page and login handling
- GET /register and POST /register — register page and register handling
- GET /logout — logs you out

## Database

Three tables, connected with foreign keys:

- users: id, first_name, last_name, email (unique), password (Bcrypt hash), location, occupation, description
- photos: id, user_id (linked to users), file_name, title, description, date_time
- comments: id, photo_id (linked to photos), user_id (linked to users), comment, date_time

Run the SQL setup script first to create the alzikrayat_db database and these tables before using the app.

## How to Run

1. Install XAMPP and start Apache and MySQL from the control panel.
2. Put the project folder inside htdocs, for example C:\xampp\htdocs\alzikrayat.
3. Open phpMyAdmin, create a database called alzikrayat_db, and run the provided SQL script to create the tables.
4. Open config/database.php and make sure the host, database name, username and password match your own MySQL setup.
5. Go to http://localhost/alzikrayat/public/ in your browser.
6. Register an account and start uploading.

## Security notes

- Passwords are never saved as plain text, only as Bcrypt hashes.
- Every query goes through PDO prepared statements instead of building SQL strings by hand.
- Comments and other user input are sanitized with htmlspecialchars() before being stored.
- Only jpg, jpeg, png and gif files are accepted for upload, checked on the server side.
- Every action that changes something (uploading, deleting, commenting) checks that you're logged in first, and deleting also checks that the photo is actually yours.

## Known limitations

- Right now client-side validation is just HTML5 (required, pattern attributes). I still want to add proper JavaScript validation on top of that before the final submission.
- There's no extra feedback for weak passwords or duplicate emails beyond the database rejecting a duplicate email automatically.

## Student Name

Emam Elrashid Abdalgaer
