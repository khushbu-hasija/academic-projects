<?php  include('server.php'); ?>
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM list WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$title = $n['title'];
			$decr = $n['decr'];
			$date = $n['date'];
			$prior = $n['prior'];
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>- to do -</title>
		<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

		<style type="text/css">
			body {
    font-size: 19px;
font-family: 'Roboto', sans-serif;
}
table{
    width: 50%;
    margin: 30px auto;
    border-collapse: collapse;
    text-align: left;
}
tr {
    border-bottom: 1px solid #cbcbcb;
}
th, td{
    border: none;
    height: 30px;
    padding: 2px;
}
tr:hover {
    background: #F5F5F5;
}

form {
    width: 45%;
    margin: 50px auto;
    text-align: left;
    padding: 20px; 
    border: 1px solid #bbbbbb; 
    border-radius: 5px;
}

  	input,textarea{
    padding: 5px;
    border-radius: 6px;

}

.input-group {
    margin: 10px 0px 10px 0px;
}
.input-group label {
    display: block;
    text-align: left;
    margin: 3px;
}
.input-group input {
    height: 30px;
    width: 93%;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid gray;
}
.btn {
    padding: 10px;
    font-size: 15px;
    color: white;
    background: #5F9EA0;
    border: none;
    border-radius: 5px;
}
.edit_btn {
    text-decoration: none;
    padding: 2px 5px;
    background: #2E8B57;
    color: white;
    border-radius: 3px;
}

.del_btn {
    text-decoration: none;
    padding: 2px 5px;
    color: white;
    border-radius: 3px;
    background: #800000;
}
.msg {
    margin: 30px auto; 
    padding: 10px; 
    border-radius: 5px; 
    color: #3c763d; 
    background: #dff0d8; 
    border: 1px solid #3c763d;
    width: 50%;
    text-align: center;
}
		</style>
	</head>
	<body>
		<div id="main">
			<h1 align="center">- Task List -</h1>

			<?php $results = mysqli_query($db, "SELECT * FROM list ORDER BY prior,date"); ?>

<table>
	<thead>
		<tr>
			<th>Title</th>
			<th>Description</th>
			<th>Date</th>
			<th>Priority</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['title']; ?></td>
			<td><?php echo $row['decr']; ?></td>
			<td><?php echo $row['date']; ?></td>
			<td><?php echo $row['prior']; ?></td>
			<td>
				<a href="index.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>

			<form id="taskform" action="server.php" method="post">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
			<label>Title: </label><input type="text" name="title" placeholder="Title" value="<?php echo $title; ?>">
			<br><br>
			<label>Description: </label>
			<br><textarea name="decr" placeholder="Enter the task..." value="<?php echo $decr; ?>"></textarea>
			<br><br>
			<label>Due date: </label><input type="date" name="date" value="<?php echo $date; ?>">
			<br><br>
			<label>Priority: </label><input name="prior" type="number" min=0 max=3 value="<?php echo $prior; ?>">
			<br><br>
			<?php if ($update == true): ?>
	<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
<?php else: ?>
	<button class="btn" type="submit" name="save" >Save</button>
<?php endif ?></form>

		</div>
		
		<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>
	</body>
</html>