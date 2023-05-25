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
	   $host="localhost";
    	$user="isnivyn";
    	$pass="V_-usTic7id";
    	$db="isnivyn_Drive2Success";
    	$conn=new mysqli($host,$user,$pass,$db);
    	if ($conn->connect_error){
        		die("Something went wrong: ".$conn->connect_error);}
        $conn->set_charset("utf8mb4");
        
        if (isset($_GET['idS'])) {
            $prevId = trim($_GET['idS']);
            $prevId = str_pad($prevId, strlen($prevId) - strlen(ltrim($prevId, '0')), '0', STR_PAD_LEFT);
        }


        $id=$_POST['id'];
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $birthday=$_POST['birthday'];
        $city=$_POST['city'];
        $street=$_POST['street'];
        $apart=$_POST['apart'];
        $license=$_POST['license'];
  
// Create a new table with the same structure
$sql = "CREATE TABLE goals_$id (
        goal VARCHAR(200) PRIMARY KEY,
        rate INT(2) DEFAULT 0,
        comment VARCHAR(200)
        )";

if ($conn->query($sql) === FALSE) {
    echo "Error creating new table: " . $conn->error;
    $conn->close();
    exit;
}

// Duplicate the data from previous table to new table
$sql = "INSERT INTO goals_$id SELECT * FROM goals_$prevId";

if ($conn->query($sql) === FALSE) {
    echo "Error duplicating data: " . $conn->error;
    $conn->close();
    exit;
}

// Drop the previous table
$sql = "DROP TABLE goals_$prevId";
if ($conn->query($sql) === FALSE) {
    echo "Error dropping table: " . $conn->error;
    $conn->close();
    exit;
}
      

        $sql = "UPDATE students SET id='$id', firstName='$fname', lastName='$lname',email='$email', phone='$phone', birthday='$birthday', city='$city',street='$street',apartment='$apart',license='$license'  WHERE id='$prevId'";

        if ($conn->query($sql) == FALSE) {
            echo "<p class='echoDesign'>לא ניתן לעדכן את פרטי התלמיד , שגיאה: " . $conn->error . "</p>";
        } else {
            echo "<p class='echoDesign'>פרטי התלמיד עודכנו בהצלחה!</p>";
        }
    ?>
     <div class="center">
        <button class="mainButton" onclick="window.location.href = 'students.php';"> לרשימת התלמידים </button>
    </div>
</main>

<footer class="mt-3" >
   <p class="text-center">ליצירת קשר חייגו 052-7455174</p>
  <p class="text-center">© מערכת Drive2Success</p>
</footer>
</body>
</html>