<?php

namespace Tests\Feature;

use App\Exceptions\ServiceOrdersException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceOrdersControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_if_with_all_parameters_can_register_a_service_order(): void
    {
        $payload = [
            "user_id" => 1,
            "vehiclePlate" => "3211RDS",
            "entryDateTime" => "2021-02-16T15:06:15",
            "exitDateTime" => "2023-10-10T15:03:02",
            "priceType" => "money",
            "price" => 150.00
        ];

        $response = $this->postJson('/api/service-orders', $payload);

        $response->assertStatus(201);
        $this->assertDatabaseHas('service_orders', [
            'vehiclePlate' => $payload['vehiclePlate'],
            'user_id' => $payload['user_id'],
        ]);
    }

    public function test_it_cant_find_a_service_order_with_inexistent_plate()
    {
        $response = $this->getJson('/api/service-orders/1234ABC');

        $exception = ServiceOrdersException::notFoundAnyServiceOrderByPlate();

        $response
            ->assertStatus($exception->getCode())
            ->assertSee($exception->getMessage());
    }

    public function test_service_orders_cant_be_registered_without_right_payload()
    {
        $payload = [];

        $response = $this->postJson('/api/service-orders', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'user_id',
            'vehiclePlate',
            'entryDateTime',
            'exitDateTime',
            'priceType',
            'price',
        ]);
    }
}
