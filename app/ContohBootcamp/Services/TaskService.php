<?php

namespace App\ContohBootcamp\Services;

use App\ContohBootcamp\Repositories\TaskRepository;

class TaskService {
	private TaskRepository $taskRepository;

	public function __construct() {
		$this->taskRepository = new TaskRepository();
	}

	/**
	 * NOTE: untuk mengambil semua tasks di collection task
	 */
	public function getTasks()
	{
		$tasks = $this->taskRepository->getAll();
		return $tasks;
	}

	/**
	 * NOTE: menambahkan task
	 */
	public function addTask(array $data)
	{
		$taskId = $this->taskRepository->create($data);
		return $taskId;
	}

	/**
	 * NOTE: UNTUK mengambil data task
	 */
	public function getById(string $taskId)
	{
		$task = $this->taskRepository->getById($taskId);
		return $task;
	}

	/**
	 * NOTE: untuk update task
	 */
	public function updateTask(array $editTask, array $formData)
	{
		if(isset($formData['title']))
		{
			$editTask['title'] = $formData['title'];
		}

		if(isset($formData['description']))
		{
			$editTask['description'] = $formData['description'];
		}

		$id = $this->taskRepository->save( $editTask);
		return $id;
	}

	/**
	 * NOTE: unutk delete task
	 */
	public function deleteTask(array $taskId)
	{
		$id = $this->taskRepository->destroy($taskId);
		return $id;
	}

	/**
	 * NOTE: unutk assign dan unassign task
	 */
	public function signTask($assigned, array $task)
	{
		$task['assigned'] = $assigned;
		$id = $this->taskRepository->save($task);
		return $task;
	}

	/**
	 * NOTE: unutk add subtask
	 */
	public function addSubTask(array $task, array $data)
	{
		$subtasks = isset($task['subtasks']) ? $task['subtasks'] : [];
		$subtasks[] = [
			'_id'=> (string) new \MongoDB\BSON\ObjectId(),
			'title'=>$data["title"],
			'description'=>$data["description"]
		];

		$task['subtasks'] = $subtasks;

		// $mongoTasks->save($existTask);
		$id = $this->taskRepository->save($task);
		return $id;
	}

	/**
	 * NOTE: unutk delete subtask
	 */
	public function deleteSubTask(array $existTask, string $subtaskId)
	{
		$subtasks = isset($existTask['subtasks']) ? $existTask['subtasks'] : [];

		// Pencarian dan penghapusan subtask
		$subtasks = array_filter($subtasks, function($subtask) use($subtaskId) {
			if($subtask['_id'] == $subtaskId)
			{
				return false;
			} else {
				return true;
			}
		});
		$subtasks = array_values($subtasks);
		$existTask['subtasks'] = $subtasks;

		// $mongoTasks->save($existTask);
		$id = $this->taskRepository->save($existTask);
		return $id;
	}
}