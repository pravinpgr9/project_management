<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
             

            <div class="container" style="padding:50px;">
                <div class="jumbotron" style="background-color: yellow; border-radius: 20px;padding:40px">

                    <h1>Task Management System</h1>      
                    <p>A Task Management System is a software tool that helps to manage the Projects Tasks</p>

                    @if (Route::has('login'))
                        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Project Management App 2024</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                    
                </div>
                <br/>
                <div style="background-color: #405D76; border-radius: 20px;padding:40px; color: white;">

                <p>1. User should be able to sign up and login</p>
                <p>This feature allows users to create an account by signing up with their credentials and then log in to access the system.</p>
            
                <p>2. User should be able to Create, Update and Delete projects</p>
                <p>Users can create new projects, update existing project details, and delete projects that are no longer needed.</p>
            
                <p>3. Users should be able add tasks under specific project</p>
                <p>Tasks can be added under specific projects, enabling users to organize their work efficiently.</p>
            
                <p>4. Tasks should be editable and also can be deleted</p>
                <p>This feature allows users to modify task details such as title, description, deadline, etc., and also delete tasks if necessary.</p>
            
                <p>5. Tasks should be prioritized within a project</p>
                <p>Users can prioritize tasks within a project to manage their workload effectively, ensuring that important tasks are completed on time.</p>
            
                <p>6. Also tasks should have deadlines</p>
                <p>Tasks should have specified deadlines to help users prioritize their work and meet project milestones.</p>
            
                <p>7. Apply proper status (to-do, in-progress, done) of tasks</p>
                <p>Tasks can have different status labels such as "to-do", "in-progress", or "done" to indicate their current progress status.</p>
            
                <p>8. Users should have only access to his/her own projects and tasks</p>
                <p>This feature ensures that users can only access and manage projects and tasks that they are assigned to, providing data security and privacy.</p>
            
                <p>Under the task, the user can add comments and make sure the nested comment is applicable so that if we want to respond to the specific comment then we should be able to do that.</p>
                <p>- Comment should be deletable</p>
                <p>- Users can also attach files in comment and task description</p>
                </div>
            </div>
            

        </div>
    </body>
</html>
