<?php

namespace App\Http\Controllers;

use App\components\MenuRecusive;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class MenuController extends Controller
{

    public $data;

    public function __construct(Menu $menu)
    {
        $this->data = $menu;
    }
    public function index() {
        $data = $this->data->all();
        return view('admin.menus.index', compact('data'));
    }

    public function getmenuRecusive($parentId) {
        $data = $this->data->all();
        $data = new MenuRecusive($data);
        $html = $data->menuRecusive($parentId);
        return $html;
    }

    public function create() {
        $html = $this->getmenuRecusive($parentId = '');
        return view('admin.menus.add', compact('html'));
    }

    public function store(Request $request) {
        $this->data->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name, '-')
        ]);
        return Redirect()->Route('menus.index');
    }

    public function edit($id) {
        $data= $this->data->find($id);
        $parentId = $data->parent_id;
        $html = $this->getmenuRecusive($parentId);
        return view('admin.menus.edit', compact('html', 'data'));
    }

    public function update(Request $request, $id) {
        $this->data->find($id)->update([
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'slug' => Str::Slug($request->name,'-')
        ]);
        return Redirect()->Route('menus.index');
    }

    public function delete($id) {
        $this->data->find($id)->delete();
        return Redirect()->route('menus.index');
    }
}
