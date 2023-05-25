<!DOCTYPE html>
<html dir="rtl" lang="he">
<head>
  <title>Drive2Success</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="cars.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function toggleNote() {
        var note = document.getElementById("note");
        if (note.style.display === "none") {
            note.style.display = "block";
        } else {
            note.style.display = "none";
        }
    }

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
                <span id="menuHeading" class="navbar-text ms-auto">&nbsp; פרטי תלמיד </span>
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
       <button class="goals" onclick="window.location.href = 'goals.php?id=<?php echo str_pad($_GET['id'], 9, '0', STR_PAD_LEFT); ?>'">מטרות אישיות</button>
        <div class="littleSpace"></div>
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
        $sql = "SELECT * FROM students WHERE id=$id";
        
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        		    $row = mysqli_fetch_assoc($result); 
        		    echo "<p class='echoDesign'>תעודת זהות: ".$row["id"]."</p>";
        		    echo "<hr>";
        		    echo "<p class='echoDesign'>שם פרטי: ".$row["firstName"]."</p>";
        		    echo "<hr>";
        		    echo "<p class='echoDesign'>שם משפחה: ".$row["lastName"]."</p>";
        		    echo "<hr>";
        		     echo "<p class='echoDesign'>השכלה: ".$row["education"]."</p>";
        		    echo "<hr>";
        		    echo "<p class='echoDesign'>כתובת מייל: ".$row["email"]."</p>";
        		    echo "<hr>";
        		    echo "<p class='echoDesign'>מספר טלפון: ".$row["phone"]."</p>";
        		    echo "<hr>";
        		    echo "<p class='echoDesign'>תאריך יום הולדת: ".$row["birthday"]."</p>";
        		    echo "<hr>";
        		    echo "<p class='echoDesign'>עיר: ".$row["city"]."</p>";
        		    echo "<hr>";
        		    echo "<p class='echoDesign'>רחוב: ".$row["street"]."</p>";
        		    echo "<hr>";
        		    echo "<p class='echoDesign'>דירה: ".$row["apartment"]."</p>";
        		    echo "<hr>";
        		    echo "<p class='echoDesign'>רישיון: ".$row["license"]."</p>";
        		    echo "<hr>";
        		
        }
        
        mysqli_close($conn);
        ?>
        <div class="littleSpace"></div>
        <button class="delete" onclick="toggleNote()">מחק</button>
        <button class="delete" onclick="window.location.href = 'updateStudent.php?id=<?php echo str_pad($_GET['id'], 9, '0', STR_PAD_LEFT); ?>'">ערוך</button>
        <div class="echoDesign" id="note" style="display:none;">
         האם אתה בטוח שברצונך למחוק את התלמיד עם תעודת הזהות <?php echo $id; ?>?
            <button class="yesNo" onclick="window.location.href = 'deleteStudent.php?id=<?php echo str_pad($_GET['id'], 9, '0', STR_PAD_LEFT); ?>'">כן</button>
            <button class="yesNo" onclick="toggleNote()">לא</button>
        </div>
    </main>
    <footer class="mt-3" >
        <p class="text-center">ליצירת קשר חייגו 052-7455174</p>
        <p class="text-center">© מערכת Drive2Success</p>
    </footer>
</body>
</html>

