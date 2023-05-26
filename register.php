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
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id=$_POST['id'];
        $firstName=$_POST['fname'];
        $lastName=$_POST['lname'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $userName=$_POST['userName'];
        $password1=$_POST['pass1'];
        $password2=$_POST['pass2'];

        // check if password1 and password2 match
        if ($password1 !== $password2) {
            $error_msg1 = "הסיסמאות אינן תואמות";
            header("Location: register.php?errorOne=$error_msg1 &id=$id &firstName=$firstName &lastName=$lastName &email=$email &phone=$phone");
            exit();
        }
        $sql = "SELECT * FROM users WHERE userName='$userName'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $error_msg2 = "שם המשתמש תפוס, אנא בחר שם משתמש אחר";
              header("Location: register.php?errorTwo=$error_msg2 &id=$id &firstName=$firstName &lastName=$lastName &email=$email &phone=$phone");
            exit();;
        }
        $config_file = fopen("config.php", "w");
        fwrite($config_file, "<?php\n");
        fwrite($config_file, "\$username = '$userName';\n");
        fwrite($config_file, "?>\n");
        fclose($config_file);
        // insert new user into database
        $sql="INSERT INTO users(id, firstName, lastName, email, phone, userName, password) 
              VALUES ('$id','$firstName','$lastName','$email','$phone','$userName','$password1')";
        if ($conn->query($sql) === FALSE){
            echo "<p class='echoDesign'>לא ניתן להוסיף משתמש חדש, שגיאה:  ".$conn->error."</p>";
        } else {
            header("Location:homePage.php");
            exit();
        }
    }
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
  <link rel="stylesheet" type="text/css" href="css/registerPage.css">

</head>
<body>
    <script src="scripts/validateRegister.js"></script>
    <main>
        <div class="image">
             <div class="line"><img src="photos/logo.png"></div>
             <div class="littleSpace"></div>
    <section class="container col-sm-5">
  			<form method="post" action="register.php" name="myForm" onsubmit="return validateForm()" novalidate>
				<h1 class="centerText"><b>יצירת משתמש חדש</b></h1>
				 <div class="row">
					 <div class="col-sm-6">
						 <label for="fname">שם פרטי</label>
						 <input type="text" class=" typeText" id="fname" name="fname" autocomplete="on" value="<?php echo $_GET['firstName'] ?>" required>
					 </div>
					 <div class="col-sm-6">
						 <label for="lname">שם משפחה</label>
						 <input type="text" class=" typeText" id="lname" name="lname" autocomplete="on" value="<?php echo $_GET['lastName'] ?>" required>
    				</div>
				 </div>
				<div class="form-group">
                <label for="id">תעודת זהות </label>
                    <?php
                    $id = str_replace(' ', '', $_GET['id']);
                    ?>
                    <input type="text" id="id" name="id" autocomplete="on" value="<?php echo $id; ?>" required>
                 </div>

   				 <div class="form-group">
      				<label for="email">כתובת מייל</label>
      				<input type="email" id="email" name="email" autocomplete="on" value="<?php echo $_GET['email'] ?>" required>
    			</div>
				<div class="form-group">
      				<label for="phone">מספר טלפון</label>
      				<input type="tel" id="phone" name="phone" value="<?php echo $_GET['phone'] ?>" autocomplete="on" required>
    			</div>
				<div class="form-group">
      				<label for="userName">שם משתמש</label>
      				<input type="text" class="form-control" id="userName" name="userName" autocomplete="on" required>
    			</div>
    			<?php
                    if(isset($_GET['errorTwo'])) {
                        $error_msg = $_GET['errorTwo'];
                        echo "<p style='color:red;' class='error-msg'>$error_msg</p>";
                    }
                ?>
				<div class="form-group">
      				<label for="pass1">סיסמא</label>
      				<input type="password" id="pass1"  name="pass1" required>
    			</div>
    			<div class="form-group">
      				<label for="pass2">אימות סיסמא</label>
      				<input type="password" id="pass2"  name="pass2" required>
    			</div>
    	        <?php
                    if(isset($_GET['errorOne'])) {
                        $error_msg = $_GET['errorOne'];
                        echo "<p style='color:red;' class='error-msg'>$error_msg</p>";
                    }
                ?>
				<div style="text-align:center;">
					<button class="buttonSubmit" type="submit">שלח</button>
					<button class="buttonSubmit" type="reset">מחק</button>
				</div>
			</form>
		</section>
		</div>
		
</main>
    
</body>
</html>
