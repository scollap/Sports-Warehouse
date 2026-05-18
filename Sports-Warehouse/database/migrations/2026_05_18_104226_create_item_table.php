<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item', function (Blueprint $table) {
            $table->integer('itemId', true)->index('itemid');
            $table->string('itemName', 150);
            $table->string('photo', 250)->nullable();
            $table->decimal('price', 10);
            $table->decimal('salePrice', 10)->nullable();
            $table->string('description', 2000)->nullable();
            $table->boolean('featured');
            $table->integer('categoryId')->index('fk_itemcategory');

            $table->primary(['itemId']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item');
    }
};
