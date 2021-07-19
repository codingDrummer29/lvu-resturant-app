<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return "index";
        $categories = Category::latest()->get();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return "ok";
        // dd($request->all());
        // validate the form, avoid blank data
        $this->validate($request, [
            'name' => 'required',
            // 'name' => 'required|min:2',
        ]);
        // creating new data in the Db through model
        Category::create([
            'name' => $request->get('name'),
        ]);
        // redirecting the user back with a message
        return redirect()->back()->with('message', 'Category Created Successfully');
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
        // searching the hold id from the form in the DB
        $category = Category::find($id);
        // returning the data to edit.blade form
        return view('category.edit', compact('category'));
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
        // validate the form, avoid blank data
        $this->validate($request, [
            'name' => 'required',
            // 'name' => 'required|min:2',
        ]);
        //find the category from DB with hold id to update
        $category = Category::find($id);
        // update the table-field in DB with form submitted data
        $category->name = $request->get('name');
        // save the data in the DB table
        $category->save();
        // redirect the user back
        return redirect()->route('category.index')->with('message', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find the category from DB with hold id to update
        $category = Category::find($id);
        // delete
        $category->delete();
        // redirect the user back
        return redirect()->route('category.index')->with('message', 'Category Deleted Successfully'); 
    }
}
