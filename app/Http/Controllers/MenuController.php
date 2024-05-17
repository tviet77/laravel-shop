<?php

namespace App\Http\Controllers;

use App\Components\MenuRecursive;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $menuRecursive;
    private $menu;

    public function __construct(MenuRecursive $menuRecursive, Menu $menu)
    {
        $this->menuRecursive = $menuRecursive;
        $this->menu = $menu;
    }

    public function index()
    {
        $menus = $this->menu->latest()->paginate(5);
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $optionMenus = $this->menuRecursive->menuRecusiveAdd();
        return view('admin.menus.create', compact('optionMenus'));
    }

    public function store (Request $request)
    {
        $this->menu->create([
            'name' => $request->menu_name,
            'parent_id' => $request->parent_id,
        ]);
        return redirect()->route('menus.index');
    }

    public function edit($id, Request $request)
    {
        $menu = $this->menu->find($id);
        $optionMenus = $this->menuRecursive->menuRecusiveEdit($menu->parent_id);
        return view('admin.menus.edit', compact('menu', 'optionMenus'));
    }

    public function update($id, Request $request)
    {
        $this->menu->find($id)->update([
            'menu_name' => $request->menu_name,
            'parent_id' => $request->parent_id,
        ]);
        return redirect()->route('menus.index');
    }

    public function delete($id)
    {
        $this->menu->find($id)->delete();
        return redirect()->route('menus.index');
    }
}
