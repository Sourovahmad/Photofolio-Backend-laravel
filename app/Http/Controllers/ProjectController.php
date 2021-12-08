<?php

namespace App\Http\Controllers;

use App\Models\project;
use App\Http\Requests\StoreprojectRequest;
use App\Http\Requests\UpdateprojectRequest;
use App\Models\projectHasCategory;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return project::orderBy('id', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreprojectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => "required",
            'categories' => 'required',
            'thumbnail' => 'required'
        ]);
        
        $project = new project;
        $project->title = $request->title;
        $project->thumbnail = $request->thumbnail;
        $project->user_id = $request->user()->id;
        $project->save();

        $allCategories = $request->categories;
        foreach($allCategories as $Singlecategory){
            $projecHasCategory = new projectHasCategory;
            $projecHasCategory->category_id = $Singlecategory['id'];
            $projecHasCategory->project_id = $project->id;
            $projecHasCategory->save();
        }


        return response()->json([
            "project_id" => $project->id
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = project::find($id);
        $ProjectCategories = projectHasCategory::where('project_id', $id)->get();

        $categories = array();
         foreach($ProjectCategories as $single){
             $singleCategory = $single->singleCategory();
             array_push($categories, $singleCategory[0]);
         }
        return response()->json([
            "project" => $project,
            "categories" => $categories
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateprojectRequest  $request
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateprojectRequest $request, project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(project $project)
    {
        //
    }
}
