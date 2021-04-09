<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Category::all();
        return view('admin.category.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Category::all();
        return view('admin.category.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // check the data of the category creation form
        $this->validate($request, [
            'parent_id' => 'integer',
            'title' => 'required|max:100',
            'alias' => 'required|max:100|unique:categories,alias|alpha_dash',
        ]);

        // verification passed, save the category
        $category = Category::create($request->all());
        return redirect()
            ->route('admin.category.show', ['category' => $category->id])
            ->with('success', 'New category successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $items = Category::all();
        return view('admin.category.edit', compact('category', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
         // Сheck the data of the category edit form
         $id = $category->id;
         $this->validate($request, [
             'parent_id' => 'integer',
             'title' => 'required|max:100',
              // Checking for uniqueness of фдшфы, excluding this category by identifier:
              // 1.categories - database table where uniqueness is checked
              // 2.alias - the name of the column, the uniqueness of the value of which is checked
              // 3.value by which the entry of the database table is excluded from the check
              // 4.field by which the entry of the database table is excluded from the check
              // The following SQL query to the database will be used for verification
              // SELECT COUNT(*) FROM `categories` WHERE `alias` = '...' AND `id` <> 17
             'alias' => 'required|max:100|unique:categories,alias,'.$id.',id|alpha_dash',
         ]);
         // verification passed, updating the category
         $category->update($request->all());
         return redirect()
             ->route('admin.category.show', ['category' => $category->id])
             ->with('success', 'Category successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->children->count()) {
            $errors[] = 'Cannot delete a category with child categories';
        }
        if ($category->products->count()) {
            $errors[] = 'You cannot delete a category that contains products';
        }
        if (!empty($errors)) {
            return back()->withErrors($errors);
        }
        $category->delete();
        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Category successfully deleted');
    }
}
