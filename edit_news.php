
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

echo "<br>";

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
    <title>Edit_News</title>

</head>

<body class="edit_news_body">

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

// this code to get the news and put its data in HTML fields when the user clicks on the update button in admin_home.php
if (isset($_GET['edit']))
{
    $id = $_GET['edit']; // get news id

    $_SESSION['id'] = $id; // stored the id in the session

    // this query to get the record "news" that we want to edit it
    $updateQuery = "SELECT * FROM news WHERE news_id = $id";
    $updateResult = $connection->query($updateQuery); // to execute updateResult query

    // $updateResult->num_rows; // to get number of rows, recommended way
    // count($updateResult);    // to get number of rows, it will show a warning

    // if a number of rows equal 1, get his data
    if ($updateResult->num_rows == 1)
    {
        $row = $updateResult->fetch_array();
        $title = $row['news_title'];     // get news title
        $content = $row['news_content']; // get news content
        $author = $row['news_author'];   // get news author
    }
}

?>
<!-- *** End Of PHP Code *** -->

<!-- this div is a card as a container for form -->
<div id="edit_news_form" class="card">
    <h5 style="color: dodgerblue; font-weight: bold;" class="card-header">Edit News</h5>
    <div class="card-body">

        <!-- this form to edit the news -->
        <form action="index.php" method="get">
            <label for="title">Title</label>
            <input class="form-control" id="title" name="news_title" type="text" value="<?php echo $title ?>" placeholder="Enter New Title" required>
            <br>
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="news_content" rows="5" placeholder="Enter New Content" required><?php echo $content ?></textarea>
            <br>
            <label for="author">Author</label>
            <input class="form-control" id="author" name="news_author" type="text" value="<?php echo $author ?>" placeholder="Enter New Author" required>
            <br>
            <input class="btn btn-primary" type="submit" name="edit_submit" value="Save">
        </form>

    </div>
</div>

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
