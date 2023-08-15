# Backend API Documentation

This document provides an overview of the backend API endpoints and their usage for the Group Management System built using Laravel.


## Setup and Installation

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/kashishkkhatri/GroupManagement-API.git
2. Navigate to the project directory:

    ```bash
    cd GroupManagement-API

3. Install Composer dependencies:
    
    ```bash
    composer install
4. Copy the .env.example file to .env:
    ```bash
    cp .env.example .env
5. Set up your database connection: (You will need to create a new database in mySQL and update the env vars to access that created database.)    <br /><br />Example:
    <br />
DB_CONNECTION=mysql<br />
DB_HOST=127.0.0.1<br />
DB_PORT=3306<br />
DB_DATABASE=group_management_system<br />
DB_USERNAME=root<br />
DB_PASSWORD=<br />
6. Update API keys, and any other required settings.
Generate the application key:
    ```bash
    php artisan key:generate
6. Run database migrations to create the necessary tables:
     ```bash
    php artisan migrate
7. For this basic level application, a seeder is implemented to create pre-existing users for our groups. Create the users:
    ```bash
    php artisan db:seed --class=UsersTableSeeder
8. Start the development server:
    ```bash
    php artisan serve
Your backend API should now be accessible at http://localhost:8000.

## API Endpoints
### List Groups
&emsp;-URL: /api/groups<br />&emsp;-Method: GET<br />
&emsp;-Description: Retrieve a list of all groups with associated users.<br />
&emsp;-Response: Returns a JSON response containing an array of group objects.

### Create Group
&emsp;-URL: /api/groups<br />&emsp;-Method: POST<br />&emsp;-
Description:  Create a new group.<br />&emsp;-Request body:<br />&emsp;&emsp;- name: (string:required): The name of the group<br/>&emsp;&emsp;- group_code: (string:required): The unique code of the group. <br />&emsp;&emsp; - description:(string:optional): Description of the group.<br />
&emsp; - Response: Returns a JSON response containing the newly created group.

### Show Group
&emsp; -URL: /api/groups/{id}<br />&emsp; -Method: GET<br />&emsp; -
Description: Retrieve details of a specific group by ID.<br />&emsp; -
Response: Returns a JSON response containing the group details and associated users.

### Update Group
&emsp; -URL: /api/groups/{id}s<br />&emsp; -Method: PUT<br />&emsp; -
Description:   Update the details of a specific group by ID.<br />&emsp; -Request body: Same as the Create Group request body.<br />&emsp; -
Response: Returns a JSON response containing the updated group.

### Delete Group
&emsp; - URL: /api/groups/{id}<br />&emsp; - Method: DELETE<br />&emsp; -
Description: Delete a specific group by ID.<br />&emsp; -
Response: Returns a JSON response with no content.

## Running Tests

To run the unit tests for the backend, execute the following command:

    php artisan test

