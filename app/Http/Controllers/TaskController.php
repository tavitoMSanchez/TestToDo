<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   
    public function get_tasks()
    {
        $tasks = Task::where('complete', 0)->get();
        return response()->json($tasks);
    }

    public function get_tasks_complete()
    {
        $tasks = Task::where('complete', 1)->get();
        return response()->json($tasks);
    }
   
     
    public function add_task(Request $request)
    {

        $request->validate([
            'title'        => ['required'],
            'description'  => ['required'],
            'details'      => ['required'],
            // 'user_id'      => ['user_id'],
        ],
        [
            'required' => 'Campo Requerido'
         ]);

        $task = new Task;

        $task->title         = $request->title;
        $task->description   = $request->description;
        $task->details       = $request->details;

        $task->save();

        return response()->json($task);
    }
  
   
    public function get_edit_task($id)
    {
        $task = Task::findOrFail($id);

        return response()->json($task);
    }
    public function update_edit_task(Request $request)
    {
        $request->validate([
            'title'        => ['required'],
            'description'  => ['required'],
            'details'      => ['required'],
        ],
          [
            'required' => 'Campo Requerido'
         ]);

        $task = new Task;
        Task::where('id', $request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'details' => $request->details
        ]);

        return response()->json($task);
    }

    
    public function delete_task($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }
    public function complete_task($id)
    {

        Task::where('id', $id)->update(['complete' => 1]);
    }

    public function delete_all_task_complete()
    {
        Task::where('complete', 1)->delete();
    }
   
    

}
