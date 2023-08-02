<?php
 require 'db.php';


// Retrieve the task details based on the provided id
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the task details from the database
    $sql = "SELECT * FROM todo WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $task = $row['task'];

        // Handle form submission to update the task
        if (isset($_POST['task']) && !empty($_POST['task'])) {
            $updatedTask = $_POST['task'];
            $sql = "UPDATE todo SET task = '$updatedTask' WHERE id = '$id'";
            if ($conn->query($sql) === true) {
                echo "Task updated successfully.";
                header("Location: index.php"); // Redirect back to the main page
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Task not found.";
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <h1>Edit Task</h1>
    <div class="col-md-8">
        <center>
            <form action="" method="post" class="form-inline">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="text" class="form-control" name="task" value="<?php echo htmlspecialchars($task); ?>">
                <button type="submit" class="btn btn-primary form-control">Update Task</button>
            </form>
        </center>
    </div>
</body>
</html>