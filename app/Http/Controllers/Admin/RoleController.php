<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller {
    public function index() {
        $roles = Role::paginate(10);
        return view('admin.roles.index', compact('roles'));
    }
}