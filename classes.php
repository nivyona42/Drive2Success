<!DOCTYPE html>
<html dir="rtl" lang="he">
<head>
  <title>Drive2Success</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/classes.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  	<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">

  <script>
    function goBack() {
      window.history.back();
    }

    $(document).ready(function(){
      // Function to update the table data based on the selected date
      function updateTableData(date) {
        var url = 'getDetailsOfClass.php?date=' + encodeURIComponent(date);
        $.get(url, function(data) {
          $('#classes tbody').html(data);

          // Add click event listener to the rows
          $('#classes tbody tr').click(function() {
            var startTime = $(this).find('td:first').text();
            var id = $(this).find('td:nth-child(2)').text();
            window.location.href = 'detailsClass.php?id=' + id + '&date=' + encodeURIComponent(date) + '&time=' + startTime;
          });

          // Sort the table by start time after updating the data
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
        table = document.getElementById("classes");
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
  </script>
</head>
<body>
<header class="container-fluid sticky-top" >
  <nav class="navbar shadow p-3 mb-5 bg-body rounded " dir="rtl">
  <div class="container-fluid">
  <button  class="hamburgerMenu navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
  </button>
      <span id="menuHeading" class="navbar-text ms-auto"> &nbsp;שיעורי נהיגה </span>
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
     <div class="centerText">
  <button class="add-user-btn mainButton" onclick="window.location.href='addClass.html'">
  <svg id="svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z"/></svg> שיעור נהיגה חדש
</button>
<button class="road-btn mainButton" onclick="window.location.href='createMapsExplain.html'">
  <svg id="svg" class="svg-icon" viewBox="0 0 24 24">
							<path d="M10,1.375c-3.17,0-5.75,2.548-5.75,5.682c0,6.685,5.259,11.276,5.483,11.469c0.152,0.132,0.382,0.132,0.534,0c0.224-0.193,5.481-4.784,5.483-11.469C15.75,3.923,13.171,1.375,10,1.375 M10,17.653c-1.064-1.024-4.929-5.127-4.929-10.596c0-2.68,2.212-4.861,4.929-4.861s4.929,2.181,4.929,4.861C14.927,12.518,11.063,16.627,10,17.653 M10,3.839c-1.815,0-3.286,1.47-3.286,3.286s1.47,3.286,3.286,3.286s3.286-1.47,3.286-3.286S11.815,3.839,10,3.839 M10,9.589c-1.359,0-2.464-1.105-2.464-2.464S8.641,4.661,10,4.661s2.464,1.105,2.464,2.464S11.359,9.589,10,9.589"></path>
						</svg>
  יצירת מסלול
</button>

  </div>
  <div class="littleSpace"></div>
    <div class="mb-3 centerText">
        <label for="dateSlider" class="form-label">בחר תאריך:</label>
        <input type="date" class="form-control centerText marginAuto" id="dateSlider">
     </div>
    <table class="marginAuto centerText" id="classes">
    <thead>
      <tr>
         <th>שעת התחלה</th>
        <th>תעודת זהות</th>
        <th>שם התלמיד</th>
        <th>איסוף</th>
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

