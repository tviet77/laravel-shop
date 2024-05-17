<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Components\Rescusive;

class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->latest()->paginate(5);
        return view('admin.category.index', compact('categories'));
    }
    public function create()
    {
        $htmlOption = $this->getCategory(0);
        return view('admin.category.create', compact('htmlOption'));
    }

    public function store(Request $request)
    {
        $this->category->create([
            'name' => $request->category_name,
            'parent_id' => $request->parent_id,
        ]);
        return redirect()->route('categories.index');
    }

    public function getCategory($parent_id)
    {
        $data = $this->category->all();
        $rescusive = new Rescusive($data);
        $htmlOption = $rescusive->categoryRecusive($parent_id);
        return $htmlOption;
    }

    public function edit($id)
    {
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);

        return view('admin.category.edit', compact('category', 'htmlOption'));
    }

    public function update($id, Request $request)
    {
        $this->category->find($id)->update([
            'name' => $request->category_name,
            'parent_id' => $request->parent_id,
        ]);
        return redirect()->route('categories.index');
    }

    public function delete($id)
    {
        $this->category->find($id)->delete();
        return redirect()->route('categories.index');
    }

}
