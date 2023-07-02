<?php


class TaskList
{
    private $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function addTask($taskName, $priority)
    {
        $tasks = $this->loadTasksFromFile();

        $task = [
            'taskName' => $taskName,
            'status' => 'Not Completed',
            'priority' => $priority
        ];

        $tasks[] = $task;

        $this->saveTasksToFile($tasks);
    }

    public function deleteTask($taskId)
    {
        $tasks = $this->loadTasksFromFile();

        if (isset($tasks[$taskId])) {
            unset($tasks[$taskId]);
            $this->saveTasksToFile($tasks);
        }
    }

    public function getTasks()
    {
        $tasks = $this->loadTasksFromFile();

        usort($tasks, function ($a, $b) {
            return $b['priority'] - $a['priority'];
        });

        return $tasks;
    }

    public function completeTask($taskId)
    {
        $tasks = $this->loadTasksFromFile();

        if (isset($tasks[$taskId])) {
            $tasks[$taskId]['status'] = 'Completed';
            $this->saveTasksToFile($tasks);
        }
    }

    private function loadTasksFromFile()
    {
        $tasks = [];

        if (file_exists($this->filePath)) {
            $handle = fopen($this->filePath, 'r');

            $headers = fgetcsv($handle);

            while (($data = fgetcsv($handle)) !== false) {
                $task = [
                    'taskName' => $data[0],
                    'status' => $data[1],
                    'priority' => $data[2]
                ];

                $tasks[] = $task;
            }

            fclose($handle);
        }

        return $tasks;
    }

    private function saveTasksToFile($tasks)
    {
        $handle = fopen($this->filePath, 'w');

        fputcsv($handle, ['taskName', 'status', 'priority']);

        foreach ($tasks as $task) {
            fputcsv($handle, [$task['taskName'], $task['status'], $task['priority']]);
        }

        fclose($handle);
    }
}

