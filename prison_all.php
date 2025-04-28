<html>
<head>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #DC2345;
    color: white;
}
.sansserif {
    font-family: Arial, Helvetica, sans-serif;
	font-size: 25px;
}
</style>
</head>
<body>
<legend class="sansserif">Inmate Details</legend>
<hr>

<?php
include 'connect.php';

$result = $con->query("SELECT * FROM inmate");

if (!$result) {
	die("Query failed: " . $con->error);
}
?>
<table border=1 cellspacing="2" width ="30%">
<tr>
	<th>Inmate No</th>
	<th>Name</th>
	<th>Admit Date</th>
	<th>DOB</th>
	<th>Address</th>
	<th>Crime</th>
	<th>Sex</th>
	<th>Type</th>
	<th>Duration</th>
	<th>Cell No</th>
</tr>
<?php
    while($row = mysqli_fetch_array($result))
    {
		echo "<tr align='center'>";
		echo "<td>" . $row['pno'] . "</td>";
		echo "<td>" . $row['Name'] . "</td>";
		echo "<td>" . $row['admit_date'] . "</td>";
		echo "<td>" . $row['DOB'] . "</td>";
		echo "<td>" . $row['address'] . "</td>";
		echo "<td>" . $row['crime'] . "</td>";
		echo "<td>" . $row['sex'] . "</td>";
		echo "<td>" . $row['ptype'] . "</td>";
		echo "<td>" . $row['duration'] . "</td>";
		echo "<td>" . $row['cellno'] . "</td>";
		echo "</tr>";
    }
?>
</table>
</body>
</html>

