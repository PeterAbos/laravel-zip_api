# LARAVEL REST API - ZIP API

## Endpoints

| URL           | HTTP method | Auth | JSON Response     |
| ------------- | ----------- | ---- | ----------------- |
| /users/login  | POST        |      | user's token      |
| /users        | GET         | Y    | all users         |
| /counties     | GET         |      | all counties      |
| /counties/:id | GET         |      | a county by id    |
| /counties     | POST        | Y    | new county addedn |
| /counties     | PUT         | Y    | edited county     |
| /counties     | DELETE      | Y    | id                |
| /cities       | GET         |      | all cities        |
| /cities/:id   | GET         |      | a city by id      |
| /cities       | POST        | Y    | new city addedn   |
| /cities       | PUT         | Y    | edited city       |
| /cities       | DELETE      | Y    | id                |