<?php

require_once 'TaskList.php';

$taskList = new TaskList('tasks.csv');
//
//$taskList->addTask('Task 1', 1);
//$taskList->completeTask(0);
//
//
//$tasks = $taskList->getTasks();
//foreach ($tasks as $task) {
//    echo $task['taskName'] . ' - Priority: ' . $task['priority'] . ' - Status: ' . $task['status'] . PHP_EOL;
//}

//$taskList->addTask('testTask', 2);
$taskList->completeTask(2);
print_r($taskList->getTasks());
