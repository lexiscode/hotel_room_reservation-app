<?php

// Function to load the todo list from JSON file
function loadTodoList($filename) {
    if (file_exists($filename)) {
        $json = file_get_contents($filename);
        $todoList = json_decode($json, true);

    } else {
        $todoList = [];
    }

    return $todoList;
}

// Function to save the todo list to JSON file
function saveTodoList($filename, $todoList) {
    $json = json_encode($todoList); 
    file_put_contents($filename, $json);
}

// Set the filename for the todo list JSON file
$filename = 'bookings.json';

// Load the todo list from JSON file
$todoList = loadTodoList($filename);

// Check if a new task is submitted and its not empty, then add it to the todo list
if (isset($_POST['addTask'])){
    if (!empty($_POST['name']) && !empty($_POST['room_type']) && !empty($_POST['due_date']) && !empty($_POST['set_time'])){
        $task = $_POST['name']; // Get the name
        $roomType = $_POST['room_type']; // Get the room type
        $dueDate = $_POST['due_date']; // Get the due date
        $setTime = $_POST['set_time']; // Get the set time

        // Create a new task array with task and due date
        $newTask = ['task' => $task, 'room_type' => $roomType, 'due_date' => $dueDate, 'set_time' => $setTime];

        // Add the new task to the todo list
        $todoList[] = $newTask;

        // Save the updated todo list
        saveTodoList($filename, $todoList);
    }
}

// Check if a task is marked as remove, then delete the task from the list
if (isset($_POST['remove'])) {
    $removeIndex = $_POST['remove'];

    // Remove the marked task from the todo list
    if (isset($todoList[$removeIndex])) { // checks/ensures if there's a value where u wish to delete
        unset($todoList[$removeIndex]); // delete that task

        // Re-index the array
        $todoList = array_values($todoList);

        // Save the updated todo list
        saveTodoList($filename, $todoList);
    }
}


// Check if an updated task is submitted
if (isset($_POST['edit_index']) && isset($_POST['updated_task']) && isset($_POST['updated_room_type']) && isset($_POST['updated_due_date']) && isset($_POST['updated_set_time'])) {
    $editIndex = $_POST['edit_index']; // Get the index
    $updatedTask = $_POST['updated_task']; // Get the updated task
    $updatedDueDate = $_POST['updated_due_date']; // Get the updated due date
    $updatedRoomType = $_POST['updated_room_type']; // Get the updated room type
    $updatedSetTime = $_POST['updated_set_time']; // Get the updated time

    // Update the task and due date
    if (isset($todoList[$editIndex])) { // checks/ensures if there is a value where u wish to update
        $todoList[$editIndex]['task'] = $updatedTask; // update the task
        $todoList[$editIndex]['room_type'] = $updatedRoomType; // update the room type
        $todoList[$editIndex]['due_date'] = $updatedDueDate; // update the due date
        $todoList[$editIndex]['set_time'] = $updatedSetTime; // update the set time

        // Save the updated todo list
        saveTodoList($filename, $todoList);
    }
}


// Clear the todo list and delete file content
if (isset($_POST['clearLists'])) {
    $todoList = [];
    saveTodoList($filename, $todoList);
}

// Numbering the ToDo list
function taskNumber(){
    static $a = 1;
    echo $a;
    $a++;
}


?>