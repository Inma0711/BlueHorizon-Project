# BlueHorizon-Airline 💼

## Description
This project consists of an airline website where you can see the flights they have, book flights or delete booked flights. Also as an administrator you can take care of creating planes, flights, view who has booked flights, etc.


***
## Proyect guide
When we enter the website we find the main welcome page, we can click on start and it will take us to the list of all the flights available and we will be able to book one by clicking on the price button. Also in the header we can log in or register, once we log in we will have our user and we can either log out or access our bookings through it.


***
## :eye_speech_bubble: Project overview

![homeBlueAirline](https://github.com/user-attachments/assets/cd564260-9906-41da-9c79-9642baef613f)
![login](https://github.com/user-attachments/assets/a665f2a8-5e2b-4005-95dd-3173d7a43692)
![registrer](https://github.com/user-attachments/assets/1505c911-e89b-4247-b06f-e854522f748a)

### View User
![flightList](https://github.com/user-attachments/assets/19232fd8-32d7-4dd1-8257-527ff442bd28)
![myReservations](https://github.com/user-attachments/assets/5dfd6c4c-1d8e-4485-9063-ecfbd9458a7f)

### View Admin
![reserveListAdmin](https://github.com/user-attachments/assets/e9ccfa8c-dfc0-46bd-9a04-7e5cd1091267)
![listAircraftAdmin](https://github.com/user-attachments/assets/3661633d-5a85-4141-bd07-1609a83f7843)
![flightList](https://github.com/user-attachments/assets/16388559-ec19-4fb1-a5c3-de1fd733baa6)



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
![diagramBlueHorizon](https://github.com/user-attachments/assets/22999137-65f5-4754-be6f-d02645dccaa4)




***
## API Endpoints
#### Planes
- To see the list of aircraft

```
http://localhost:8000/api/planes
```
- Being able to see a plane
```
http://localhost:8000/api/planes/{id}
```
- In order to create a plane

```
http://localhost:8000/api/planes
```
- In order to delete a plane

```
http://localhost:8000/api/planes/{id}
```
-In order to modify an aircraft

```
http://localhost:8000/api/planes/{id}
```
#### Flights
- To see a list of flights

```
http://localhost:8000/api/flights
```
- To be able to see a flight

```
http://localhost:8000/api/flights/{id}
```
- In order to create a flight

```
http://localhost:8000/api/flights
```
- In order to delete a flight

```
http://localhost:8000/api/flights/{id}
```
-In order to modify an flights

```
http://localhost:8000/api/flights/{id}
```

***
## 👾 Test
This project has 79% test coverage.

-To test the tests and see the coverage in the terminal:

```
  php artisan test --coverage
```
![testHorizon](https://github.com/user-attachments/assets/28ea4c36-a1e1-48bb-bb3f-b7e789be19ab)




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


***
## :bust_in_silhouette: Author
- **Inma González**: [https://github.com/Inma0711](https://github.com/Inma0711)


***
## Thanks for reading!
Have a nice day :)

