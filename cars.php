<!DOCTYPE html>
<html dir="rtl" lang="he">
<head>
  <title>Drive2Success</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="cars.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
			$("#carList").hide();
  			$("#warning").click(function(){
    			$("#carList").fadeToggle();
  			});
  			$('table tr:not(:first)').click(function(){
			    var id = $(this).find('td:first').text(); 
			    window.location.href = 'detailsCar.php?id=' + id;
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
      <span id="menuHeading" class="navbar-text ms-auto"> &nbsp;כלי רכב </span>
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
          <a class="nav-link me-3" href="classes.php">שיעורי נהיגה</a>
        </li>
         <li class="nav-item">
          <a class="nav-link me-3 active" href="cars.php">כלי רכב</a>
        </li>
      </ul>
  </div>
</div>
<button onclick="goBack()" class="back-btn">חזור <span class="arrow">&rarr;</span></button>
</nav>
</header>
<main>
   
   <div class="centerText">
  <button class="add-user-btn mainButton" onclick="window.location.href='addCar.html'">
  <svg id="svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z"/></svg> כלי רכב חדש
</button>
  </div>
  <div class="littleSpace"></div>
   <button id="warning" class="blink mainButton">שים לב!</button><br>
    <table class="marginAuto centerText" id="cars">
  <tr>
    <th> מספר רכב </th>
    <th>יצרן</th>
    <th>מחיר לשיעור</th>
    <th>תאריך פקיעת ביטוח</th>
  </tr>

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
mysqli_set_charset($conn, "utf8");
// Query the database for the data you want to display in the table
$sql = "SELECT * FROM cars";
$result = mysqli_query($conn, $sql);
echo "<div class='littleSpace'></div>";
// Generate the table HTML dynamically based on the query result
if (mysqli_num_rows($result) > 0) {
    $list = array();
    while($row = mysqli_fetch_assoc($result)) {
        // Check if the insurance date is within one week of expiring
        $insuranceDate = strtotime($row["insuranceDate"]);
        $expirationDate = strtotime("+1 week");
        if ($insuranceDate < $expirationDate) {
            // Add the car ID to the list
            $list[] = $row['id'] ;
        }
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["company"]." - ". $row["model"]. "</td><td>" . $row["price"] . "</td><td>" . $row["insuranceDate"]. "</td></tr>";
    }
    if (!empty($list)) {
        $carListString = implode(", ", $list);
        echo "<p id='carList'>הביטוחים של כלי הרכב הבאים עומדים לפוג בקרוב: <br>$carListString</br></p>";
    }else{
        echo "<p id='carList'> הביטוח של כלי הרכב תקין</p>";
    }
}
mysqli_close($conn);
?>
	</table>
</main>

<footer class="mt-3" >
   <p class="text-center">ליצירת קשר חייגו 052-7455174</p>
  <p class="text-center">© מערכת Drive2Success</p>
</footer>
</body>
</html>

