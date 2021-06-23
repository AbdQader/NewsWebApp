
<?php

session_start(); // to start session

// create connection to the database
$connection = new mysqli("localhost", "root", "");
if ($connection->connect_error)
{
    echo "Connection Failed : $connection->connect_error"; // if connection failed
} else
{
    echo "Connection Successfully"; // if connection successful
}

echo "<br>";

$useDatabase = "USE news_db"; // to select the database we want to work on it
$connection->query($useDatabase); // to execute the useDatabase query

$sql = "SELECT * FROM news"; // this query to get all data from database
$news = $connection->query($sql); // to execute the sql query

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
    <title>Home</title>

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

<!-- this image for splash -->
<img id="splash" src="img/news.jpg" class="img-fluid" alt="Responsive image">

<!-- Beginning Of PHP Code -->
<?php

$i = 0; // this variable for images
// this while to get every record "news" and show it in the HTML
while ($row = $news->fetch_assoc())
{
    $i = $i + 1;
?>

<!-- this div is a card to show the news details -->
<div id="news_card" class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img id="home_news_image" src="img/<?php echo $i ?>.jpg" class="card-img" alt="News Image">
        </div>
        <div id="card_width" class="col-md-8">
            <div class="card-body">
                <a class="card-title" href="news_details.php?details=<?php echo $row["news_id"]; ?>">
                    <h4 class="home_news_title"><?php echo $row["news_title"]; ?></h4>
                </a>
                <p id="home_news_content" class="card-text">
                    <?php echo $row["news_content"]; ?>
                </p>
                <p class="card-text"><small class="text-muted"><?php echo $row["news_date"]; ?></small></p>
            </div>
        </div>
    </div>
</div>

<?php  } ?>
<!-- *** End Of PHP Code *** -->

<!-- Bootstrap Links -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>

<?php
// to close the connection
$connection->close();
?>
