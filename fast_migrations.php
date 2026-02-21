<?php

$migrationsDir = __DIR__ . '/database/migrations/';
$files = scandir($migrationsDir);

$templates = [
    'create_pages_table' => <<<'EOT'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('status', ['draft', 'review', 'published', 'archived'])->default('draft');
            $table->longText('content')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->foreignId('featured_image_id')->nullable()->constrained('media')->nullOnDelete();
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('pages'); }
};
EOT,

    'create_posts_table' => <<<'EOT'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('body')->nullable();
            $table->enum('status', ['draft', 'review', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->foreignId('featured_image_id')->nullable()->constrained('media')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('posts'); }
};
EOT,

    'create_categories_table' => <<<'EOT'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        Schema::create('category_post', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
        });
    }
    public function down(): void { 
        Schema::dropIfExists('category_post');
        Schema::dropIfExists('categories'); 
    }
};
EOT,

    'create_tags_table' => <<<'EOT'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });
        Schema::create('post_tag', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
        });
    }
    public function down(): void { 
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('tags'); 
    }
};
EOT,

    'create_media_table' => <<<'EOT'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('disk')->default('public');
            $table->string('path');
            $table->string('filename');
            $table->string('mime');
            $table->unsignedBigInteger('size');
            $table->string('alt_text')->nullable();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('media'); }
};
EOT,

    'create_menus_table' => <<<'EOT'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->enum('location', ['header', 'footer', 'sidebar'])->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('menus'); }
};
EOT,

    'create_menu_items_table' => <<<'EOT'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained()->cascadeOnDelete();
            $table->string('label');
            $table->enum('type', ['url', 'page', 'post', 'category'])->default('url');
            $table->string('url')->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('menu_items')->cascadeOnDelete();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('menu_items'); }
};
EOT,

    'create_components_table' => <<<'EOT'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['hero', 'cta', 'faq', 'gallery', 'richtext']);
            $table->json('schema')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('components'); }
};
EOT,

    'create_page_components_table' => <<<'EOT'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('page_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->cascadeOnDelete();
            $table->foreignId('component_id')->constrained()->cascadeOnDelete();
            $table->integer('order')->default(0);
            $table->json('data')->nullable(); // override data
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('page_components'); }
};
EOT,

    'create_settings_table' => <<<'EOT'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('settings'); }
};
EOT,

    'create_audit_logs_table' => <<<'EOT'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action'); // create, update, delete
            $table->string('auditable_type')->nullable();
            $table->unsignedBigInteger('auditable_id')->nullable();
            $table->json('before')->nullable();
            $table->json('after')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }
    public function down(): void { Schema::dropIfExists('audit_logs'); }
};
EOT,
];


foreach ($files as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
        foreach ($templates as $key => $content) {
            if (strpos($file, $key) !== false) {
                file_put_contents($migrationsDir . $file, $content);
                echo "Updated $file\n";
            }
        }
    }
}
