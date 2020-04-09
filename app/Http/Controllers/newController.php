<?php

namespace App\Http\Controllers;

use App\News;
use App\Tag;
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
                    $output .= '<li class="list-group-item">'.$row->tags.'</li>';
                }
                // end of output
                $output .= '</ul>';
            }
            else {
                // if there's no matching results according to the input
                $output .= '<li class="list-group-item">'.'No results'.'</li>';
            }
            // return output result array
            return $output;
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
