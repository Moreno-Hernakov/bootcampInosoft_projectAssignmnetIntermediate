<?php

namespace App\Http\Controller;

use App\ContohBootcamp\Services\TaskService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller {
	private TaskService $taskService;
	public function __construct() {
		$this->taskService = new TaskService();
	}

	public function showTasks()
	{
		$tasks = $this->taskService->getTasks();
		return response()->json($tasks);
	}

	public function createTask(Request $request)
	{
		$request->validate([
			'title'=>'required|string|min:3'
		]);

		$data = [
			'title'=>$request->title
		];;

		$taskId = $this->taskService->addTask($data);
		$task = $this->taskService->getById($taskId);
		return response()->json($task);
	}


	public function updateTask(Request $request)
	{
		$request->validate([
			'taskId'=>'required|string',
			'title'=>'string',
			'assigned'=>'string',
			'subtasks'=>'array'
		]);

		$taskId = $request->post('taskId');
		$formData = $request->only('title', 'assigned', 'subtasks');
		$task = $this->taskService->getById($taskId);
		$editedTask = $this->taskService->updateTask($task, $formData);

		$task = $this->taskService->getById($taskId);

		return response()->json($task);

	}

	// TODO: deleteTask()
	// TODO: unassignTask()
	// TODO: addSubtask()
	// TODO deleteSubTask()


}