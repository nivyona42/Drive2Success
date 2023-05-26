<!DOCTYPE html>
<html dir="rtl" lang="he">
<head>
  <title>Drive2Success</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/goals.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
  $(document).ready(function(){
			// Handle click event on student row
			$('table tr').click(function(){
				var goal = $(this).find('td:first').text(); 
            var id = "<?php echo str_pad($_GET['id'], 9, '0', STR_PAD_LEFT); ?>";
			window.location.href = 'addRate.php?goal=' + goal + '&id=' + id
			});
		});

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
      <span id="menuHeading" class="navbar-text ms-auto">&nbsp; מטרות לימוד </span>
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
  <table class="marginAuto centerText" id="goals">
  <tr>
    <th>מטרה</th>
    <th>דירוג</th>
    <th>הערה</th>
  </tr>
    <?php
// Connect to database
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
$sql = "SELECT firstName, lastName FROM students WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows>0) {
    $row = mysqli_fetch_assoc($result);
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];

    echo "<p class='echoDesign'>תלמיד:$firstName $lastName</p>";
    echo "<p class='echoDesign'>תעודת זהות:$id</p>";
  } else {
    echo "Student not found";
  }


// Fetch goals for the selected student
$sql = "SELECT * FROM goals_" . $id;
$result = $conn->query($sql);


if ($result->num_rows>0){
    while($row = $result->fetch_assoc()) { 
        echo "<tr><td>" . $row["goal"] . "</td><td>" . $row["rate"] . "</td><td>" . $row["comment"] . "</td></tr>";
    }
} else {
  echo "No goals found for this student.";
}

$sql = "SELECT COUNT(*) FROM goals_$id WHERE rate < 100";
$result = $conn->query($sql);
$count = $result->fetch_assoc()['COUNT(*)'];
if ($count == 0) {
    $sql = "SELECT * FROM classes WHERE idStudent='$id'";
    $result = mysqli_query($conn, $sql);
    $num_class = mysqli_num_rows($result);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    $sql1 = "SELECT numForGoals FROM students WHERE id='$id'";
    $result1 = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_assoc($result1);
    $numForGoals = $row['numForGoals'];
    if ($numForGoals == 0){
        $sql = "UPDATE students SET numForGoals = $num_class WHERE id = '$id'";
        mysqli_query($conn, $sql);
    }
} 
$currentDate = date("Y-m-d");
date_default_timezone_set('Asia/Jerusalem');
$currentTime = date("H:i:s");

// Fetch the classes that have already occurred based on the date
$sql = "SELECT * FROM classes WHERE idStudent = '$id' AND date < '$currentDate'";
$result = mysqli_query($conn, $sql);
$num_class1 = mysqli_num_rows($result);

$sql = "SELECT * FROM classes WHERE idStudent = '$id' AND date = '$currentDate' AND endTime <= '$currentTime'";
$result = mysqli_query($conn, $sql);
$num_class2 = mysqli_num_rows($result);
$num_class =  $num_class1+$num_class2;

$sql = "SELECT COUNT(*) FROM goals_$id";
$result = $conn->query($sql);
$countTotal = $result->fetch_assoc()['COUNT(*)'];

if ($num_class >= 20 && $countTotal*0.8>$count) {
    $sql = "SELECT email, firstName FROM admin";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $userEmail = $row['email'];
    $name = $row['firstName'];

    $subject = "Goal Accomplishment Alert";
    $message = "Dear $name,\n\nThis is to inform you that the student with ID $id has not accomplished 80% from his goals after 20 classes. Please take necessary actions.\n\nBest regards,\nThe Drive2Success Team";
    $headers = "From: nivyona42@gmail.com"; // Replace with your email address or the desired sender email address
    mail($userEmail, $subject, $message, $headers);
}
$conn->close();
?>
</table>
</main>

<footer class="mt-3" >
   <p class="text-center">ליצירת קשר חייגו 052-7455174</p>
  <p class="text-center">© מערכת Drive2Success</p>
</footer>
</body>
</html>

