<?php
	require 'db.php';
    // Retrieve the task details based on the provided id
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
	
	if($_GET['id'] != ""){
		$task_id = $_GET['id'];
		
		$conn->query("UPDATE `todo` SET `status` = 'Done' WHERE `id` = $task_id") or die(mysqli_errno());
		header('location: index.php');
	}
    $conn->close();
}
?>