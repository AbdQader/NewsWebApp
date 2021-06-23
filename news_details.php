
<?php

session_start(); // to start session

// create connection to the database
$connection = new mysqli("localhost", "root", "");
if ($connection->connect_error)
{
    echo "Connection Failed : $connection->connect_error";
} else
{
    echo "Connection Successfully";
}

echo "<br>";

$useDatabase = "USE news_db"; // to select the database we want to work on it
$connection->query($useDatabase); // to execute the useDatabase query

?>
<!-- *** End Of PHP Code *** -->

<!DOCTYPE html>
<html lang="zxx" class="no-js">
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
    <title>News_Details</title>

</head>

<body>

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

<!-- *** Beginning Of PHP Code *** -->
<?php

// this code to get the news data when user click on any news in home_page.php. "its come from home_page.php"
if (isset($_GET['details']))
{
    $id = $_GET['details']; // get news id

    // this query to get the news from the database when news_id equals id
    $selectQuery = "SELECT * FROM news WHERE news_id = $id";
    $result = $connection->query($selectQuery); // execute the selectQuery query

    $row = $result->fetch_array();
    $title = $row['news_title'];     // get news title
    $content = $row['news_content']; // get news content
    $author = $row['news_author'];   // get news author
    $date = $row['news_date'];       // get news date

} else
{
    // its come from admin_home.php
    if (isset($_SESSION['id']))
    {
        $id = $_SESSION['id']; // get news id by session

        // this query to get the news from the database when news_id equals id
        $selectQuery = "SELECT * FROM news WHERE news_id = $id";
        $result = $connection->query($selectQuery); // to execute the selectQuery query

        $row = $result->fetch_array();
        $title = $row['news_title'];     // get news title
        $content = $row['news_content']; // get news content
        $author = $row['news_author'];   // get news author
        $date = $row['news_date'];       // get news date
    }
}

?>
<!-- *** End Of PHP Code *** -->

<!-- this div to show the news details -->
<div class="news_details">
    <p style="font-size: 30px; margin-right: 20%; margin-top: 5%;" class="news_details_title"><?php echo $title ?></p>
    <!-- this for news image -->
    <img style="margin-top: 2%" src="img/news_defails.jpg" alt="news image">
    <blockquote style="margin-top: 3%" class="news_details_content">
        <?php echo $content ?>
    </blockquote>
    <p class="news_details_author_date">Date : <span style="color: dodgerblue"><?php echo $date ?></span> </p>
    <p class="news_details_author_date">Author : <span style="color: dodgerblue"><?php echo $author ?></span> </p>
</div>

<!-- *** End Of PHP Code *** -->

<!-- Bootstrap Links -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>

<?php
// to close connection
$connection->close();
?>
