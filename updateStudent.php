<!DOCTYPE html>
<html dir="rtl" lang="he">
<head>
  <title>Drive2Success</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/addCar.css">
  <script>
function goBack() {
  window.history.back();
}
  </script>
</head>
<body>
    <script src="scripts/validateStudent.js"></script>
<header class="container-fluid sticky-top">
  <nav class="navbar shadow p-3 mb-5 bg-body rounded " dir="rtl">
  <div class="container-fluid">
  <button  class="hamburgerMenu navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
  </button>
	  <span id="menuHeading" class="navbar-text ms-auto">&nbsp; עדכון פרטים   </span>
    <img class="logo d-block img-fluid" src="photos/logo.png" alt="Logo">
    <div class="collapse navbar-collapse"  id="collapsibleNavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link me-3" href="homePage.php">דף הבית</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3 active" href="students.php">תלמידים</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="tests.php">מבחנים</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="classes.php">שיעורי נהיגה</a>
        </li>
         <li class="nav-item">
          <a class="nav-link me-3" href="cars.php">כלי רכב</a>
        </li>
      </ul>
  </div>
</div>
<button onclick="goBack()" class="back-btn">חזור <span class="arrow">&rarr;</span></button>
</nav>
</header>
<main>
    <?php
        // Connect to the database
      	    $host="localhost";
    	$user="isnivyn";
    	$pass="V_-usTic7id";
    	$db="isnivyn_Drive2Success";
    	$conn=new mysqli($host,$user,$pass,$db);
    	if ($conn->connect_error){
        		die("Something went wrong: ".$conn->connect_error);
    	}
        if (isset($_GET['id'])) {
              $id = trim($_GET['id']);
              $id = str_pad($id, strlen($id) - strlen(ltrim($id, '0')), '0', STR_PAD_LEFT);
            
            
        } else {
            echo 'Error: ID not provided.';
        }
        mysqli_set_charset($conn, "utf8");
        
        $sql = "SELECT * FROM students WHERE id='$id' ";
        
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        
            $firstName = $row["firstName"];
            $lastName = $row["lastName"];
            $email = $row["email"];
            $phone = $row["phone"];
            $birthday = $row["birthday"];
            $city = $row["city"];
            $education = $row["education"];
            $street = $row["street"];
            $apartment = $row["apartment"];
            $license = $row["license"];
        
        } else {
            echo "student not found";
        }
        $conn->close();
        ?>
        
         <section class="container col-sm-5">
  			<form method="post" action="processStudentUpdate.php?idS=<?php echo $_GET['id']; ?>" name="myForm" onsubmit="return validateForm()" novalidate>
				<h1 class="center"><b>עדכון פרטי תלמיד </b></h1>
				 <div class="form-group">
      				<label for="id">תעודת זהות</label>
      				<input type="text" id="id" name="id" autocomplete="on" value="<?php echo $id; ?>" required>
    			</div>
				 <div class="row">
					 <div class="col-sm-6">
						 <label for="fname">שם פרטי</label>
						 <input type="text" class=" typeText" id="fname" name="fname" autocomplete="on" value="<?php echo $firstName; ?>"required>
					 </div>
					 <div class="col-sm-6">
						 <label for="lname">שם משפחה</label>
						 <input type="text" class=" typeText" id="lname" name="lname" autocomplete="on" value="<?php echo $lastName; ?>"required>
    				</div>
				 </div>
				  </div>
                <div class="form-group">
                    <label for="education">השכלה</label>
                    <select id="education" class="form-group mb-3" name="education" required>
                        <option value="תיכונית" <?php if ($education == 'תיכונית') echo 'selected'; ?>>תיכונית</option>
                        <option value="על-תיכונית" <?php if ($education == 'על-תיכונית') echo 'selected'; ?>>על-תיכונית</option>
                    </select>
                </div>

   				 <div class="form-group">
      				<label for="email">כתובת מייל</label>
      				<input type="email" id="email" name="email" autocomplete="on" value="<?php echo $email; ?>"required>
    			</div>
				<div class="form-group">
      				<label for="phone">מספר טלפון</label>
      				<input type="tel" id="phone" name="phone" autocomplete="on" value="<?php echo $phone; ?>" required>
    			</div>
				<div class="form-group">
      				<label for="birthday">תאריך לידה</label>
      				<input type="date" class="form-control" id="birthday" name="birthday" autocomplete="on" value="<?php echo $birthday; ?>"required>
    			</div>
				<div class="form-group">
      				<label for="city">עיר מגורים</label>
      				<input type="text" id="city"  name="city" autocomplete="on" value="<?php echo $city; ?>" required>
    			</div>
				<div class="row">
					<div class="col-sm-6">
						<label for="street">רחוב</label>
						 <input type="text" class="typeText" id="street" name="street" autocomplete="on" value="<?php echo $street; ?>"required>
					</div>
					<div class="col-sm-6">
						<label for="apart">מספר</label>
						 <input type="number" class=" typeText" id="apart" name="apart" autocomplete="on" value="<?php echo $apartment; ?>" required>
					</div>
				<div class="row">
					<div class="col-sm-6">
						<label for="license">רישיון נהיגה</label>
							<select id="license" class="form-group mb-3" name="license" required>
								<option value="אוטומט B" <?php if ($license == 'אוטומט B') echo ' selected'; ?> >אוטומט B  </option>
								<option value="ידני B" <?php if ($license == 'ידני B') echo ' selected'; ?> >ידני B </option>
							</select>
						</div>
						<div class="col-sm-6">
						</div>
					</div>
				</div>
				<div style="text-align:center;">
					<button class="buttonSubmit" type="submit">עדכן</button>
					<button class="buttonSubmit" type="reset">מחק</button>
				</div>
			</form>
		</section>
</main>
<footer class="mt-3" >
   <p class="text-center">ליצירת קשר חייגו 052-7455174</p>
  <p class="text-center">© מערכת Drive2Success</p>
</footer>
</body>
</html>