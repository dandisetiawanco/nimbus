<?php

$modelsDir = __DIR__ . '/app/Models/';

$userContent = file_get_contents($modelsDir . 'User.php');
if (strpos($userContent, 'HasRoles') === false) {
    $userContent = str_replace(
        'use Illuminate\Foundation\Auth\User as Authenticatable;',
        "use Illuminate\Foundation\Auth\User as Authenticatable;\nuse Spatie\Permission\Traits\HasRoles;",
        $userContent
    );
    $userContent = str_replace(
        'use Notifiable;',
        "use Notifiable, HasRoles;",
        $userContent
    );
    file_put_contents($modelsDir . 'User.php', $userContent);
}

$templates = [
    'Page.php' => <<<'EOT'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model {
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author() { return $this->belongsTo(User::class, 'created_by'); }
    public function updater() { return $this->belongsTo(User::class, 'updated_by'); }
    public function featuredImage() { return $this->belongsTo(Media::class, 'featured_image_id'); }
    public function pageComponents() { return $this->hasMany(PageComponent::class)->orderBy('order'); }
}
EOT,

    'Post.php' => <<<'EOT'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author() { return $this->belongsTo(User::class, 'created_by'); }
    public function updater() { return $this->belongsTo(User::class, 'updated_by'); }
    public function featuredImage() { return $this->belongsTo(Media::class, 'featured_image_id'); }
    public function categories() { return $this->belongsToMany(Category::class); }
    public function tags() { return $this->belongsToMany(Tag::class); }
}
EOT,

    'Category.php' => <<<'EOT'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    use HasFactory;
    protected $guarded = [];
    public function posts() { return $this->belongsToMany(Post::class); }
}
EOT,

    'Tag.php' => <<<'EOT'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
    use HasFactory;
    protected $guarded = [];
    public function posts() { return $this->belongsToMany(Post::class); }
}
EOT,

    'Media.php' => <<<'EOT'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model {
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['url'];

    public function uploadedBy() { return $this->belongsTo(User::class, 'uploaded_by'); }
    
    public function getUrlAttribute() {
        return Storage::disk($this->disk)->url($this->path);
    }
}
EOT,

    'Menu.php' => <<<'EOT'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model {
    use HasFactory;
    protected $guarded = [];
    public function items() { return $this->hasMany(MenuItem::class)->whereNull('parent_id')->orderBy('order'); }
    public function allItems() { return $this->hasMany(MenuItem::class)->orderBy('order'); }
}
EOT,

    'MenuItem.php' => <<<'EOT'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model {
    use HasFactory;
    protected $guarded = [];
    
    public function menu() { return $this->belongsTo(Menu::class); }
    public function parent() { return $this->belongsTo(MenuItem::class, 'parent_id'); }
    public function children() { return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order'); }
}
EOT,

    'Component.php' => <<<'EOT'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model {
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'schema' => 'json',
    ];
}
EOT,

    'PageComponent.php' => <<<'EOT'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageComponent extends Model {
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'data' => 'json',
    ];

    public function page() { return $this->belongsTo(Page::class); }
    public function component() { return $this->belongsTo(Component::class); }
}
EOT,

    'Setting.php' => <<<'EOT'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model {
    use HasFactory;
    protected $guarded = [];
}
EOT,

    'AuditLog.php' => <<<'EOT'
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model {
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'before' => 'json',
        'after' => 'json',
    ];
    public $timestamps = false;
    
    public function user() { return $this->belongsTo(User::class); }
}
EOT,
];


foreach ($templates as $file => $content) {
    file_put_contents($modelsDir . $file, $content);
    echo "Updated $file\n";
}
