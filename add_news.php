
<?php

session_start();

// to check if the user sign in or sign up
if (!isset($_SESSION['username']) && !isset($_SESSION['email']))
{
    // to show an alert for the user, and if user press ok we will take him to login screen
    echo '<script type="text/javascript">
            alert("You must sign in first");
            window.location= "login_screen.php";
            </script>';
    //header("location: login_screen.php"); // go to login_screen.php
}

?>

<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap Link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- style.css Link -->
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- Site Title -->
    <title>Add_News</title>

</head>

<body class="add_news_body">

<!-- beginning of nav bar -->
<nav id="nav" class="navbar navbar-expand-lg navbar-light bg-light">

    <!-- this for logo -->
    <a class="navbar-brand" href="#">
        <img class="logo" src="img/logo.png" width="150" height="30" alt="" loading="lazy">
    </a>

    <!-- this for nav bar items -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="home_page.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add_news.php">Add News</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_home.php">Admin Home</a>
            </li>
            <li class="nav-item">
                <a style="margin-left: 800px; border: 2px solid dodgerblue; border-radius: 15%; padding: 5px" class="nav-link" href="login_screen.php">
                    <?php
                    if (isset($_SESSION['user_state'])) { echo "Sign out";} else { echo "Sign in";}
                    ?>
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- end of nav bar -->

    <!-- this div is a card as a container for form -->
    <div id="add_news_form" class="card">
        <h5 style="color: dodgerblue; font-weight: bold;" class="card-header">Add New News</h5>
        <div class="card-body">

            <!-- this form for add new news -->
            <form action="index.php" method="get">
                <label for="title">Title</label>
                <input class="form-control" id="title" name="news_title" type="text" placeholder="Enter News Title" required>
                <br>
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="news_content" rows="5" placeholder="Enter News Content" required></textarea>
                <br>
                <label for="author">Author</label>
                <input class="form-control" id="author" name="news_author" type="text" placeholder="Enter News Author" required>
                <br>
                <input class="btn btn-primary" type="submit" name="add_submit" value="Add New News">
            </form>

        </div>
    </div>

<!-- Bootstrap Links -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>
