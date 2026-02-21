<?php
namespace App\Http\Controllers;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller {
    public function index() {
        $menus = Menu::paginate(10);
        return view('admin.menus.index', compact('menus'));
    }
}