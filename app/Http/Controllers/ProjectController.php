<?php

namespace App\Http\Controllers;

use App\Mail\ProjectAssigned;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
    public function assignUser(Request $request, Project $project)
    {
        $user = User::find($request->user_id);

        $project->users()->attach($user);

        Mail::to($user)->send(new ProjectAssigned());

        return response()->json([
            'message' => 'User assigned to project.'
        ]);
    }
}
