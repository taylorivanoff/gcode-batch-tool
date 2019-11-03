<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BatchController extends Controller
{
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
}
