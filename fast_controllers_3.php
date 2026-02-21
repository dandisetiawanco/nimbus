<?php

$controllersDir = __DIR__ . '/app/Http/Controllers/';

$map = [
    'PostController' => ['Post', 'posts', 'posts'],
    'MediaController' => ['Media', 'media', 'media'],
    'MenuController' => ['Menu', 'menus', 'menus'],
    'SettingController' => ['Setting', 'settings', 'settings'],
    'AuditLogController' => ['AuditLog', 'auditLogs', 'audit-logs'],
];

foreach ($map as $file => $data) {
    $model = $data[0];
    $var = $data[1];
    $view = $data[2];
    
    $content = <<<EOT
<?php
namespace App\Http\Controllers;
use App\Models\\$model;
use Illuminate\Http\Request;

class $file extends Controller {
    public function index() {
        $$var = $model::paginate(10);
        return view('admin.$view.index', compact('$var'));
    }
}
EOT;
    
    file_put_contents($controllersDir . $file . '.php', $content);
}

// Special case for Settings since SettingController was specified as just `index` and `store` in routes/web.php
$settingContent = <<<EOT
<?php
namespace App\Http\Controllers;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller {
    public function index() {
        \$settings = Setting::paginate(10);
        return view('admin.settings.index', compact('settings'));
    }
    public function store(Request \$request) { return back(); }
}
EOT;
file_put_contents($controllersDir . 'SettingController.php', $settingContent);

echo "Controllers updated successfully.\n";
