<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminSettingCreateRequest;
use App\Models\AdminSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminSettingController extends Controller
{
    private $adminSetting;

    public function __construct(AdminSetting $adminSetting)
    {
        $this->adminSetting = $adminSetting;
    }

    public function index()
    {
        $adminSettings = $this->adminSetting->all();
        return view('admin.setting.index', compact('adminSettings'));
    }

    public function create()
    {
        return view('admin.setting.create');
    }

    public function store(AdminSettingCreateRequest $request)
    {
        $this->adminSetting->create([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
            'type' => $request->type
        ]);

        return redirect()->route('settings.index');
    }

    public function edit($id)
    {
        $adminSetting = $this->adminSetting->find($id);
        return view('admin.setting.edit', compact('adminSetting'));
    }

    public function update($id, Request $request)
    {
        $this->adminSetting->find($id)->update([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value
        ]);
        return redirect()->route('settings.index');
    }

    public function delete($id)
    {
        try {
            $this->adminSetting->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Delete item successfully!',
            ], status: 200);

        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Delete item failed!',
            ], status: 500);
        }
    }
}
