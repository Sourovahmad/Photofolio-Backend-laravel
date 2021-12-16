<?php

namespace App\Http\Controllers;

use App\Models\image;
use App\Http\Requests\StoreimageRequest;
use App\Http\Requests\UpdateimageRequest;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Photo;
class ImageController extends Controller
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
     * @param  \App\Http\Requests\StoreimageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreimageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateimageRequest  $request
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateimageRequest $request, image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(image $image)
    {
        //
    }

    public function thumbnailUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fileNameFull =  time() . '.full.' . $request->file->getClientOriginalName();
        $fileNameSmall = time() . '.small.' . $request->file->getClientOriginalName();

        $imageSize = getimagesize($request->file);

        $pictureSmall = Photo::make($request->file->getRealPath())->fit(278,278);
        $pictureBig = Photo::make($request->file->getRealPath())->fit($imageSize[0], $imageSize[1]);

        $pictureSmall->save(public_path('thumbnails/'.$fileNameSmall));
        $pictureBig->save(public_path('thumbnails/'.$fileNameFull));


        $newFileNameSmall = route('home') ."/thumbnails" . "/" .$fileNameSmall;
        $newFileNameBig = route('home') ."/thumbnails" . "/" .$fileNameFull;

        return response()->json([
            "imageNameSmall" => $newFileNameSmall,
            "imageNameBig" => $newFileNameBig
        ] ,200);
    }
}
