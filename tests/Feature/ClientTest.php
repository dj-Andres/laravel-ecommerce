<?php

namespace Tests\Feature;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */

    public function a_custumer_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson(route('client.store'),[
            'name' => 'Diego Jimenez',
            'cedula' => '0707012605',
            'ruc' => '0707012605',
            'address' => 'Mi casa',
            'phone' => '0979843533',
            'email' => 'diego96jp@gmail.com',
        ]);

        $custumers = Client::first();

    }
}
