<p align="center"><img src="http://i.imgur.com/6YknGdj.png"></p>

A compound front-end website and web-portal for the organization, League of Students for Excellence of Holy Angel University. Final course requirement for 6SOFTENG.

## Project Features
1. Member Registration and Login.
2. Event/Seminar Registration
3. Real Time Video Chat Conference (RTC Multiconnection)
4. Real time text chat
5. File sharing capabilities (Max limit of 1MB for files).
6. Data encryption of personal or senstive information (CSRF, MD5 Hashing).
7. Automated / Manual sending of group emails to members (Free sendgrid account from Git Student Developer Pack).
8. Automated / Manual sending of text messages to members. (Requires an android phone with SMS Gateway API installed.)
9. Member management sytem (CRUD) with filtering functionalities.
10. Events management system (CRUD) with filtering functionalities.
10. Role level based accounts

## Project Dependencies
1. Laravel 5.4
2. Bootstrap 3.3.7
3. jQuery 3.x
4. [DataTables](https://github.com/DataTables/DataTables) 1.10.15 plugin for jQuery
5. [RTC MultiConnection JS](https://github.com/muaz-khan/RTCMultiConnection) v3
6. MySQL 7.xx
7. [SMSGateway](https://smsgateway.me/) v3

**Note:** Additional dependencies may be required by the above listed modules.

## Installing Project Dependencies
As of the moment, automatic installation of the project dependencies is only available through the use of <b>composer</b>. Simply use the composer and package .json file on the root directory of the project. 

## Using the web portal
1. Ensure that the .env file has the correct database name, credentials, and host url.
2. Simply run the database migrations in the command line. Navigate to the root project directory and run <b>php artisan migrate</b>
3. Wait for a few seconds as laravel would be creating the necessary tables for the application. Also, dummy data is seeded to these tables through the use of Laravel's factories.
4. Run the application in a development server with <b>php artisan serve</b>

## Developers
* Bituin, Joemel (Backend)
* Jimenez, John Joshua (Project lead, backend)
* Orayle, Jerez (UI and Design)

## License
GNU Affero General Public License v3.0. For a more detailed explanation, check it out [here.](https://github.com/jjjimenez100/A-Silent-Voice/blob/master/LICENSE)
