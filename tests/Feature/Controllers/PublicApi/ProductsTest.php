<?php

namespace Tests\Feature\Controllers\PublicApi;

use App\Models\Category;
use App\Models\Enterprise;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_public()
    {
        $this->json('GET', 'api/public/products', ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
    public function test_one_product_public()
    {
        $category = Category::factory()->create();
        $enterprise = Enterprise::factory()->create();
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'enterprise_id' => $enterprise->id,
        ]);

        $this->json('GET', "api/public/products/$product->id", ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
}
