<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        $data['posts']=$posts;
        return view('posts.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs=$request->only(['title','content']);
        $inputs['user_id']=Auth::id();




        if($request->hasFile('photo'))
        {
            $path=Storage::putFile('public/posts_photos', $request->file('photo'));

            $inputs['photo']=str_replace('public', 'storage', $path);
        }

        Post::create($inputs);

       return response()->redirectTo(route('posts.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::findOrFail($id);
        return view('posts.show',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['post']=Post::findOrFail($id);
        return view('posts.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs=$request->only(['title','content']);

        if($request->hasFile('photo'))
        {
            $path=Storage::putFile('public/posts_photos', $request->file('photo'));

            $inputs['photo']=str_replace('public', 'storage', $path);
        }

        Post::findOrFail($id)->update($inputs);

        return response()->redirectTo(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return response()->redirectTo(route('posts.index'));

    }
}
