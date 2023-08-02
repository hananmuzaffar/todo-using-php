<!DOCTYPE html>
<html>
<head>
    <title>Todo List</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">ToDo using PHP</a>
		</div>
	</nav>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">Tasks</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<div class="col-md-2"></div>

    <?php
    require 'db.php';

    // Handle form submission
    if (isset($_POST['task']) && !empty($_POST['task'])) {
        $task = $_POST['task'];

        // Insert the new task into the database
        $sql = "INSERT INTO todo (task) VALUES ('$task')";
        if ($conn->query($sql) === true) {
            echo "New task added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Handle task deletion
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];

        // Delete the task from the database
        $sql = "DELETE FROM todo WHERE id = '$id'";
        if ($conn->query($sql) === true) {
            echo "Task deleted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <div class="col-md-8">
        <center>
            <div class="col-md-8">
            <form action="" method="post" class="form-inline">
                <input type="text" class="form-control" name="task" placeholder="Enter your task" required>
                <button class="btn btn-primary form-control" name="add">Add Task</button>
            </form>
        </center>
    </div>

    <br /><br /><br />

    <?php
    // Display existing tasks
    $sql = "SELECT * FROM todo";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table'>
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>";
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $task = htmlspecialchars($row['task']);
            $status = $row['status'];
            echo "<tr>
                    <td>$task</td>
                    <td>$status</td>
                    <td colspan='2'>
                        <center>
                            <a href='update_task.php?id=$id' class='btn btn-success'><span class='glyphicon glyphicon-check'></span></a>&nbsp;|&nbsp;
                            <a href='edit_task.php?id=$id' class='btn btn-primary'><span class='glyphicon glyphicon-pencil'></a>&nbsp;|&nbsp;
                            <a href='?action=delete&id=$id' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></a>
                        </center>
                    </td>
                </tr>";
        }
        echo "</tbody>
            </table>";
    } else {
        echo "<br>No tasks found.";
    }

    // Closing the database connection
    $conn->close();
    ?>
</div>
    
</body>
</html>
