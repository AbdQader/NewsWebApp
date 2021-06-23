
<?php

session_start(); // to start session

// to check if the user login or register
if (!isset($_SESSION['username']) && !isset($_SESSION['email']))
{
    // to show an alert for the user, and if user press ok we will take him to login screen
    echo '<script type="text/javascript">
            alert("You must sign in first");
            window.location= "login_screen.php";
            </script>';
    //header("location: login_screen.php"); // go to login_screen.php
}

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

echo "<br>";

$sql = "SELECT * FROM news"; // this query to get all data from database
$news = $connection->query($sql); // to execute the sql query

?>
<!-- *** End Of PHP Code *** -->

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
    <title>Admin_Home</title>

</head>
<body>

<?php

   if (isset($_SESSION['message'])) { ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

        <?php
           echo $_SESSION['message'];   // print the message
           unset($_SESSION['message']); // clear the session message
        ?>
    </div>

<?php } ?>

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

<br><br><br>

<!-- Add New News Button-->
<div>
    <h2 class="admin_title">Your All News</h2>
    <a id="admin_add_news" type="button" class="btn btn-primary" href="add_news.php">Add News</a>
</div>

<br><br><br>

<!-- this table to show all the news that in the database -->
<table id="admin_news_table" class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col">Content</th>
        <th scope="col">Author</th>
        <th scope="col">Date</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>

    <!-- *** Beginning Of PHP Code *** -->
    <?php

    // this while to get every record "news" and show it in the table
    while ($row = $news->fetch_assoc())
    {
    ?>
        <tr>
            <td><?php echo $row["news_id"] ?></td>
            <td><?php echo $row["news_title"] ?></td>
            <td><?php echo $row["news_content"] ?></td>
            <td><?php echo $row["news_author"] ?></td>
            <td><?php echo $row["news_date"] ?></td>
            <td>
                <a class="btn btn-primary" href="edit_news.php?edit=<?php echo $row["news_id"] ?>">Edit</a>
                <a class="btn btn-danger" href="index.php?delete=<?php echo $row["news_id"] ?>">Delete</a>
            </td>
        </tr>

    <?php
    }
    ?>
    <!-- *** End Of PHP Code *** -->

    </tbody>
</table>

<br><br>

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
