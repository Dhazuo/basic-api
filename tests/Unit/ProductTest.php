<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Enterprise;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_belongs_to_category()
    {
        $enterprise = Enterprise::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'enterprise_id' => $enterprise->id,
            'category_id' => $category->id,
        ]);

        $this->assertInstanceOf(Category::class, $product->category);
    }
    public function test_belongs_to_enterprise()
    {
        $enterprise = Enterprise::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'enterprise_id' => $enterprise->id,
            'category_id' => $category->id,
        ]);

        $this->assertInstanceOf(Enterprise::class, $product->enterprise);
    }
}
