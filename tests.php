<!DOCTYPE html>
<html dir="rtl" lang="he">
<head>
  <title>Drive2Success</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="tests.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  	<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">

  <script>
$(document).ready(function(){
    // Function to update the table data based on the selected date
   function updateTableData(date) {
  var url = 'getDetailsOfTest.php?date=' + encodeURIComponent(date);
  $.get(url, function(data) {
    $('#tests tbody').html(data);
    // Add click event listener to the rows
    $('#tests tbody tr').click(function() {
      var id = $(this).find('td:nth-child(2)').text();
      window.location.href = 'detailsTest.php?id=' + id + '&date=' + encodeURIComponent(date);
    });
    sortTableByStartTime();
  });
}
    // Initialize the slider with the current date and update the table data
    var currentDate = new Date().toISOString().substr(0, 10);
    $('#dateSlider').val(currentDate);
    updateTableData(currentDate);
  
    // Update the table data when the slider value is changed
    $('#dateSlider').on('input', function() {
        var date = $(this).val();
        updateTableData(date);
    });
    // Sort the table by start time
      function sortTableByStartTime() {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("tests");
        switching = true;

        while (switching) {
          switching = false;
          rows = table.rows;

          for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("td")[0]; // Column index of start time
            y = rows[i + 1].getElementsByTagName("td")[0]; // Column index of start time

            if (x.innerHTML > y.innerHTML) {
              shouldSwitch = true;
              break;
            }
          }

          if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
          }
        }
      }
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
      <span id="menuHeading" class="navbar-text ms-auto"> &nbsp; מבחנים </span>
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
     <div class="centerText">
  <button class="add-user-btn mainButton" onclick="window.location.href='addTest.html'">
  <svg id="svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z"/></svg>  מבחן חדש
</button>
<button class="mainButton" onclick="window.location.href='prediction.html'"><svg id="svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
  <path fill="currentColor" d="M16.89,15.88l4.16,4.16a1,1,0,1,1-1.41,1.41l-4.16-4.16a8,8,0,1,1,1.41-1.41ZM10,16A6,6,0,1,0,4,10,6,6,0,0,0,10,16Z"/>
</svg>  ביצוע חיזוי</button>
  </div>
  <div class="littleSpace"></div>
    <div class="mb-3 centerText">
        <label for="dateSlider" class="form-label">בחר תאריך:</label>
        <input type="date" class="form-control centerText marginAuto" id="dateSlider">
     </div>
    <table class="marginAuto centerText" id="tests">
    <thead>
      <tr>
          <th>שעת התחלה</th>
        <th>תעודת זהות</th>
        <th>שם התלמיד</th>
        
        <th>סוג מבחן</th>
        <th>תוצאה</th>
      </tr>
    </thead>
    <tbody>
	</tbody>
</table>
</main>

<footer class="mt-3" >
   <p class="text-center">ליצירת קשר חייגו 052-7455174</p>
  <p class="text-center">© מערכת Drive2Success</p>
</footer>
</body>
</html>

