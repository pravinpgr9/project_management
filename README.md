Task Management System

## About Project

This is a Laravel application that serves as a sample tool to manage and control tasks of projects similar to Jira. It provides various features to help users organize and track tasks efficiently.

## Features

1. User Authentication: Users can sign up and log in to access the system securely.

2. Project Management: Users can create, update, and delete projects.

3. Task Management: Users can add tasks under specific projects, edit them, and delete them as needed. Tasks can be prioritized, assigned deadlines, and categorized with proper statuses (to-do, in-progress, done).

4. Comments: Users can add comments to tasks, and nested comments are supported. This allows for threaded discussions and responses to specific comments. Comments can also be deleted.

5. File Attachments: Users can attach files to both tasks and comments, providing additional context or documentation.

6. Access Control: Users have access only to their own projects and tasks, ensuring data privacy and security.

7. Automated Tests: The application includes automated tests for all functionality, ensuring reliability and correctness.

## Installation

1. Clone the repository: git clone [<repository-url>](https://github.com/pravinpgr9/project_management.git)

2. Navigate to the project directory: cd project_management

3. Install composer dependencies: composer install

4. Copy the .env.example file to .env and configure your environment variables, including the database connection details.

5. Generate an application key: php artisan key:generate

6. Run database migrations: php artisan migrate

7. Serve the application: php artisan serve

## Project ScreenShots

