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
<script src="scripts/validateCar.js"></script>

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
        mysqli_set_charset($conn, "utf8");
        // Query the database for the data you want to display in the table
        $sql = "SELECT * FROM cars WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
       if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $company = $row["company"];
            $year = $row["year"];
            $model = $row["model"]; 
            $gir = $row["gir"];
            $color = $row["color"];
            $price = $row["price"];
            $testDate = $row["testDate"];
            $insuranceDate = $row["insuranceDate"];
            
        } else {
            echo "Car not found";
        }
        $conn->close();
        ?>
    
    <section class="container col-sm-5">
  			<form method="post" action="processCarUpdate.php?id=<?php echo $id; ?>" name="myForm" onsubmit="return validateForm()" novalidate>
				<h1 class="center"><b>עדכון פרטי כלי רכב</b></h1>
                <div class="form-group">
      				<label for="carID">מספר רכב</label>
      				<input type="text" class="form-control" id="carID" name="carID" autocomplete="on" value="<?php echo $id; ?>" required>
    			</div>
				 <div class="row">
					 <div class="col-sm-6">
						 <label for="company">יצרן</label>
						 <input type="text" class=" typeText" id="company" name="company" autocomplete="on" value="<?php echo $company; ?>" required>
					 </div>
                     <div class="col-sm-6">
							<label for="year">שנת ייצור</label>
							<select name="year" id="year"required>
							    <option value="2010"<?php if ($year == '2010') echo ' selected'; ?>>2010</option>
                                <option value="2011"<?php if ($year == '2011') echo ' selected'; ?>>2011</option>
                                <option value="2012"<?php if ($year == '2012') echo ' selected'; ?>>2012</option>
                                <option value="2013"<?php if ($year == '2013') echo ' selected'; ?>>2013</option>
                                <option value="2014"<?php if ($year == '2014') echo ' selected'; ?>>2014</option>
                                <option value="2015"<?php if ($year == '2015') echo ' selected'; ?>>2015</option>
                                <option value="2016"<?php if ($year == '2016') echo ' selected'; ?>>2016</option>
                                <option value="2017"<?php if ($year == '2017') echo ' selected'; ?>>2017</option>
                                <option value="2018"<?php if ($year == '2018') echo ' selected'; ?>>2018</option>
                                <option value="2019"<?php if ($year == '2019') echo ' selected'; ?>>2019</option>
                                <option value="2020"<?php if ($year == '2020') echo ' selected'; ?>>2020</option>
                                <option value="2021"<?php if ($year == '2021') echo ' selected'; ?>>2021</option>
                                <option value="2022"<?php if ($year == '2022') echo ' selected'; ?>>2022</option>
                                <option value="2023"<?php if ($year == '2023') echo ' selected'; ?>>2023</option>
							</select>
						</div>
				 </div>
                 <div class="row">
					 <div class="col-sm-6">
						 <label for="model">דגם</label>
						 <input type="text" class=" typeText" id="model" name="model" autocomplete="on" value="<?php echo $model; ?>"required>
					 </div>
                      <div class="col-sm-6">
						 <label for="color">צבע</label>
						 <input type="text" class=" typeText" id="color" name="color" autocomplete="on" value="<?php echo $color; ?>"required>
					 </div>
                 </div>
                <div class="row">
					<div class=" col-sm-6">
						<label for="gir">גיר</label>
							<select id="gir" class="form-group mb-3" name="gir" value="<?php echo $gir; ?>">
							    <option value="אוטומט"<?php if($gir == 'אוטומט') echo ' selected'; ?>>אוטומט</option>
                                 <option value="ידני"<?php if($gir == 'ידני') echo ' selected'; ?>>ידני</option>
							</select>
						</div>
						<div class="col-sm-6">
                             <label for="price"> מחיר לשיעור-₪</label>
						    <input type="number" min="100" class=" typeText" id="price" name="price" autocomplete="on" value="<?php echo $price; ?>" required>
						</div>
					</div>
				
                <div class="row">
                    <div class=" col-sm-6">
                        <label for="testDate">תאריך פקיעת טסט</label>
                        <input type="date" class="form-control" id="testDate" name="testDate" autocomplete="on" value="<?php echo $testDate; ?>"required>
                    </div>
                    <div class=" col-sm-6">
                        <label for="insuranceDate">תאריך פקיעת ביטוח</label>
                        <input type="date" class="form-control" id="insuranceDate" name="insuranceDate" autocomplete="on" value="<?php echo $insuranceDate; ?>"required>
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
