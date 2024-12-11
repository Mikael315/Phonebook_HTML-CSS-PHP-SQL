<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login.php');
    exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'id21003530_bebicmikael';
$DATABASE_PASS = '12345-Bebic';
$DATABASE_NAME = 'id21003530_login';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions, so instead, we can get the results from the database.
$stmt = $con->prepare('SELECT name, email, password FROM login WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($name, $email,$password);
$stmt->fetch();
$stmt->close();

?>






<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        :root {

            /*  HEADER  */

            --header-text-color: white;
            --header-button-color: #1d50e0;
            --header-button-color-hover: #1d50e0;
            --header-border-color: #404040;

            /*  SIDEBAR  */
            --side-bar-bg-color: #0c164f;
            --sidebar-bg-color-highlight: #3e3f48;
            --sidebar-text-color: whitesmoke;
            --sidebar-border-color: #404040;

            /*  MAIN CONTENT  */
            --main-content-color: #202225;
            --content-headers: whitesmoke;
            --main-content-title-color: #dbdde0;
            --main-content-text-color: #A0A9BC;

            /*  CARDS  */
            --card-bg-color: #2f3036;
            --card-border-color: dimgray;
            --card-icon-color: white;
            --project-card-highlight: #1d50e0;

            /*  TRENDING  */
            --trending-text-color: #dbdde0;

            /*  OTHER  */
            --margin-top: 5px;
            --hot-magenta: #7649fe;
        }

        * {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            display: grid;
            grid-template-columns: 250px 5fr;
            grid-template-rows: 250px 5fr;
            height: 100vh;
        }

        a {
            text-decoration: none;
        }

        a:visited {
            color: black
        }

        /*  HEADER  */

        .header {
            background-color: #800080;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url('b.gif');
            grid-row: 1;
            grid-column: 2;
            display: grid;
            grid-template-rows: 1fr 2fr;
            grid-template-columns: auto;
            padding-left: 50px;
            padding-right: 50px;
            border-bottom: 1px solid var(--header-border-color);
        }


        .search-bar {
            display: grid;
            grid-column: 1;
            grid-template-columns: 2;
            grid-template-rows: 0;
            align-content: center;
            align-items: center;
            margin-right: auto;
        }

        .search-icon,
        .fa.solid {
            grid-column: 1;
            font-size: 1.3rem;
            color: var(--main-content-text-color);
        }

        .search-bar>input {
            outline: none;
            border: none;
            grid-column: 2;
            margin-left: 15px;
            width: 200%;
            height: 1.1rem;
            background-color: #e2e7f0;
            padding: 10px 20px;
            border-radius: 30px;
        }

        .user-menu {
            grid-column: 2;
            display: grid;
            grid-template-columns: 3;
            align-content: center;
            align-items: center;
            margin-left: auto;
            grid-gap: 20px;
        }

        .notifications,
        .fa-bell-on {
            font-size: 1.4rem;
            color: var(--main-content-text-color);
        }

        .user-avatar-small {
            height: 40px;
            width: 40px;
            background-color: #fff;
            background-image: url('33.png');
            background-repeat: no-repeat;
            background-size: cover;


            border-radius: 50%;
            display: inline-block;
        }

        .user-display-name {
            color: var(--header-text-color);
            grid-column: 3;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .welcome-user {
            display: grid;
            grid-template-columns: 2;
            grid-template-rows: 1;
            grid-row: 2;
            grid-column: 1;
            align-content: center;
            align-items: center;
            margin-right: auto;
            grid-gap: 20px;
            color: var(--header-text-color);
            position: relative;
            bottom: 2em;
        }

        .user-avatar-large {
            height: 70px;
            width: 70px;
            background-color: #fff;
            background-image: url('d.gif');
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 50%;
            display: inline-block;
            grid-column: 1;
        }

        .greeting {
            grid-column: 2;
            grid-gap: 20px;
            font-weight: 700;
        }

        .greeting-user {
            font-size: 1.5rem;
        }

        .menu {
            grid-row: 2;
            align-self: center;
            grid-column: 2;
            margin-left: auto;
        }

        .menu-button {
            background-color: #3d6ffb;;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            width: 110px;
            height: 0px;
            border-radius: 30px;
            margin-left: 20px;
            padding: 10px 25px;
            position: relative;
    right: 5em;
    bottom: 20px;
        }

        .menu-button:hover {
            background-color: var(--header-button-color-hover);
        }

        .menu-button:visited {
            color: white;
        }

        /*  SIDEBAR  */

        .sidebar {
            background-color: #2f3036;
            grid-row: 1 / 3;
            grid-column: 1;
            color: var(--sidebar-text-color);
            display: grid;
            align-content: flex-start;
            grid-gap: 50px;
            border-right: 1px solid var(--sidebar-border-color);
        }

        .logo-container>.logo-text {
            font-size: 1.7rem;
            font-weight: 600;
            padding-left: 20px;
            padding-top: 3em;
        }

        ul.menu {
            padding-left: 0;
        }

        .menu-item {
            font-size: 1.2rem;
            line-height: 40px;
            text-decoration: none;
            list-style-type: none;
            padding-left: 20px;
            font-weight: 700;
            color: white;
            margin: auto;
        }

        .menu-item:visited {
            color: white;
        }

        .menu-item:hover {
            background-color: var(--sidebar-bg-color-highlight);
            border-left: 7px solid var(--project-card-highlight);
        }


        /*  MAIN CONTENT  */
        .main-content {
            background: var(--main-content-color);
            background-repeat: no-repeat;
            background-size: cover;
            
            grid-template-columns: 3fr minmax(300px, 400px);
        }

        .main-content-header {
            margin-top: 20px;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--content-headers);
        }

        .projects-header {
            margin-left: 20px;
            color: var(--content-headers);
        }

        /*  PROJECTS  */

        .projects {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            grid-row: 1;
            grid-column: 1;
            grid-gap: 20px;
            padding: 20px;
            align-self: flex-start;
        }

        .card-container {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-row: 2 / -1;
            grid-column: 1;
            grid-gap: 30px;
            padding: 20px;
            align-self: flex-start;
        }

        .card {
            box-sizing: border-box;
            border-radius: 7px;
            background-color: var(--card-bg-color);
            padding: 2rem 2rem 1.5rem;
            border: 1px solid transparent;
        }

        .project-card:hover {
            border-top: 1px solid dimgray;
            border-right: 1px solid dimgray;
            border-bottom: 1px solid dimgray;
        }

        .project-card {
            border-left: 7px solid var(--project-card-highlight);

        }

        .card-title {
            color: var(--main-content-title-color);
            font-size: 1.1rem;
            font-weight: 700;
        }

        .card-text {
            color: var(--main-content-text-color);
            margin-top: var(--margin-top);

            /* Used to limit text to three */
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-buttons {
            display: flex;
            justify-content: flex-end;
            grid-gap: 1rem;
            margin-top: 20px;
        }

        .card-icons {
            color: var(--card-icon-color);
        }

        /*  ANNOUNCEMENTS  */

        hr.solid {
            border-top: 1px solid #bbb;
        }

        .announcements {
            display: grid;
            grid-column: 2 / -1;
            grid-row: 1;
            align-self: flex-start;
            grid-gap: 15px;
            margin-top: 20px;
            margin-right: 20px;
        }

        .announcement-title:hover {
            color: var(--hot-magenta);
        }

        .announcement-title {
            font-weight: 600;
            color: var(--main-content-title-color);
        }

        .announcement-text {
            color: var(--main-content-text-color);
            font-size: 14px;
            margin-top: var(--margin-top);
        }

        .trending {
            display: grid;
            grid-column: 2 / -1;
            grid-row: 2;
            grid-gap: 20px;
            margin-top: 20px;
            margin-right: 20px;
        }

        .trending-links {
            color: var(--main-content-title-color);
            font-weight: 600;
        }

        .trending-links:visited {
            color: var(--main-content-title-color);
            font-weight: 600;
        }

        .trending-links:hover {
            color: var(--hot-magenta);
        }

        .trending-title {
            margin-top: var(--margin-top)
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0ac95c350b.js" crossorigin="anonymous"></script>
    <title>Phonebook Home Page</title>
</head>

<body>
    <div class="container">
        <div class="header">

            <div class="welcome-user">
                <div class="user-avatar-large"></div>
                <div class="greeting">
                    <div class="greeting-text">Hi there,</div>
                    <div class="greeting-user"><?= $_SESSION['name'] ?> (<?= $email ?>)</div>
                </div>
            </div>

            <div class="menu">
                <a class="menu-button" href="create.php">Add New Contacts</a>
                <a class="menu-button" href="contacts.php">View Contacts</a>
            </div>

        </div>

        <div class="sidebar">
            <div class="logo-container">
                <img src="" alt="" class="logo">
                <div class="logo-text">Phonebook</div>
            </div>
            <div class="side-menu-primary">
                <a href="" class="">
                    <ul class="menu">
                        <a href="phonebook.php">
                        <li class="side-menu-home menu-item">Dashboard</li>
                        </a>
                         <a href="profile.php">
                        <li class="side-menu-profile menu-item">Profile</li>
                        </a>
                        <a href="contacts.php">
                        <li class="side-menu-messages menu-item">Contacts</li>
                        </a>
                    </ul>
                </a>
            </div>
            <div class="side-menu-secondary">
                <a href="logout.php">
                    <ul class="menu">
                        <li class="side-menu-settings menu-item">Logout</li>
                    </ul>
                </a>

            </div>
        </div>

        <div class="main-content">

            <div class="projects-container">
                <div class="projects-header main-content-header">User Profile</div>
                <div class="projects">
                  
                        <!-- CARDS  -->
                        <div class="project-card card">
                            <a href="">
                                <div class="card-title"><?= $_SESSION['name'] ?></div>
                                <div class="card-text"> 
                                    Email: <?= $email ?><br>
                                    Password :  <?= $_SESSION['name'] ?> <br>
                                </div>
                            </a>
                            <div class="card-buttons">
                                <a href="">
                                    <div class="card-icon-favorite card-icons"><i class="fa-regular fa-star"></i></div>
                                </a>
                                <a href="">
                                    <div class="card-icon-follow card-icons"><i class="fa-regular fa-eye"></i></div>
                                </a>
                                <a href="">
                                    <div class="card-icon-share card-icons"><i class="fas fa-share-alt"></i></div>
                                </a>
                            </div>
                        </div>
              
                </div>
            </div>


        </div>
    </div>

</body>

</html>