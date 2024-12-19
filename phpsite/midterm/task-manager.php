<?php

// Helper function to get all tasks from cookies
function getTasks() {
    $tasks = [];

    foreach($_COOKIE as $cookie_name => $cookie_value){
        if(strpos($cookie_name, 'task_') === 0 && substr($cookie_name, -10) !== '_completed'){
            $isCompleted = isset($_COOKIE[$cookie_name . '_completed']);
            $taskname = $cookie_value;
            $tasks = [
                'id' => $cookie_name,
                'name' => $taskname,
                'completed' => $isCompleted
            ];
        }
    }
    return $tasks;
}

// Function to add a new task
function addTask($task) {
    $taskID = 'task_' . time() . rand(1000 , 9999);
    setcookie($taskID, $task, time() + 3600, '/');
    return $taskID;
}

// Function to mark a task as completed
function markTask() {
    
}

// Function to delete completed tasks
function deleteCompletedTasks() {
    

}

// Function to delete all tasks
function deleteAllTasks() {
    
}

// Function to automatically reload the current page
function reloadPage(){
    return header("Location:".$_SERVER["HTTP_REFERER"]);
}

// Handle form submissions
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['submit_task']) && !empty($_POST['task'])){
        addTask($_POST['task']);
        reloadPage();
    }
}


// Get current tasks

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple To-Do List</title>
</head>
<body>

<h1>To-Do List</h1>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <input type="text" name="task" placeholder="Enter a new task" required>
    <button type="submit" name="submit_task">Add Task</button>
</form>

<?php
    $tasks = getTasks();
    
    foreach($tasks as $task)(
        echo '<li>';
        echo $task['name'] . ' ';
        if($tasks['completed']){
            echo "(Completed)";
        }else{
            echo '<form method="post" style="display:inline;">
                    <button type="submit" name="markCompleted" value="' . $task['id'] . '">Mark as Completed</button>
                  </form>';
        }
        echo "</li>";
    )

?>


<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <button type="submit" name="delete_completed">Delete Completed Tasks</button><br>
    <button type="submit" name="delete_all_tasks">Delete All Tasks</button>
</form>

</body>
</html>