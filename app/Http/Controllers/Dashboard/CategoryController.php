<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Requests\addUpdateCategoriesRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where(function ($q) use ($request){

            return $q->when($request->search, function ($query) use ($request){

                return $query->where('name', "like", "%" . $request->search . "%");

            });
        })->latest()->paginate(3);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(addUpdateCategoriesRequest $request)
    {
        Category::create($request->all());
        return redirect(route('dashboard.category.index'))->with('success', 'Category Added Successfully');
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(addUpdateCategoriesRequest $request, Category $category)
    {
        Category::find($category->id)->update($request->all());
        return redirect(route('dashboard.category.index'))->with('success', 'Category Updated Successfully');
    }

    public function destroy(Category $category)
    {
        Category::find($category->id)->delete();
        return redirect(route('dashboard.category.index'))->with('danger', 'Category Deleted Successfully');
    }
}//end of controller
