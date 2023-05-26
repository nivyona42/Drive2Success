<!DOCTYPE html>
<html dir="rtl" lang="he">
<head>
  <title>Drive2Success</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/addRate.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function(){
  $('#rate').on('input', function(){
    $('#rate-display').text(this.value);
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
      <span id="menuHeading" class="navbar-text ms-auto"> &nbsp;דירוג חדש  </span>
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
    <section class="container col-sm-5">
        
           <?php
// Connect to database
        $host="localhost";
    	$user="isnivyn";
    	$pass="V_-usTic7id";
    	$db="isnivyn_Drive2Success";
    	$conn=new mysqli($host,$user,$pass,$db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['goal'])) {
  $goal = $_GET['goal'];

}
if (isset($_GET['id'])) {
   $id = trim($_GET['id']);
  $id = str_pad($id, strlen($id) - strlen(ltrim($id, '0')), '0', STR_PAD_LEFT);
}


mysqli_set_charset($conn, "utf8");
echo "<p id='echoDesign'> $goal - הוספת דירוג חדש</p>";
$conn->close();
?>
        
  			<form method="post" action="goalsAfterRate.php" name="myForm" onsubmit="return validateForm()" novalidate>
  			     <input type="hidden" name="goal" value="<?php echo $goal; ?>">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
			<label for="rate">דירוג:</label>
<input type="range" id="rate" name="rate" min="0" max="100" step="10">
<div id="rate-display"></div>

                <div class="mb-3 mt-3">
						<label for="comment">הערה</label>
						<textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
					</div>
					
<div style="text-align:center;">
	<button class="buttonSubmit" type="submit" onckick="window.location.href = 'goalsAfterRate.php'">שלח</button>
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








