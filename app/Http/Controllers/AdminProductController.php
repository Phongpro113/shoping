<?php

namespace App\Http\Controllers;

use App\components\Recusive;
use App\Http\Requests\productRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Traits\StorageImageTrait;
use Hamcrest\Thingy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Tag;

class AdminProductController extends Controller
{
    private $product, $category, $productImage, $tag, $productTag;
    use StorageImageTrait;
    public function __construct(Product $product, Category $category, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        $this->product = $product;
        $this->category = $category;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }
    // ->category->name    //->latest()->paginate(5)
    public function index() {
        $data = $this->product->paginate(5);
        return view('admin.product.index', compact('data'));
    }

    public function getCategory($parentId, $parent) {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $html = $recusive->categoryRecusive($parentId, '', $parent);
        return $html;
    }

    public function create($parentId = '', $parent = null) {
        $html = $this->getCategory($parentId, $parent);
        return view('admin.product.add', compact('html'));
    }

    public function store(productRequest $request) {
        try {
            DB::beginTransaction();
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

            $product = $this->product->create($dataProductCreate);

//        Insert data to product_image
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $productImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $productImageDetail['file_path'],
                        'image_name' => $productImageDetail['file_name']
                    ]);
                }
            }

//        Insert to Tags for product
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;

//            $this->productTag->create([
//                'product_id' => $product->id,
//                'tag_id' => $tagInstance->id,
//            ]);
                }
            }

            $product->tags()->attach($tagIds);

            DB::commit();
            return redirect()->route('product.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            log::error('Message' . $exception->getMessage() . 'Line : ' .  $exception->getLine());
            return back()->withInput()->with('message', 'thiếu thông tin');
        }
    }
    public function edit($id) {
        $product = $this->product->find($id);
        $category = $this->getCategory(0, $product->category->id);
        return view('admin.product.edit', compact('product', 'category'));
    }

    public function update($id, Request $request) {
        try {
            DB::beginTransaction();
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

            $this->product->find($id)->update($dataProductCreate);
            $product = $this->product->find($id);

//        Insert data to product_image
            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request->image_path as $fileItem) {
                    $productImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $productImageDetail['file_path'],
                        'image_name' => $productImageDetail['file_name']
                    ]);
                }
            }

//        Insert to Tags for product
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;

                }
            }

            $product->tags()->sync($tagIds);

            DB::commit();
            return redirect()->route('product.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            log::error('Message' . $exception->getMessage() . 'Line : ' .  $exception->getLine());
            return back()->withInput()->with('message', 'thiếu thông tin');
        }
    }

    public function delete($id) {
        try {
            $product = $this->product->find($id)->delete();

            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);

        } catch (\Exception $exception) {
            log::error('Message' . $exception->getMessage() . 'Line : ' .  $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
