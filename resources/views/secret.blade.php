@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">


        <p align="center"><img src= "images\Logo.png"></p>
        <div>

            <h2> <center>About Loggregate</center> </h2>
            <br>
            <div class = "lead">
                <p>
                    Loggregate is a web application built to serve students of the University of Puget Sound. Loggregate acts as a mediator for students to create study groups for classes they are enrolled in. A user will find classes they are currently taking and subscribe to the corresponding course, allowing them to view all their groups of their subscribed classes. A user can then view and sign up for a study group under their subscribed courses.
                </p>
            </div>
        </div>


        <h2> <center> Using Loggregate</center> </h2>

        <div>
            <h5>• Front Page</h5>
            Users are first directed to a homepage. Users can login or register a new account to the application. First time users are prompted to create a user name and give their email and a password. They are then sent a verification email to the address they used to sign up with. 
        </div>
        <br>
        <div>
            <h5>• Home Page</h5>
            The home page contains all of the users subscribed classes. This allows a user to view study groups of the classes they are subscribed to by clicking on the class under their class tab. Study groups joined by the user also appear on the home page, allowing them to access that study group by clicking it under the users group tab.
        </div>
        <br>
        <div>
            <h5>• Course List Page</h5>
            The Course List Page contains a list of all current classes being taken during the current semester and the University of Puget Sound. The course list is sorted by the department tag. When a user clicks on a department, it provides the user with a list of courses under that department. Clicking on a class sends the user to the class's home page.
        </div>
        <br>
        <div>
            <h5>• Class Page</h5>
            A class page contains the name of the class and all its associated groups. A user can subscribe to the class on the page and once they are subscribed they are able to create a study group. Once a study group is created under the class page, the study group will appear and display the name of the group, meet time, meet day, and meet location. A user can view a group in more detail by clicking the view group button.
        </div>
        <br>
        <div>
            <h5>• Create Group Page</h5>
            When a user decides to create a group for a class, they are directed to the group creation page. The page will prompt the user to create a group name and give a description as to what the study group wants to accomplish. The user is also asked to specify days they want to meet, a time, and a location. Once a user has filled out this information they can create the group by hitting the create button. After successfully creating a group, a user is redirected to the groups new home page as a subscribed member.
        </div>
        <br>
        <div>
            <h5>• Group Page</h5>
            A group page is created when a user creates a group under their subscribed class. All users subscribed to the corresponding class can see the group under the class page. In the group page, A user can view the group name, meet times, location, and a more detailed description of the study groups goals. A button allows a user to join the group if they haven't already or leave if they are already a part of the group. A user can post comments if they are in the study group and view comments of other users in the study group.
        </div>
        <br>
        <div>
            <h5>• Subscribe to Courses Page</h5>
            The Subscribe to Courses Page contains a list of all current classes being taken during the current semester and the University of Puget Sound. The course list is sorted by the department tag. When a user clicks on a department, it provides the user with a list of courses under that department. A user will select multiple courses they want to subscribe to from the course list and add it to a user list. A user's class selection is displayed at the top of the page. Once a user selects all their desired courses, they can subscribe to all courses in their list by pressing the subscribe button. Successfully subscribing to classes notifies the user with an alert at the top of the page.
        </div>

    </div>

</div>
</div>
</div>
@endsection
