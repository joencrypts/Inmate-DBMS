<?php session_start();
	session_regenerate_id();
	
	require('connect.php');
	if($_SERVER["REQUEST_METHOD"] == "POST") {
	$no = $_POST['noinput'];
    $query= "delete from inmate where pno = '$no'";
	$result = mysqli_query($con,$query);
	
	if($result) {
		echo "<script>
			alert('Inmate has been successfully deleted!');
			window.location.href='inmate_del.php';
		</script>";
	} else {
		echo "<script>
			alert('Error deleting inmate. Please try again.');
			window.location.href='inmate_del.php';
		</script>";
	}
	}
?>
