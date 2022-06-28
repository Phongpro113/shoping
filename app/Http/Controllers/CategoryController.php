<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index');
    }

    public $html;
    public function create()
    {
        $this->recusive(0, '');
        $html = $this->html;
        return view('category.add', compact('html'));
    }

    public function recusive($id, $text){
        $data = Category::all();
        foreach ($data as $value){
            if ($value['parent_id'] == $id){
                $this->html .= "<option>". $text. $value['name'] ."</option>";
                $text .= '-';
                $this->recusive($value['id'], $text);
            }

        }
    }
}
