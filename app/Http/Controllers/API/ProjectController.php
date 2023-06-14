<?php

namespace App\Http\Controllers\API;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['type', 'technologies'])
            ->orderByDesc('id')
            ->paginate(8);

        return response()->json([
            'success' => true,
            'projects' => $projects,
        ]);
    }
    public function show($slug)
    {
        $project = Project::with(['type', 'technologies'])
            ->where('slug', $slug)
            ->first();

        if ($project) {
            return response()->json([
                'success' => true,
                'project' => $project,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'project' => 'Project not found 404',
            ]);
        }
    }
}
