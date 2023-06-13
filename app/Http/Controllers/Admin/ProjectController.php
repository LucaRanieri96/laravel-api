<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Project;
use App\Models\Technology;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Auth::user()->projects()->orderByDesc("id")->paginate(12);
        $types = Type::all();

        return view("admin.projects.index", compact("projects", "types"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::orderByDesc('id')->get();
        $technologies = Technology::orderByDesc('id')->get();

        //dd($technologies);
        
        return view("admin.projects.create", compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {

        // dd($request->all());

        $valData = $request->validated();


        $valData['slug'] = Project::generateSlug($valData['name']);

        $valData['repoUrl'] = Project::generateRepoUrl($valData['slug']);

        $valData["startingDate"] = date("Y-m-d") . " " . date("H:i:s");

        //dd($valData);
        $valData['user_id'] = Auth::id(1);
        //dd($valData);

        if ($request->hasFile('cover_image')) {
            $image_path = Storage::put('uploads', $request->cover_image);
            $valData['cover_image'] = $image_path;
        }

        $new_project = Project::create($valData);

        if ($request->has('technologies')){
            $new_project->technologies()->attach($request->technologies);
        }

        return to_route("admin.projects.index")->with("message", "Project successfully inserted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view("admin.projects.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::orderByDesc('id')->get();
        $technologies = Technology::orderByDesc('id')->get();

        // if(Auth::id() === $project->user_id){
        // }
        // abort(403);
        
        return view("admin.projects.edit", compact("project", 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $valData =  $request->validated();

        $valData['slug'] = Project::generateSlug($valData['name']);

        $valData['repoUrl'] = Project::generateRepoUrl($valData['slug']);

        $valData["startingDate"] = date("Y-m-d") . " " . date("H:i:s");

        
        if ($request->hasFile('cover_image')) {
            
            if ($project->cover_image) {
                
                Storage::delete($project->cover_image);    
            }

            $image_path = Storage::put('uploads', $request->cover_image);
            $valData['cover_image'] = $image_path;
            
        }
        
        if ($request->has('technologies')){
            $project->technologies()->sync($request->technologies);
        }
        
        $project->update($valData);

        return to_route("admin.projects.index")->with("message", "Project successfully inserted");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }

        $project->delete();
        return to_route("admin.projects.index")->with("message", "Project deleted");
    }
}
