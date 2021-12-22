<?php

namespace App\Http\Controllers;

use App\Models\project;
use App\Models\category;
use App\Models\projectHasCategory;
use App\Models\projectHasContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Photo;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allProjects = project::with('user')->where('status', '=' , 1)->orderBy('id', 'DESC')->get();
        $categories = category::all();

        return response()->json([
            "allProjects" => $allProjects,
            "categories" => $categories,
        ],200);
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
            'thumbnail' => 'required',
            'fullimage' => 'required'
        ]);
        
        $project = new project;
        $project->title = $request->title;
        $project->thumbnail = $request->thumbnail;
        $project->fullimage = $request->fullimage;
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
        $contents = projectHasContent::where('project_id', $project->id)->get();

        $categories = array();
         foreach($ProjectCategories as $single){
             $singleCategory = $single->singleCategory();
             array_push($categories, $singleCategory[0]);
         }
        return response()->json([
            "project" => $project,
            "categories" => $categories,
            "contents" => $contents
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateprojectRequest  $request
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'title' => "required",
            'categories' => 'required',
            'thumbnail' => 'required',
            'fullimage' => 'required'
        ]);

        $project = project::find($id);
        $projectHasCategories = projectHasCategory::where('project_id', $project->id)->get();
        if($projectHasCategories->count() < 0){
            $projectHasCategories->delete();
        }

        $projectHasContents = projectHasContent::where('project_id', $project->id)->get();
        if($projectHasContents->count() < 0){
            $projectHasContents->delete();
        }
       
        File::delete($project->thumbnail);
        File::delete($project->fullimage);
        $project->delete();

        // deleted older files




        $Newproject = new project;
        $Newproject->title = $request->title;
        $Newproject->thumbnail = $request->thumbnail;
        $Newproject->fullimage = $request->fullimage;
        $Newproject->user_id = $request->user()->id;
        $Newproject->save();

        $allCategories = $request->categories;
        foreach($allCategories as $Singlecategory){
            $projecHasCategory = new projectHasCategory;
            $projecHasCategory->category_id = $Singlecategory['id'];
            $projecHasCategory->project_id = $Newproject->id;
            $projecHasCategory->save();
        }


        return response()->json([
            "project_id" => $Newproject->id
        ],200);
        
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

    
    function categoryFilter($category_id)
    {
        $projectHasCategories = projectHasCategory::with('projects')->where('category_id', $category_id)->get();
        $filtered_projects = array();

        foreach ($projectHasCategories as $category) {
            if(!$category->projects->isEmpty()){
                foreach ($category->projects as $project) {
                    $project_categories = $project->categories;
                    $project['user'] = $project->user;
                    $project['categories'] = $project_categories;
                    array_push($filtered_projects, $project);
            }
        }
    }
        return response()->json([
            'projects' =>  $filtered_projects
        ]);
    }



    public function projectContent($project_id)
    {
        $projectContents = projectHasContent::where('project_id', $project_id)->get();
        return response()->json([
            'contents' =>  $projectContents
        ],200);
    }

    public function contentUpload(Request $request)
    {
        $request->validate([
            'project_id' => "required"
        ]);


       if($request->type === 'image_big'){

            $projectContent = new projectHasContent;
            $projectContent->project_id = $request->project_id;
            

            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $fileNameFull =  time() . '.full.' . $request->file->getClientOriginalName();

            $picture = Photo::make($request->file->getRealPath())->fit(1140,550);
            $picture->save(public_path('contentImages/'.$fileNameFull));

            $newFileNameFull = route('home') ."/contentImages" . "/" .$fileNameFull;

            $projectContent->image_big = $newFileNameFull;
            $projectContent->save();

            return response()->json([
                "imageName" => $newFileNameFull
            ] ,200);

       }
       
       if($request->type === 'grid_image_one'){


        if($request->grid_two_project_id === 'noId'){

        $projectContent = new projectHasContent;
        $projectContent->project_id = $request->project_id;

            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $fileNameFull =  time() . '.grid_one.' . $request->file->getClientOriginalName();
            $picture = Photo::make($request->file->getRealPath())->fit(535,533);

            $picture->save(public_path('contentImages/'.$fileNameFull));
            $newFileNameFull = route('home') ."/contentImages" . "/" .$fileNameFull;


            $projectContent->grid_image_one = $newFileNameFull;
            $projectContent->save();

            return response()->json([
                "imageName" => $newFileNameFull,
                "grid_one_project_id" => $projectContent->id,
            ] ,200);

        
        }else{

            $projectContent = projectHasContent::find($request->grid_two_project_id);
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $fileNameFull =  time() . '.grid_one.' . $request->file->getClientOriginalName();
            $picture = Photo::make($request->file->getRealPath())->fit(535,533);

            $picture->save(public_path('contentImages/'.$fileNameFull));
            $newFileNameFull = route('home') ."/contentImages" . "/" .$fileNameFull;


            $projectContent->grid_image_one = $newFileNameFull;
            $projectContent->save();

            return response()->json([
                "imageName" => $newFileNameFull,
                "grid_one_project_id" => $projectContent->id,
            ] ,200);
        }

        }




       if($request->type === 'grid_image_two'){

        if( $request->grid_one_project_id === 'noId'){

            $projectContent = new projectHasContent;
            $projectContent->project_id = $request->project_id;

            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $fileNameFull =  time() . '.grid_one.' . $request->file->getClientOriginalName();
            $picture = Photo::make($request->file->getRealPath())->fit(535,533);

            $picture->save(public_path('contentImages/'.$fileNameFull));
            $newFileNameFull = route('home') ."/contentImages" . "/" .$fileNameFull;


            $projectContent->grid_image_two = $newFileNameFull;
            $projectContent->save();

            return response()->json([
                "imageName" => $newFileNameFull,
                "grid_two_project_id" => $projectContent->id,
            ] ,200);


        }else{

            $projectContent = projectHasContent::find($request->grid_one_project_id);
            
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
            ]);
            
    
            $fileNameFull =  time() . '.grid_two.' . $request->file->getClientOriginalName();
    
            $picture = Photo::make($request->file->getRealPath())->fit(535,533);
            $picture->save(public_path('contentImages/'.$fileNameFull));
            $newFileNameFull = route('home') ."/contentImages" . "/" .$fileNameFull;
    
            $projectContent->grid_image_two = $newFileNameFull;
            $projectContent->save();
    
            return response()->json([
                "imageName" => $newFileNameFull
            ] ,200);
        
        }


     }


     if($request->type === 'text'){
         $projectContent = new projectHasContent;
         $projectContent->project_id = $request->project_id;
         $projectContent->text = $request->text;
         $projectContent->save();

         return response()->json([
            "text" => $request->text
        ] ,200);
     }


    }



    public function contentDelete(Request $request)
    {
        if($projectContent = projectHasContent::where('image_big', $request->image_url)->first()){
            File::delete($request->image_url);
            $projectContent->delete();

        }elseif($projectContent = projectHasContent::where('grid_image_one', $request->image_url)->first()){
            File::delete($request->image_url);
            File::delete($projectContent->grid_image_two);
            $projectContent->delete();

        }elseif($projectContent = projectHasContent::where('grid_image_two', $request->image_url)->first()){
            File::delete($projectContent->grid_image_one);
            File::delete($request->image_url);
            $projectContent->delete();
        }


    }

    public function userCategoryWisedProject(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'category_id' => 'required'
        ]);

        $modelProject = new project();
        return $projects = project::where('user_id',$request->user_id)->where($modelProject->projectWithCategory($request->category_id))->where('status', '=', 1)->get();
    }

    public function activeProject(Request $request)
    {
       $request->validate([
        "project_id" => 'required'
       ]);

        $project =  project::find($request->project_id);
        $project->status = true;
        $project->save();
 
    }


    public function textDelete(Request $request)
    {
       $request->validate([
           'content_id' => 'required'
       ]);

        $content = projectHasContent::find($request->content_id);
        $content->delete();
        return response(200);
    }

 

    public function imageUpdate(Request $request)
    {
        $request->validate([
            'previous_image' => 'required',
            'new_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($projectContent = projectHasContent::where('image_big', $request->previous_image)->first()){

            File::delete($request->previous_image);

            $fileNameFull =  time() . '.full.' . $request->new_image->getClientOriginalName();
            $picture = Photo::make($request->new_image->getRealPath())->fit(1140,550);


            $picture->save(public_path('contentImages/'.$fileNameFull));
            $newFileNameFull = route('home') ."/contentImages" . "/" .$fileNameFull;

            $projectContent->image_big = $newFileNameFull;

            $projectContent->save();
            return response()->json([
                'image_url' => $newFileNameFull
            ],200);

        }else if($projectContent = projectHasContent::where('grid_image_one', $request->previous_image)->first()){

            File::delete($request->previous_image);
            $imageUrl = $this->imageUploader($request->new_image);
            $projectContent->grid_image_one = $imageUrl;
            $projectContent->save();
            return response()->json([
                'image_url' => $imageUrl
            ],200);

        }else if($projectContent = projectHasContent::where('grid_image_two', $request->previous_image)->first()){

            File::delete($request->previous_image);
            $imageUrl = $this->imageUploader($request->new_image);
            $projectContent->grid_image_two = $imageUrl;
            $projectContent->save();
            return response()->json([
                'image_url' => $imageUrl
            ],200);
        }

    }



    public function imageUploader($Image)
    {

        $fileNameFull =  time() . '.grid_image.' . $Image->getClientOriginalName();
        $picture = Photo::make($Image->getRealPath())->fit(535,533);
        $picture->save(public_path('contentImages/'.$fileNameFull));
        $newFileNameFull = route('home') ."/contentImages" . "/" .$fileNameFull;
        return $newFileNameFull;
    }
}
