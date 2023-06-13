<?php

namespace App\Http\Controllers\API;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index()
    {

        $projects = Project::orderByDesc('id')->get();

        return response()->json([
            'success' => true,
            'projects' => $projects,
        ]);
    }
}
