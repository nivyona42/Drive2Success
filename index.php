<?php
   	    $host="localhost";
    	$user="isnivyn";
    	$pass="V_-usTic7id";
    	$db="isnivyn_Drive2Success";
    	$conn=new mysqli($host,$user,$pass,$db);
    	if ($conn->connect_error){
        		die("Something went wrong: ".$conn->connect_error);
    	}
    $conn->set_charset("utf8mb4");

    // Check if form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the username and password from the form submission
        $username = $_POST['username'];
        $password = $_POST['password'];
        // Query the users table to check if the username and password are valid
        $sql = "SELECT * FROM users WHERE userName='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        // Check if a row was found
        if (mysqli_num_rows($result) > 0) {
            $config_file = fopen("config.php", "w");
            fwrite($config_file, "<?php\n");
            fwrite($config_file, "\$username = '$username';\n");
            fwrite($config_file, "?>\n");
            fclose($config_file);
            
            // Login successful
            header("Location: homePage.php");
            exit();
        } else {
            // Login failed, set error message
            $error_msg = "שם משתמש או סיסמא שגויים";
        }
    }

    // Close the database connection
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html dir="rtl" lang="he">
<head>
  <title>Drive2Success</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="loginPage.css">
</head>
<body>
<div class="image">
    <div class="line"><img src="logo.png"></div>
    <div class="remainDiv">
        <div class="centerDiv">
            <form action="index.php" method="post"> 
                <p class="text">התחברות לחשבונך</p>
                <label class="text" for="username">שם משתמש:</label>
                <input type="text" class="typeText" id="username" name="username" required>
                <label class="text" for="password">סיסמא:</label>
                <input type="password" class="typeText" id="password" name="password" required><br>
                <?php
                    // Display error message if set
                    if (isset($error_msg)) {
                        echo "<p style='color:red'>$error_msg</p>";
                    }
                ?>
                <input class="mainButton" type="submit" value="התחבר">
                <input class="mainButton" type="button" onclick="window.location.href = 'register.php'" value="להרשמה">
            </form>
        </div>
    </div>
</div>
</body>
</html>
