<?php

namespace App\Http\Controllers;

use App\components\Recusive;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $category = $this->category->latest()->paginate(5);
//        $id = $this->category->all()->getQueueableIds();
//        $name = $this->category->pluck('name');

        return view('admin.category.index', compact('category'));
    }

    public function getCategory($parentId, $parent) {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $html = $recusive->categoryRecusive($parentId, '', $parent);
        return $html;
    }

    public function create()
    {
        $html = $this->getCategory($parentId='', null);
        return view('admin.category.add', compact('html'));
    }

    public function store(Request $request)
    {
        $data = $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug('Anh Phong', '-')
        ]);
        return redirect()->route('categories.index');
    }

    public function edit($id) {
        $data = $this->category->find($id);
        $html = $this->getCategory($parentId=0, $data->parent_id);
        return view('admin.category.edit', compact('data', 'html'));
    }

    public function update($id, Request $request) {
        $data = $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug('Anh Phong', '-')
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function delete($id) {
        try {
            $data = $this->category->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);

        } catch (\Exception $exception) {
            log::error('Message' . $exception->getMessage() . 'Line : ' .  $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail serve'
            ], 500);
        }

    }
}
