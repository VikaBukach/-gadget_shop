<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Створення таблиці products
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug', 100)->unique();
            $table->string('thumbnail')->nullable();
            $table->unsignedBigInteger('price')->default(0);

            // Зовнішній ключ для бренду
            $table->foreignIdFor(Brand::class)
                ->constrained()  // Автоматичне створення зовнішнього ключа
                ->cascadeOnUpdate()
                ->cascadeOnDelete();



//            $table->foreignId('brand_id')
//                ->constrained()
//                ->cascadeOnUpdate()
//                ->cascadeOnDelete();

            $table->timestamps();
        });

        // Створення таблиці category_product для зв'язку many-to-many
        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            // Зовнішній ключ для категорії
            $table->foreignIdFor(\App\Models\Category::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();


//            $table->foreignId('category_id')
//                ->constrained()
//                ->cascadeOnUpdate()
//                ->cascadeOnDelete();
            // Зовнішній ключ для продукту


            $table->foreignIdFor(\App\Models\Product::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();



//            $table->foreignId('product_id')
//                ->constrained()
//                ->cascadeOnUpdate()
//                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {

        if(app()->isLocal()){
            Schema::dropIfExists('category_product');
            Schema::dropIfExists('products');
        }
    }
};
