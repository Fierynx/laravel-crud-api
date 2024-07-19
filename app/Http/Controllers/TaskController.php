<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function getTasks(){
        return TaskResource::collection(Task::paginate(5));
    }

    public function createTask(Request $request){
        $request->validate([
            'Deadline' => ['required', 'date_format:Y-m-d H:i:s'],
            'Title' => ['required'],
            'Image' => ['required', 'image'],
            'Description' => ['required'],
            'SubjectId' => ['required'],
        ]);

        $fileName = Str::random(60) . '_'. str_replace(' ', '_', $request->file('Image')->getClientOriginalName());
        $request->file('Image')->storeAs('/public/'. $fileName);

        Task::create([
            'Deadline' => $request->Deadline,
            'Title' => $request->Title,
            'Image' => $fileName,
            'Description' => $request->Description,
            'SubjectId' => $request->SubjectId,
        ]);

        return "New task has been created!";
    }

    public function updateTask(Request $request, $id){
        $task = Task::find($id);
        if(!$task) return response("Data not found", 404);
        
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
            'Description' => $request->input('Description', $task->Description),
            'SubjectId' => $request->input('SubjectId', $task->SubjectId),
        ]);

        return "A task has been updated!";
    }

    public function deleteTask($id){
        $task = Task::find($id);
        if(!$task) return response("Data not found", 404);

        if(Storage::exists('public/' . $task->Image)){
            Storage::delete('public/' . $task->Image);
        }
        $task->delete();

        return 'A task has been deleted!';
    }
}
