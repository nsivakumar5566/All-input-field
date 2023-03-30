<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Register::all();
        return view('index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // echo '<pre>';
        // print_r($request->all());exit;

        $file = $request->file('image');
        $timestamp = strtotime("now");
        $filename = $timestamp . '-' . $file->getClientOriginalName();
        $file->move(public_path('images'), $filename);
        //Post::create($request->all());

        $post = new Register;
        $post->name = $request->name;
        $post->password = $request->password;
        $post->email = $request->email;
        $post->images = $filename;
        $post->subject = $request->subject;
        $post->address = $request->address;
        $post->age = $request->age;
        $post->gender = $request->gender;
        $post->save();

        return redirect('admin/view')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $viewpost = Register::find($id);
        return view('show', compact('viewpost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Register $register)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Register $register)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Register $register)
    {
        //
    }
}
