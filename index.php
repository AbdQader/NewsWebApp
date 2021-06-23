
<?php

session_start(); // to start session

// create connection to the database
$connection = new mysqli("localhost", "root", "");
if ($connection->connect_error)
{
	// if connection failed => print the error
    echo "Connection Failed : $connection->connect_error";
} else
{
	// if connection successful => go to login_screen.php
    echo "Connection Successfully";
	header("location: login_screen.php");
}

echo "<br>";

$useDatabase = "USE news_db"; // to select the database we want to work on it
$connection->query($useDatabase); // to execute the useDatabase query

// this code to get data from add_news.php and put it in the database
if (isset($_GET['add_submit']))
{
    $add_title = validate_input($_GET['news_title']);     // get news title
    $add_content = validate_input($_GET['news_content']); // get news content
    $add_author = validate_input($_GET['news_author']);   // get news author

    // this query to insert the data that user added it
    $insertQuery = "INSERT INTO news (news_title, news_content, news_author) VALUES ('$add_title', '$add_content', '$add_author');";
    $insertResult = $connection->query($insertQuery); // to execute the sql query

    // to show message when add any record "news"
    $_SESSION['message'] = "Record has been Added!";
    $_SESSION['msg_type'] = "success";

    // if the query successful go to home_page.php
    if ($insertResult)
    {
        echo "Added Successfully";
        header("location: admin_home.php");
    } else
    {
        echo "Added Failed $connection->error";
    }
}
// end of insert news in the database

// this code to get data from edit_news.php and update the data in the database
if (isset($_GET['edit_submit']))
{
    $edit_id = $_SESSION['id']; // get news id by session
    $edit_title = validate_input($_GET['news_title']);     // get news title
    $edit_content = validate_input($_GET['news_content']); // get news content
    $edit_author = validate_input($_GET['news_author']);   // get news author

    // this query to edit news in the database
    $updateQuery = "UPDATE news SET news_title = '$edit_title', news_content = '$edit_content', news_author = '$edit_author' WHERE news_id = $edit_id";
    $updateResult = $connection->query($updateQuery); // to execute the updateQuery query

    // if the query successful go to news_details.php
    if ($updateResult)
    {
        echo "Updated Successfully";
        header("location: news_details.php");
    } else
    {
        echo "Updated Failed $connection->error";
    }
}
// end of update news in the database

echo "<br>";

// this code for delete the news from the database when user click on the delete button in admin_home.php
if (isset($_GET['delete']))
{
    $id = $_GET['delete']; // get news id

    // this query to delete news from database
    $deleteQuery = "DELETE FROM news WHERE news_id = $id";
    $deleteResult = $connection->query($deleteQuery); // execute the deleteQuery query

    // to show message when delete any record "news"
    $_SESSION['message'] = "Record has been Deleted!";
    $_SESSION['msg_type'] = "danger";

    // if the query successful go to admin_home.php
    if ($deleteResult)
    {
        echo "Deleted Successfully";
        header("location: admin_home.php");
    } else
    {
        echo "Deleted Failed";
    }
}
// end of delete news from database

// this function to validate the input
function validate_input($input)
{
    return preg_replace('/[^A-Za-z0-9\-]/', ' ', $input); // Removes special chars.
}

echo "<br>";

// to close the connection
$connection->close();