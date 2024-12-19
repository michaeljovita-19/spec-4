<?php
function getTasks() {
    $tasks = [];
    
    foreach ($_COOKIE as $cookieName => $cookieValue) {
        if (strpos($cookieName, 'task_') === 0 && substr($cookieName, -10) !== '_completed') {
            $isCompleted = isset($_COOKIE[$cookieName . '_completed']);
            $taskName = $cookieValue;
            $tasks[] = [
                'id' => $cookieName,
                'name' => $taskName,
                'completed' => $isCompleted
            ];
        }
    }
    return $tasks;
}

function addTask($taskName) {
    $taskId = 'task_' . time() . rand(1000, 9999);
    setcookie($taskId, $taskName, time() + 3600, "/");
    return $taskId;
}

function markTask($taskId) {
    $completedTaskId = $taskId . '_completed';
    setcookie($completedTaskId, 'completed', time() + 3600, "/");
    reloadPage();
}

function deleteCompletedTasks() {
    foreach ($_COOKIE as $cookieName => $cookieValue) {
        if (strpos($cookieName, 'task_') === 0 && substr($cookieName, -10) === '_completed') {
            setcookie($cookieName, '', time() - 3600, "/");
            setcookie(str_replace('_completed', '', $cookieName), '', time() - 3600, "/");
        }
    }
    reloadPage();
}

function deleteAllTasks() {
    foreach ($_COOKIE as $cookieName => $cookieValue) {
        if (strpos($cookieName, 'task_') === 0) {
            setcookie($cookieName, '', time() - 3600, "/");
            setcookie($cookieName . '_completed', '', time() - 3600, "/");
        }
    }
    reloadPage();
}

function reloadPage() {
    header("Location:".$_SERVER["PHP_SELF"]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submitTask']) && !empty($_POST['task'])) {
        addTask($_POST['task']);
        reloadPage();
    }
    
    if (isset($_POST['markCompleted'])) {
        markTask($_POST['markCompleted']);
    }
    
    if (isset($_POST['delete_completed'])) {
        deleteCompletedTasks();
    }
    
    if (isset($_POST['delete_all_tasks'])) {
        deleteAllTasks();
    }
}
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

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="text" name="task" placeholder="Enter a new task" required>
    <button type="submit" name="submitTask">Add Task</button>
</form>

<h2>Your Tasks</h2>
<ul>
<?php
    $tasks = getTasks();
    
    foreach ($tasks as $task) {
        echo '<li>';
        echo $task['name'] . ' ';
        
        if ($task['completed']) {
            echo '(Completed)';
        } else {
            echo '<form method="post" style="display:inline;">
                    <button type="submit" name="markCompleted" value="' . $task['id'] . '">Mark as Completed</button>
                  </form>';
        }
        echo '</li>';
    }
?>
</ul>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <button type="submit" name="delete_completed">Delete Completed Tasks</button><br>
    <button type="submit" name="delete_all_tasks">Delete All Tasks</button>
</form>

</body>
</html>
