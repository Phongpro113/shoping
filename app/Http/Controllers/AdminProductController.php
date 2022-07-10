<?php

namespace App\Http\Controllers;

use App\components\Recusive;
use App\Models\Category;
use App\Models\Product;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class AdminProductController extends Controller
{
    private $product;
    use StorageImageTrait;
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
        $dataProductCreate = [
            'name' => $request->name,
            'price' => $request->price,
            'content' => $request->contents,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
        ];
        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
        if (!empty($dataUploadFeatureImage)){
            $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            $dataProductCreate['file_name'] = $dataUploadFeatureImage['file_name'];
        }

        $product = $this->product->Create($dataProductCreate);
        dd($product);
    }
}
