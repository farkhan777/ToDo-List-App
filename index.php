<?php
    $errors = "";

    $db = mysqli_connect("localhost", "root", "", "todo_list");

    if(isset($_POST['submit'])){
        if(empty($_POST['task'])){
            $errors = "You have to fill the task";
        }else{
            $task = $_POST['task'];
            $sql = "INSERT INTO tasks (task) VALUES ('$task')";
            mysqli_query($db, $sql);
            header('location:index.php');
        }
    }

    if(isset($_GET['delTask'])){
        $id = $_GET['delTask'];
        mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
        header("location:index.php");
    }

    $tasks = mysqli_query($db, "SELECT * FROM tasks");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List App</title>
    <!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/ui.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="style.css">
    
</head>
<body>

    <div class="contact1">
        <div class="container-contact1">
            <div class="heading">
                <h2 style="font-family: cursive;">ToDo List Application</h2>
            </div>
            <form method="post" action="index.php" class="input_form">
                <?php if (isset($errors)) { ?>
                    <p class="task"><?php echo $errors ?></p>
                <?php } ?>
                <input type="text" name="task" class="task_input">
                <button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>N</th>
                        <th>Tasks</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        while($row = mysqli_fetch_array($tasks)){?>
                            <tr class="task">
                                <td><?php echo $row['id'] ?></td>
                                <td class="task"><?php echo $row['task']; ?></td>
                                <td class="delete">
                                    <a href="index.php?delTask=<?php echo $row['id']; ?>">X</a>
                                </td>
                            </tr>
                        <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>