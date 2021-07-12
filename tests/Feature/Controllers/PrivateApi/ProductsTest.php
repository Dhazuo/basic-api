<?php

namespace Tests\Feature\Controllers\PrivateApi;

use App\Models\Category;
use App\Models\Enterprise;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    //unauthenticated test
    public function test_unauthenticated_index()
    {
        $this->json('GET', 'api/private/products', ['Accept' => 'application/json'])
            ->assertStatus(401);
    }

    public function test_unauthenticated_show()
    {
        $category = Category::factory()->create();
        $enterprise = Enterprise::factory()->create();
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'enterprise_id' => $enterprise->id,
        ]);
        $this->json('GET', "api/private/products/$product->id", ['Accept' => 'application/json'])
            ->assertStatus(401);
    }

    //authenticated test
    public function test_authenticated_index()
    {
        Sanctum::actingAs(
            User::factory()->create(), ['*']
        );
        $this->json('GET', 'api/private/products', ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
    public function test_authenticated_show()
    {
        $category = Category::factory()->create();
        $enterprise = Enterprise::factory()->create();
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'enterprise_id' => $enterprise->id,
        ]);

        Sanctum::actingAs(
            User::factory()->create(), ['*']
        );
        $this->json('GET', "api/private/products/$product->id", ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
}
