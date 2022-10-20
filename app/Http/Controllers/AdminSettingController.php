<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Traits\deleteTrait;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    use deleteTrait;
    private $setting;
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function index() {
        $data = $this->setting->latest()->paginate(5);
        return view('admin.setting.index', compact('data'));
    }
    public function create() {
        return view('admin.setting.add');
    }
    public function store(Request $request) {
        $this->setting->create([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
            'type' => $request->type
        ]);
        return redirect()->route('setting.index');
    }
    public function edit($id) {
        $data = $this->setting->find($id);
        return view('admin.setting.edit', compact('data'));
    }
    public function update(Request $request, $id) {
        $this->setting->find($id)->update([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
        ]);
        return redirect()->route('setting.index');
    }
    public function delete($id) {
        return $this->deleteTrait($id, $this->setting);
    }
}
