<!DOCTYPE html>
<html dir="rtl" lang="he">
<head>
  <title>Drive2Success</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="addCar.css">
  <script>
function goBack() {
  window.history.back();
}
  </script>
</head>
<body>
<header class="container-fluid sticky-top">
  <nav class="navbar shadow p-3 mb-5 bg-body rounded " dir="rtl">
  <div class="container-fluid">
  <button  class="hamburgerMenu navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
  </button>
	  <span id="menuHeading" class="navbar-text ms-auto">&nbsp; עדכון פרטים   </span>
    <img class="logo d-block img-fluid" src="logo.png" alt="Logo">
    <div class="collapse navbar-collapse"  id="collapsibleNavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link me-3" href="homePage.php">דף הבית</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="students.php">תלמידים</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="tests.php">מבחנים</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3 active" href="classes.php">שיעורי נהיגה</a>
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
        $id = $_GET['id'];
        $date = $_GET['date'];
        $startTime = $_GET['startTime'];
 
        mysqli_set_charset($conn, "utf8");
        // Query the database for the data you want to display in the table
        $sql = "SELECT * FROM classes WHERE idStudent='$id' AND date='$date' AND startTime='$startTime'";
        $result = mysqli_query($conn, $sql);
       if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $endTime = $row["endTime"];
            $destination = $row["destination"];
            
        } else {
            echo "Class not found";
        }
        $conn->close();
        ?>
        <section class="container col-sm-5">
  		<form method="post" action="processClassUpdate.php?startTime=<?php echo $startTime; ?>&date=<?php echo urlencode($date); ?>&id=<?php echo $id; ?>" name="myForm" onsubmit="return validateForm()" novalidate>

				<h1 class="center"><b>הוספת שיעור נהיגה חדש</b></h1>
                  <div class="form-group">
                    <label for="id">תעודת זהות</label>
                    <input type="text" class=" typeText" id="id" name="id" autocomplete="on" value="<?php echo $id; ?>" required>
                  </div>
                <div class="form-group">
      				<label for="date">תאריך </label>
      				<input type="date" class="form-control" id="date" name="date" autocomplete="on" value="<?php echo $date; ?>" required>
    			</div>
				 <div class="row">
					 <div class="col-sm-6">
						 <label for="startTime">שעת התחלה</label>
						 <input type="time" class="form-control" id="startTime" name="startTime" autocomplete="on" value="<?php echo $startTime; ?>"required>
					 </div>
					  <div class="col-sm-6">
						 <label for="endTime">שעת סיום</label>
						 <input type="time" class="form-control" id="endTime" name="endTime" autocomplete="on" value="<?php echo $endTime; ?>"required>
					 </div>
				</div>
			
				<div class="form-group">
						<label for="destination">איסוף</label>
							<input type="text" class="form-control" id="destination" name="destination" autocomplete="on" value="<?php echo $destination; ?>"required>
				</div>
                
				<div style="text-align:center;">
					<button class="buttonSubmit" type="submit" onclick="window.location.href = 
        'processClassUpdate.php?startTime=<?php echo $startTime; ?>';">שלח</button>
					<button class="buttonSubmit" type="reset">מחק</button>
				</div>
			</form>
		</section>
</main>
<script src="validateClass.js"></script>
<footer class="mt-3" >
   <p class="text-center">ליצירת קשר חייגו 052-7455174</p>
  <p class="text-center">© מערכת Drive2Success</p>
</footer>
</body>
</html>