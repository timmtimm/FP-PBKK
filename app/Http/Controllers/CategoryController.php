<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Food;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cache_categ = 'key-category';
        $categories = Cache::get($cache_categ);

        $categories = Category::latest()->get();

        Cache::put($cache_categ, $categories, 60);

        return view('category.index',compact('categories'));
        // $foods = Food::latest()->paginate(1);
        // return view('food.index', compact('foods'));
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
        // dd($request->all());
        $this->validate($request,[
            'name' => 'required|min:3'
        ]);
        Category::create([
            'name' => $request->get('name')
        ]);
        return redirect()->back()->with('message','Kategori berhasil dibuat');
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
        $category = Category::find($id);
        return view('category.edit',compact('category'));
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
        $this->validate($request,[
            'name' => 'required|min:3'
        ]);
        $category = Category::find($id);
        $category->name = $request->get('name');
        $category->save();
        return redirect()->route('category.index')->with('message','Kategori berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index')->with('message','Kategori berhasil dihapus!');
        // $food = Food::find($id);
        // $food->delete();
        // return redirect()->route('food.index')->with('message', 'Food berhasil dihapus');
    }
}
