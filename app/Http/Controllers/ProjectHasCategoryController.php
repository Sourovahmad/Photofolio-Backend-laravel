<?php

namespace App\Http\Controllers;

use App\Models\projectHasCategory;
use App\Http\Requests\StoreprojectHasCategoryRequest;
use App\Http\Requests\UpdateprojectHasCategoryRequest;

class ProjectHasCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreprojectHasCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreprojectHasCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\projectHasCategory  $projectHasCategory
     * @return \Illuminate\Http\Response
     */
    public function show(projectHasCategory $projectHasCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\projectHasCategory  $projectHasCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(projectHasCategory $projectHasCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateprojectHasCategoryRequest  $request
     * @param  \App\Models\projectHasCategory  $projectHasCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateprojectHasCategoryRequest $request, projectHasCategory $projectHasCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\projectHasCategory  $projectHasCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(projectHasCategory $projectHasCategory)
    {
        //
    }
}
