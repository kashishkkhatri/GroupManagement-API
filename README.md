# Backend API Documentation

This document provides an overview of the backend API endpoints and their usage for the Group Management System built using Laravel.


## Setup and Installation

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/your-username/your-repo.git
2. Navigate to the project directory:

    ```bash
    cd your-repo

3. Install Composer dependencies:
    
    ```bash
    composer install
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

