
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

$date = $_GET['date'];
mysqli_set_charset($conn, "utf8");
$sql = "SELECT tests.idStudent, students.firstName, students.lastName, tests.startTime, tests.type, tests.result FROM tests JOIN students ON tests.idStudent = students.id WHERE tests.date = '$date'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["startTime"] . "</td><td>" . $row["idStudent"]. "</td><td>" . $row["firstName"]." ". $row["lastName"]. "</td><td>" . $row["type"] . "</td><td>" . $row["result"] . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='5'>אין מבחנים בתאריך זה</td></tr>";
}

mysqli_close($conn);
?>

