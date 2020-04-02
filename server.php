<?php 
	session_start();
	$db = mysqli_connect('localhost', 'id13113269_khushbu', 'Q(}x|SeXg0eEYbLD', 'id13113269_to_do');

	$title = "";
	$decr = "";
	$prior = "";
	$date = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$title = $_POST['title'];
		$decr = $_POST['decr'];
		$date = $_POST['date'];
		$prior = $_POST['prior'];
		
		mysqli_query($db, "INSERT INTO list (title,decr,date,prior) VALUES ('$title', '$decr', '$date', '$prior')"); 
		$_SESSION['message'] = "Task saved"; 
		header('location: index.php');
	}

	if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$title = $_POST['title'];
	$decr = $_POST['decr'];
	$date = $_POST['date'];
	$prior = $_POST['prior'];
	mysqli_query($db, "UPDATE list SET title='$title', decr='$decr', date='$date', prior='$prior' WHERE id=$id");
	$_SESSION['message'] = "Task updated!"; 
	header('location: index.php');
	}

	if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM list WHERE id=$id");
	$_SESSION['message'] = "Task deleted!"; 
	header('location: index.php');
	}
?>