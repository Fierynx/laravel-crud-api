<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function getTasks(){
        $tasks = Task::latest()->get();;
        return compact('tasks');
    }

    public function createTask(Request $request){
        $request->validate([
            'Deadline' => ['required', 'date_format:Y-m-d H:i:s'],
            'Title' => ['required'],
            'Subject' => ['required'],
            'Image' => ['required', 'image'],
            'Description' => ['required'],
        ]);

        $fileName = Str::random(60) . '_'. str_replace(' ', '_', $request->file('Image')->getClientOriginalName());
        $request->file('Image')->storeAs('/public/'. $fileName);

        Task::create([
            'Deadline' => $request->Deadline,
            'Title' => $request->Title,
            'Subject' => $request->Subject,
            'Image' => $fileName,
            'Description' => $request->Description
        ]);

        return "New task has been created!";
    }

    public function updateTask(Request $request, $id){
        $task = Task::find($id);
        if(!$task) abort(400);
        
        $request->validate([
            'Deadline' => ['date_format:Y-m-d H:i:s'],
            'Image' => ['image'],
        ]);

        if(!Storage::exists('public/' . $request->Image) && $request->file("Image")){
            Storage::delete('public/' . $task->Image);
            $fileName = Str::random(60) . str_replace(' ', '_', $request->file('Image')->getClientOriginalName());
            $request->file('Image')->storeAs('public/' . $fileName);
            $task->update(['Image' => $fileName]);
        }

        $task->update([
            'Deadline' => $request->input('Deadline', $task->Deadline),
            'Title' => $request->input('Title', $task->Title),
            'Subject' => $request->input('Subject', $task->Subject),
            'Description' => $request->input('Description', $task->Description)
        ]);

        return "A task has been updated!";
    }

    public function deleteTask($id){
        $task = Task::find($id);
        if(!$task) abort(400);

        if(Storage::exists('public/' . $task->Image)){
            Storage::delete('public/' . $task->Image);
        }
        $task->delete();

        return 'A task has been deleted!';
    }
}
