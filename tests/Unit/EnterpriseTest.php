<?php

namespace Tests\Unit;

use App\Models\Enterprise;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnterpriseTest extends TestCase
{
    use RefreshDatabase;

    public function test_enterprise_has_many_products()
    {
        $enterprise = new Enterprise();

        $this->assertInstanceOf(Collection::class, $enterprise->products);
    }
}
