<?php

namespace App\Http\Controllers;

use App\Models\projectHasContent;
use App\Http\Requests\StoreprojectHasContentRequest;
use App\Http\Requests\UpdateprojectHasContentRequest;
use Illuminate\Http\Request;

class ProjectHasContentController extends Controller
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
     * @param  \App\Http\Requests\StoreprojectHasContentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreprojectHasContentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\projectHasContent  $projectHasContent
     * @return \Illuminate\Http\Response
     */
    public function show(projectHasContent $projectHasContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\projectHasContent  $projectHasContent
     * @return \Illuminate\Http\Response
     */
    public function edit(projectHasContent $projectHasContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateprojectHasContentRequest  $request
     * @param  \App\Models\projectHasContent  $projectHasContent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateprojectHasContentRequest $request, projectHasContent $projectHasContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\projectHasContent  $projectHasContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(projectHasContent $projectHasContent)
    {
        //
    }


    public function updateText(Request $request)
    {
        $request->validate([
            'content_id' => 'required',
            'new_text' => 'required'
        ]);


        $content = projectHasContent::find($request->content_id);
        $content->text = $request->new_text;
        $content->save();

        return response()->json([
            "text" => $request->new_text
        ]);
    }
}
