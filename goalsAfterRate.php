<!DOCTYPE html>
<html dir="rtl" lang="he">
<head>
  <title>Drive2Success</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="addRate.css">
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
	  <span id="menuHeading" class="navbar-text ms-auto">&nbsp; דירוג חדש </span>
    <img class="logo d-block img-fluid" src="logo.png" alt="Logo">
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
// Connect to database
	    $host="localhost";
    	$user="isnivyn";
    	$pass="V_-usTic7id";
    	$db="isnivyn_Drive2Success";
    	$conn=new mysqli($host,$user,$pass,$db);
    	if ($conn->connect_error){
        		die("Something went wrong: ".$conn->connect_error);
    	}
$goal = $_POST['goal'];
$id = $_POST['id'];
mysqli_set_charset($conn, "utf8");

$rate=$_POST['rate'];
$comment=$_POST['comment'];
      
        $sql="insert into goals_$id(goal,rate, comment) values ('".$goal."','".$rate."','".$comment."') ON DUPLICATE KEY UPDATE rate = '$rate', comment = '$comment'";
   
        if ($conn->query($sql)==FALSE){
            echo "<p id='echoDesign'>לא ניתן להוסיף דירוג חדש, שגיאה:  .$conn->error </p>";
        }else{
            echo "<p id='echoDesign'>דירוג חדש נוסף בהצלחה!</p>";
        }
    ?>
     <div class="center">
        <button id="mainButton" onclick="window.location.href = 'goals.php?id=<?php echo $_POST['id']; ?>';"> למטרות אישיות </button>

    </div>
</main>


<footer class="mt-3" >
   <p class="text-center">ליצירת קשר חייגו 052-7455174</p>
  <p class="text-center">© מערכת Drive2Success</p>
</footer>
</body>
</html>