<?php

namespace App\Http\Controllers;

use App\News;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class newController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::first()->paginate(3);
        return response()->json($news);
    }


    public function searchtest(){
         $data =Tag::with('news')->get();

         foreach ($data as $dat) {
            // echo $dat->news;
                echo $dat ->news;
            // foreach ($dat->tags  as $tag){
            //     // echo $new->name;
            //     echo $tag;
            // }
            
           // $comments = $post->comments;
            /* You can write loop again  */
        }
        //  dd($data);
       // return response()->json($data);
    }
   


    public function searchable($word){
        $states = tag::with('news')->where('tags','=',$word)
        ->paginate(3);
    return response()->json($states);
    }

    public function search(Request $request){
        // check if ajax request is coming or not
        
        if($request->ajax()) {
            // select country name from database
            $data = Tag::where('tags', 'LIKE', $request->country.'%')->with('news')
                ->get();
           // dd($data);    
            // declare an empty array for output
            $output = '';
            // if searched countries count is larager than zero
            if (count($data)>0) {
                // concatenate output to the array
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                // loop through the result array
                foreach ($data as $row){
                    // concatenate output to the array
                    $output .= '<li class="list-group-item tags">'.$row->tags.'</li>';
                }
                // end of output
                $output .= '</ul>';
            }
            else {
                // if there's no matching results according to the input
                $output .= '<li class="list-group-item tags">'.'No results'.'</li>';
            }
            // return output result array
            return $output;
        }
    }
// for admins


    public function indexnew()
    {
        $news = News::with('tags')->paginate(2);
        // dd($news);
        return view('layouts.AdminPanel.news.index', [
            'news' => $news
        ]);
    }
    
    public function createNew()
    {
        $tags = Tag::all();
        
        return view('layouts.AdminPanel.news.createnew',[
            'tags' => $tags,
        ]);
    }

    public function addnewAdmin(Request $request)
    {
       // dd($request);
        
            $new = News::create([
                'name' => $request->new,
                'body' => $request->body,
                'image' => $request->image->store('files','public'),
                'created_at'=> Carbon::now(),
            ]);

            if ($request->has("tag")) {
                
                
             $new->tags()->attach($request->tag);
                
            }
            
            
            
            return redirect()->to('/admin/news')->with('message', 'Your new has already created');
    }

    public function shownew($new)
    {
        $new = News::find($new);
        return view('layouts.AdminPanel.news.show', ['new' => $new]);
    }
    
    public function editNew($id)
    {
        $new = News::find($id);
        $tagsofnew = $new->tags;
        $tags = Tag::with('news')->get();
        return view('layouts.AdminPanel.news.edit', ['new' => $new,'tagsofnew' => $tagsofnew , 'tags'=>$tags]);
    }

    public function updateNew(Request $request, News $new)
    { 
            // dd($new->tags);    
            if ($request->has("name")) {
                $new->name = $request->input('name');
                
            }
            if ($request->has("body")) {
                $new->body = $request->input('body');
                
            }

            if ($request->has("image")) {
                $new->image = $request->image->store('files','public');
                
            }
           
            if ($request->has("tag")) {
                $new->tags()->detach();
                foreach ($request->input('tag') as $tag) {
                    $new->tags()->attach($request->tag);
                }
            }
            $new->updated_at = Carbon::now();
            $new->save();
        
        return redirect()->route('news.indexNew')->with('message', 'new has already updated');    
    }

    public function deleteNew($id)
    {
        $product = News::find($id)->delete();
        return redirect()->route('news.indexNew')->with('message', 'new has deleted successfully');
    }
}
