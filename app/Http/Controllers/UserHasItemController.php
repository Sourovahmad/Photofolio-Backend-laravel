<?php

namespace App\Http\Controllers;

use App\Models\userHasItem;
use App\Http\Requests\StoreuserHasItemRequest;
use App\Http\Requests\UpdateuserHasItemRequest;

class UserHasItemController extends Controller
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
     * @param  \App\Http\Requests\StoreuserHasItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreuserHasItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\userHasItem  $userHasItem
     * @return \Illuminate\Http\Response
     */
    public function show(userHasItem $userHasItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\userHasItem  $userHasItem
     * @return \Illuminate\Http\Response
     */
    public function edit(userHasItem $userHasItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateuserHasItemRequest  $request
     * @param  \App\Models\userHasItem  $userHasItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateuserHasItemRequest $request, userHasItem $userHasItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\userHasItem  $userHasItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(userHasItem $userHasItem)
    {
        //
    }
}
