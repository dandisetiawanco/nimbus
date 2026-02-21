<?php
namespace App\Http\Controllers;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller {
    public function index() {
        $settings = Setting::paginate(10);
        return view('admin.settings.index', compact('settings'));
    }
    public function store(Request $request) { return back(); }
}