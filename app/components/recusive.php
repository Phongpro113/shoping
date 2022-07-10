<?php
namespace App\components;

use App\Models\Category;

class Recusive {
    private $data;
    private $html = null;
    public function __construct($data)
    {
         $this->data = $data;
    }

    public function categoryRecusive($parentid = 0, $text = '', $parent = null){
        foreach ($this->data as $value) {
                if ($value['parent_id'] ==  $parentid) {
                    $flag = $value['id'] ==  $parent;
                    $this->html .= "<option ". ($flag ? 'selected' : '') . " value=".$value['id'].">". $text.$value['name'] ."</option>";
                    self::categoryRecusive($value['id'], $text.'-', $parent);
                }
        }
        return $this->html;
    }
}
