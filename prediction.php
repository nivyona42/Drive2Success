<!DOCTYPE html>
<html dir="rtl" lang="he">
<head>
  <title>Drive2Success</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="addTest.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  	<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pyscript/0.7.1/pyscript.js"></script>
      <script>
function goBack() {
  window.history.back();
}
  </script>
</head>
<body>
<header class="container-fluid sticky-top" >
  <nav class="navbar shadow p-3 mb-5 bg-body rounded " dir="rtl">
  <div class="container-fluid">
  <button  class="hamburgerMenu navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
  </button>
      <span id="menuHeading" class="navbar-text ms-auto"> &nbsp; חיזוי הצלחה </span>
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
          <a class="nav-link me-3 active" href="tests.php">מבחנים</a>
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
	   	$host="localhost";
    	$user="isnivyn";
    	$pass="V_-usTic7id";
    	$db="isnivyn_Drive2Success";
    	$conn=new mysqli($host,$user,$pass,$db);
    	if ($conn->connect_error){
        		die("Something went wrong: ".$conn->connect_error);
    	}
        $conn->set_charset("utf8mb4");
        
        $id=$_POST['id'];
        $grade=$_POST['grade'];
        
        $sql = "SELECT * FROM students WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        		    $row = mysqli_fetch_assoc($result); 
        		    $birthday=new DateTime($row["birthday"]);
        		    $gender=$row["gender"];
        		    $license = str_replace('"', '', $row["license"]);
        		    $education=$row["education"];
        		    $numForGoals=$row["numForGoals"];
        		    
        		    $today = new DateTime(); // Get current date
                    $age = $today->diff($birthday)->y; // Calculate age in years
                    
                    $currentDate = date("Y-m-d");
                    date_default_timezone_set('Asia/Jerusalem');
                    $currentTime = date("H:i:s");
                    $sql = "SELECT * FROM classes WHERE idStudent = '$id' AND date < '$currentDate'";
                    $result = mysqli_query($conn, $sql);
                    $num_class1 = mysqli_num_rows($result);
                    $sql = "SELECT * FROM classes WHERE idStudent = '$id' AND date = '$currentDate' AND endTime <= '$currentTime'";
                    $result = mysqli_query($conn, $sql);
                    $num_class2 = mysqli_num_rows($result);
                    $num_class =  $num_class1+$num_class2;
            
                    $csv = fopen('testSet.csv', 'a');
                    fputcsv($csv, array($num_class, $numForGoals, $gender, $age, $license, $education,$grade));
                    fclose($csv);
                    $command = 'python3.9 app.py';
                    $output=exec($command);
                    echo $output;
                    
                    
        }else{
            echo "<p class='echoDesign'>התלמיד לא נמצא</p>";
        }
       
    $conn->close();
?>


</main>
    
</body>
</html>