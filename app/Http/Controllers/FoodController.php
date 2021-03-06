<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return "index";
        // $foods = Food::latest()->get();
        $foods = Food::latest()->paginate(10);
        return view('food.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return "ok";
        return view('food.create');
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
        // validate the form
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required|min:2|max:200',
            'price' => 'required|integer',
            'category' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg',
        ]);
        
        // storing the image in public folder
        $image = $request->file('image'); // get the image from form
        $name = time().'.'.$image->getClientOriginalExtension(); // new name of file with timestamp
        $destinationPath = public_path('/images'); // securing the destination of the file
        $image->move($destinationPath, $name); // moves the image file to destination with new name

        // soting data in DB
        Food::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'category_id' => $request->get('category'),
            'image' => $name,
        ]);
        // success message with redirect
        return redirect()->back()->with('message', 'Food item CREATED!!');
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
        //finding the item from the DB
        $food = Food::find($id);
        // loading the data inside the edit form view
        return view('food.edit', compact('food'));
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
        // validate the form
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required|min:2|max:60',
            'price' => 'required|integer',
            'category' => 'required',
            'image' => 'mimes:png,jpeg,jpg',
        ]);
        
        // find the item from DB
        $food = Food::find($id);
        
        // checking if image needs update
        // grab image from DB
        $image_name = $food->image;
        // check-upload form-updated-image
        if ($request->hasFile('image')) {
            // storing the image in public folder
            $image = $request->file('image'); // get the image from form
            $image_name = time().'.'.$image->getClientOriginalExtension(); // new name of file with timestamp
            $destinationPath = public_path('/images'); // securing the destination of the file
            $image->move($destinationPath, $image_name); // moves the image file to destination with new name
        }

        // update data
        $food->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'category_id' => $request->get('category'),
            'image' => $image_name,
        ]);

        /* $food->name = $request->get('name');
           $food->description = $request->get('description');
           $food->price = $request->get('price');
           $food->category_id = $request->get('category');
           $food->image = $db_image;
           $food->save();
        */

        // success message with redirect
        return redirect()->route('food.index')->with('message', 'Food item UPDATED!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find & hold the item from DB
        $food = Food::find($id);
        // delete
        $food->delete();
        // success message with redirect
        return redirect()->route('food.index')->with('message', 'Food item DELETED!!');
    }

    // to list all available foods to all users
    public function listFood()
    {
        $categories = Category::with('food')->get();
        return view('food.list', compact('categories'));
    }
    
    // to display details about a perticular food-item to all users
    public function view($id)
    {
        $food = Food::find($id);
        // return "ok";
        return view('food.detail', compact('food'));
    }
}
