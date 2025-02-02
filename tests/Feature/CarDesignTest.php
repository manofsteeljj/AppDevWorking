<?php

namespace Tests\Feature;

use App\Models\CarDesign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class CarDesignTest extends TestCase
{
    use RefreshDatabase; // This will ensure that the database is reset after each test

    /** @test */
    public function it_shows_car_designs_list()
    {
        // Create a car design in the database
        $carDesign = CarDesign::factory()->create();

        // Hit the car designs index route
        $response = $this->get(route('car_designs.index'));

        // Check that the response contains the car design
        $response->assertStatus(200);
        $response->assertSee($carDesign->name); // Check if the name is visible in the response
    }

    /** @test */
    public function it_creates_a_new_car_design()
    {
        // Data for creating a new car design
        $data = [
            'name' => 'Tesla Model S',
            'model' => '2024',
            'description' => 'Electric car',
        ];

        // Hit the store route to create the car design
        $response = $this->post(route('car_designs.store'), $data);

        // Check that the car design is stored in the database
        $this->assertDatabaseHas('car_designs', $data);

        // Check the response
        $response->assertRedirect(route('car_designs.index'));
        $response->assertSessionHas('success'); // Ensure a success message is flashed
    }

    /** @test */
    public function it_updates_an_existing_car_design()
    {
        // Create a car design
        $carDesign = CarDesign::factory()->create();

        // Data to update the car design
        $data = [
            'name' => 'Updated Tesla Model S',
            'model' => '2025',
            'description' => 'Updated description',
        ];

        // Hit the update route
        $response = $this->put(route('car_designs.update', $carDesign->id), $data);

        // Check if the database is updated
        $carDesign->refresh();
        $this->assertEquals('Updated Tesla Model S', $carDesign->name);
        $this->assertEquals('2025', $carDesign->model);

        // Check the response
        $response->assertRedirect(route('car_designs.index'));
        $response->assertSessionHas('success'); // Ensure a success message is flashed
    }

    /** @test */
    public function it_deletes_a_car_design()
    {
        // Create a car design
        $carDesign = CarDesign::factory()->create();

        // Hit the destroy route
        $response = $this->delete(route('car_designs.destroy', $carDesign->id));

        // Check if the car design is deleted from the database
        $this->assertDatabaseMissing('car_designs', ['id' => $carDesign->id]);

        // Check the response
        $response->assertRedirect(route('car_designs.index'));
        $response->assertSessionHas('success'); // Ensure a success message is flashed
    }
}
