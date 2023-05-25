<!DOCTYPE html>
<html dir="rtl" lang="he">
<head>
  <title>Drive2Success</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="addStudent.css">
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
	  <span id="menuHeading" class="navbar-text ms-auto">&nbsp; עדכון פרטים </span>
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
	   $host="localhost";
    	$user="isnivyn";
    	$pass="V_-usTic7id";
    	$db="isnivyn_Drive2Success";
    	$conn=new mysqli($host,$user,$pass,$db);
    	if ($conn->connect_error){
        		die("Something went wrong: ".$conn->connect_error);}
        $conn->set_charset("utf8mb4");
        
        $prevTime = $_GET['startTime'];
        $prevId = $_GET['id'];
        $prevDate = $_GET['date'];
   

        $idStudent = $_POST["id"];
        $date = $_POST["date"];
        $startTime = $_POST["startTime"]; 
        $endTime = $_POST["endTime"];
        $destination = $_POST["destination"];
        
        $sql = "UPDATE classes SET idStudent='$idStudent', date='$date', startTime='$startTime',endTime='$endTime', destination='$destination' WHERE idStudent='$prevId' AND date='$prevDate' AND startTime='$prevTime'";
    

               if ($conn->query($sql) == FALSE) {
            echo "<p class='echoDesign'>לא ניתן לעדכן את פרטי שיעור הנהיגה , שגיאה: " . $conn->error . "</p>";
        } else {
            echo "<p class='echoDesign'>פרטי שיעור הנהיגה עודכנו בהצלחה!</p>";
        }
    ?>
     <div class="center">
        <button class="mainButton" onclick="window.location.href = 'classes.php';"> לרשימת שיעורי הנהיגה </button>
    </div>
</main>

<footer class="mt-3" >
   <p class="text-center">ליצירת קשר חייגו 052-7455174</p>
  <p class="text-center">© מערכת Drive2Success</p>
</footer>
</body>
</html>