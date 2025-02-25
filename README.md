# BlueHorizon-Airline 💼

## Description
This project consists of an airline website where you can see the flights they have, book flights or delete booked flights. Also as an administrator you can take care of creating planes, flights, view who has booked flights, etc.


***
## Proyect guide
When we enter the website we find the main welcome page, we can click on start and it will take us to the list of all the flights available and we will be able to book one by clicking on the price button. Also in the header we can log in or register, once we log in we will have our user and we can either log out or access our bookings through it.


***
## :eye_speech_bubble: Project overview
![homView]()
![estacionesView](https://github.com/user-attachments/assets/6612d745-8359-4a5f-b232-6e60094180d6)
![showView](https://github.com/user-attachments/assets/f5e596c1-5307-4873-a91e-19c8a857eff0)


***
## Installation requierements
- XAMPP

- Install the composer

- Install NPM via Node.js

- Xdebug (to be able to see the coverage of the tests)

- Postman


***
## 💻 Installation
- Clone repository
```
https://github.com/Inma0711/BlueHorizon-Project.git
```
- Install the composer

```
composer install
```
- Install Nodejs

```
npm install
```

-Create an ‘.env’ file using the ‘.env.example’ file as an example and modify the lines:

    DB_CONNECTION=mysql
    DB_DATABASE=projectairline_db

-Generate all the tables and fake values:

```
php artisan migrate:fresh --seed
```
-Run Laravel:

```
php artisan serve
```
-Run npm:

```
npm run dev
```

***
## 📚 Database diagram
Here we find the project diagram which is made up of a single table
![tablaKataTollStation](https://github.com/user-attachments/assets/1a4f3321-017a-4aae-83c7-2493c8995e4c)


***
## API Endpoints
#### Stations
- To view the list of toll stations

```
http://127.0.0.1:8000/api/stations
```
- To be able to see a toll station

```
http://127.0.0.1:8000/api/stations/{id}
```
- In order to create a station

```
http://localhost:8000/api/stations
```
- In order to delete a station

```
http://127.0.0.1:8000/api/stations/{id}
```
#### Vehicles
- To view the list of toll vehicles

```
http://127.0.0.1:8000/api/vehicles
```
- To be able to see a toll vehicle

```
http://127.0.0.1:8000/api/vehicles/{id}
```
- In order to create a vehicle

```
http://localhost:8000/api/vehicles
```
- In order to delete a vehicle

```
http://127.0.0.1:8000/api/vehicles/{id}
```


***
## Test
This project has 72,6% test coverage.

-To test the tests and see the coverage in the terminal:

```
  php artisan test --coverage
```
![testKata](https://github.com/user-attachments/assets/f4fc7639-e503-46cb-bc2c-e1c07cabef2c)


***
## 🛠️Technologies and Tools

<a href='https://github.com/shivamkapasia0' target="_blank"><img alt='PHP' src='https://img.shields.io/badge/PHP-100000?style=for-the-badge&logo=PHP&logoColor=white&labelColor=777BB4&color=777BB4'/></a>
<a href='https://github.com/shivamkapasia0' target="_blank"><img alt='HTML5' src='https://img.shields.io/badge/HTML5-100000?style=for-the-badge&logo=HTML5&logoColor=white&labelColor=E34F26&color=E34F26'/></a>
<a href='https://github.com/shivamkapasia0' target="_blank"><img alt='CSS3' src='https://img.shields.io/badge/CSS3-100000?style=for-the-badge&logo=CSS3&logoColor=white&labelColor=1572B6&color=1572B6'/></a>
<a href='https://github.com/shivamkapasia0' target="_blank"><img alt='MySQL' src='https://img.shields.io/badge/MySQL-100000?style=for-the-badge&logo=MySQL&logoColor=white&labelColor=4479A1&color=4479A1'/></a>
<a href='https://github.com/shivamkapasia0' target="_blank"><img alt='Laravel' src='https://img.shields.io/badge/Laravel-100000?style=for-the-badge&logo=Laravel&logoColor=white&labelColor=FF2D20&color=FF2D20'/></a>

<a href='https://github.com/shivamkapasia0' target="_blank"><img alt='GitHub' src='https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=GitHub&logoColor=white&labelColor=181717&color=181717'/></a>
<a href='https://github.com/shivamkapasia0' target="_blank"><img alt='phpMyAdmin' src='https://img.shields.io/badge/phpMyAdmin-100000?style=for-the-badge&logo=phpMyAdmin&logoColor=white&labelColor=6C78AF&color=6C78AF'/></a>
<a href='https://github.com/shivamkapasia0' target="_blank"><img alt='Postman' src='https://img.shields.io/badge/Postman-100000?style=for-the-badge&logo=Postman&logoColor=white&labelColor=FF6C37&color=FF6C37'/></a>
<a href='https://github.com/shivamkapasia0' target="_blank"><img alt='XAMPP' src='https://img.shields.io/badge/XAMPP-100000?style=for-the-badge&logo=XAMPP&logoColor=white&labelColor=FB7A24&color=FB7A24'/></a>