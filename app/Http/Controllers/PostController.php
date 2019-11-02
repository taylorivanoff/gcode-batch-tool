<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $file = Storage::get($request->input('form.file'));
        $start = $request->input('form.start');
        $leveling = $request->input('form.leveling');
        $push = $request->input('form.push');
        $end = $request->input('form.end');
        $repeats = $request->input('form.repeats');

        $introduction = '';
        $loop = '';
        $compiled = '';

        $introduction .= 
        $start . "\r\n" .
        $leveling . "\r\n" .
        $file . "\r\n" .
        $push . "\r\n" . "\r\n";

        $loop .= 
        $start . "\r\n" .
        $file . "\r\n" .
        $push . "\r\n";

        $compiled = $introduction;

        for ($i=0; $i < $repeats - 1; $i++) { 
            $compiled .= $loop . "\r\n" ;
        }

        $compiled .= $end . "\r\n";

        $filename = $request->input('form.file') . '.gcode';

        return response()->json($compiled);
    }

    public function file(Request $request)
    {
        $path = $request->file->store('gcode');
        return response()->json($path);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
