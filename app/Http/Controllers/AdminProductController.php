<?php

namespace App\Http\Controllers;

use App\components\Recusive;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    private $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index() {
        return view('admin.product.index');
    }

    public function getCategory($parentId, $parent) {
        $data = Category::all();
        $recusive = new Recusive($data);
        $html = $recusive->categoryRecusive($parentId, '', $parent);
        return $html;
    }

    public function create($parentId = '', $parent = null) {

        $html = $this->getCategory($parentId, $parent);
        return view('admin.product.add', compact('html'));
    }

    public function store(Request $request) {
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->parent_id,
            'content' => $request->content,
            'user_id' => $request->user_id
        ]);
    }
}
