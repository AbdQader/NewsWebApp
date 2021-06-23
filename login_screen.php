
<?php

session_start(); // to start the session

session_unset(); // to clear the session

// create connection to the database
$connection = new mysqli("localhost", "root", "");

$useDatabase = "USE news_db"; // to select the database we want to work on it
$connection->query($useDatabase); // to execute the useDatabase query

// this variables to catch any error
$usernameError = $emailError = $passwordError = $confirmPasswordError = "";

// when user login
if (isset($_POST['login']))
{
    $login_email = $login_password = "";

    if (empty(validate_input($_POST['email'])))
    {
        $emailError = "border-bottom: 1px solid crimson";
    } else
    {
        $login_email = $_POST['email'];
    }

    if (empty(validate_input($_POST['password'])))
    {
        $passwordError = "border-bottom: 1px solid crimson";
    } else
    {
        $login_password = $_POST['password'];
    }

    // if no error check if user is exist in the database
    if (empty($emailError) && empty($passwordError))
    {
        $selectQuery = "SELECT * FROM users"; // this query to get all users from database
        $users = $connection->query($selectQuery); // to execute the selectQuery

        // check if the table has any user
        if ($users->num_rows > 0)
        {
            // to get every user
            while ($row = $users->fetch_assoc())
            {
                // check if email and password is exist in the database go to admin_home.php
                if ($login_email == $row['user_email'] && $login_password == $row['user_password'])
                {
                    $_SESSION['email'] = $login_email; // stored the email in the session
                    $_SESSION['user_state'] = "user signed in";
                    header("location: admin_home.php");
                } else
                {
                    echo "<script>alert('this user is not exist! try again or sign up')</script>";
                    break;
                }
            }
        } else
        {
            echo "<script>alert('this user is not exist! try again or sign up')</script>";
        }

    }
}

// when user register
if (isset($_POST['register']))
{
    $register_username = $register_email = $register_password = $register_confirmPassword = "";

    if (empty(validate_input($_POST['username'])))
    {
        $usernameError = "border-bottom: 1px solid crimson";
    } else
    {
        $register_username = $_POST['username'];
    }

    if (empty(validate_input($_POST['email'])))
    {
        $emailError = "border-bottom: 1px solid crimson";
    } else
    {
        $register_email = $_POST['email'];
    }

    if (empty(validate_input($_POST['password'])))
    {
        $passwordError = "border-bottom: 1px solid crimson";
    } else
    {
        $register_password = $_POST['password'];
    }

    if ($_POST['confirm_password'] == $register_password)
    {
        $register_confirmPassword = $_POST['confirm_password'];
    } else
    {
        $confirmPasswordError = "border-bottom: 1px solid crimson";
    }

    // if no error insert the user and go to admin_home.php
    if (empty($usernameError) && empty($emailError) && empty($passwordError) && empty($confirmPasswordError))
    {
        // this query to insert new user in the database
        $insertUser = "INSERT INTO users (user_name, user_email, user_password) VALUES ('$register_username', '$register_email', '$register_password');";
        $result = $connection->query($insertUser); // execute the insertUser query
        // check if inserted successfully go to admin_home.php
        if ($result)
        {
            $_SESSION['username'] = $register_username; // stored the username in the session
            $_SESSION['user_state'] = "user register";
            echo "user added successfully";
            header("location: admin_home.php");
        } else
        {
            echo "user added failed : $connection->error";
        }
    }
}

// this function to validate the input
function validate_input($input)
{
    $input = htmlspecialchars($input);
    $input = trim($input);
    $input = stripslashes($input);
    $input = preg_replace('/[^A-Za-z0-9\-]/', '', $input);
    return $input;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login & Registration</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="css/sourcesanspro-font.css">
    <!-- Main Style Css -->
    <link rel="stylesheet" type="text/css" href="css/style_login.css"/>
</head>
<body class="form-v8">
	<div class="page-content">
		<div class="form-v8-content">
			<div class="form-left">
				<img width="469" height="584" src="img/news.jpg" alt="form">
			</div>
			<div class="form-right">
				<div class="tab">
					<div class="tab-inner">
						<button class="tablinks" onclick="openCity(event, 'sign-up')" id="defaultOpen">Sign Up</button>
					</div>
					<div class="tab-inner">
						<button class="tablinks" onclick="openCity(event, 'sign-in')">Sign In</button>
					</div>
				</div>
				<form class="form-detail" action="login_screen.php" method="post">
					<div class="tabcontent" id="sign-up">
						<div class="form-row">
							<label class="form-row-inner">
								<input style="<?php echo $usernameError ?>" type="text" name="username" value="<?php if (!empty($register_username)) echo $register_username?>" id="full_name" class="input-text" required>
								<span class="label">Full Name</span>
		  						<span class="border"></span>
							</label>
						</div>
						<div class="form-row">
							<label class="form-row-inner">
								<input style="<?php echo $emailError ?>" type="email" name="email" value="<?php if (!empty($register_email)) echo $register_email?>" id="your_email" class="input-text" required>
								<span class="label">E-Mail</span>
		  						<span class="border"></span>
							</label>
						</div>
						<div class="form-row">
							<label class="form-row-inner">
								<input style="<?php echo $passwordError ?>" type="password" name="password"  id="password" class="input-text" required>
								<span class="label">Password</span>
								<span class="border"></span>
							</label>
						</div>
						<div class="form-row">
							<label class="form-row-inner">
								<input style="<?php echo $confirmPasswordError ?>" type="password" name="confirm_password" id="confirm_password" class="input-text" required>
								<span class="label">Confirm Password</span>
								<span class="border"></span>
							</label>
						</div>
						<div style="display: inline" class="form-row-last">
							<input type="submit" name="register" class="register" value="Register">
                            <div style="display:inline">
                                <a style="float: right; padding: 11px; text-align: center; text-decoration: none" href="home_page.php" class="register">Guest</a>
                            </div>
                        </div>
					</div>
				</form>
				<form class="form-detail" action="login_screen.php" method="post">
					<div class="tabcontent" id="sign-in">
						<div class="form-row">
							<label class="form-row-inner">
								<input style="<?php echo $emailError ?>" type="email" name="email" value="<?php if (!empty($login_email)) echo $login_email?>" id="your_email_1" class="input-text" required>
								<span class="label">E-Mail</span>
		  						<span class="border"></span>
							</label>
						</div>
						<div class="form-row">
							<label class="form-row-inner">
								<input style="<?php echo $passwordError ?>" type="password" name="password" id="password_1" class="input-text" required>
								<span class="label">Password</span>
								<span class="border"></span>
							</label>
						</div>
						<div class="form-row-last">
							<input style="" type="submit" name="login" class="register" value="Sign In">
                            <div style="display:inline">
                                <a style="float: right; padding: 11px; text-align: center; text-decoration: none" href="home_page.php" class="register">Guest</a>
                            </div>
                        </div>
					</div>
				</form>
            </div>
		</div>
	</div>
	<script type="text/javascript">
		function openCity(evt, cityName) {
		    var i, tabcontent, tablinks;
		    tabcontent = document.getElementsByClassName("tabcontent");
		    for (i = 0; i < tabcontent.length; i++) {
		        tabcontent[i].style.display = "none";
		    }
		    tablinks = document.getElementsByClassName("tablinks");
		    for (i = 0; i < tablinks.length; i++) {
		        tablinks[i].className = tablinks[i].className.replace(" active", "");
		    }
		    document.getElementById(cityName).style.display = "block";
		    evt.currentTarget.className += " active";
		}

		// Get the element with id="defaultOpen" and click on it
		document.getElementById("defaultOpen").click();
	</script>

</body>
</html>