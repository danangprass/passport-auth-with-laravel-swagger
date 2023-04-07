<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Tests\TestCase;

// use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    use DatabaseTransactions;
   public function test_success_get_all_data_product()
   {
    $user = User::first();
    $this->actingAs($user,'api');
    $respons = $this->get('/api/product');
    $respons->assertStatus(200);
   }

   public function test_failed_get_all_data_product()
   {
    $respons = $this->get('/api/product');
    $respons->assertStatus(500);
   }

   public function test_success_get_one_data_product()
   {
    $user = User::first();
    $token = $user->createToken('TestToken')->accessToken;
    $headers = ['Authorization' => "Bearer $token"];
    $respons = $this->get('/api/product/1', $headers);
    $respons->assertStatus(200);
   }

   public function test_failed_get_one_data_product()
   {
    $respons = $this->get('/api/product/1');
    $respons->assertStatus(500);
   }

   public function test_failed_get_one_data_product_not_found()
   {
    $user = User::first();
    $this->actingAs($user,'api');
    $respons = $this->get('/api/product/1000');
    $respons->assertStatus(404);
   }

   public function test_success_store_data_product()
   {
    $user = User::first();
    $this->actingAs($user,'api');
    $respons = $this->post('/api/product', [
        'name' => 'test',
        'detail' => 'test'
    ]);
    $respons->assertStatus(201);
   }

   public function test_failed_store_data_product_unauhenticated()
   {
    $respons = $this->post('/api/product', [
        'name' => 'test',
        'detail' => 'test'
    ]);
    $respons->assertStatus(500);
   }

   public function test_failed_store_data_product_name_missing()
   {
    $user = User::first();
    $this->actingAs($user,'api');
    $respons = $this->post('/api/product', [
        'detail' => 'test'
    ]);
    $respons->assertStatus(500)->assertSeeText('The name field is required.');
   }

   public function test_failed_store_data_product_detail_missing()
   {
    $user = User::first();
    $this->actingAs($user,'api');
    $respons = $this->post('/api/product', [
        'name' => 'test'
    ]);
    $respons->assertStatus(500)->assertSeeText('The detail field is required.');
   }
}
