<?php

namespace Tests\Unit;

use App\Http\Requests\StoreCandidateRequest;
use App\Models\Candidate;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

// use PHPUnit\Framework\TestCase;

class CandidateTest extends TestCase
{
    use DatabaseTransactions;

    public function test_success_get_all_candidate(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $this->get('/api/candidate')->assertStatus(200);

    }

    public function test_failed_get_all_candidate_unauthenticated(): void
    {
        $this->get('/api/candidate')->assertStatus(500);
    }

    public function test_success_get_one_candidate(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $this->get('/api/candidate/1')->assertStatus(200);
    }

    public function test_failed_get_one_candidate_unauthenticated(): void
    {
        $this->get('/api/candidate/1')->assertStatus(500);
    }

    public function test_failed_get_one_candidate_data_not_found(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $this->get('/api/candidate/1000')->assertStatus(404);
    }

    public function test_success_store_candidate(): void
{
    $user = User::first();
    $this->actingAs($user,'api');
    Storage::fake('public');
    $file = UploadedFile::fake()->create('test.pdf', 1000, 'application/pdf');
    $resume_url = Storage::url($file);
    $data = Candidate::factory([
        'resume' => $file,
        'resume_url' => $resume_url,
        'email' => 'test@email.com',
    ])->make()->toArray();
    $validatedData = new StoreCandidateRequest($data);
    $this->postJson('/api/candidate', $validatedData->toArray(),['X-Test-Request' => true])->assertStatus(201);
}


    public function test_failed_store_candidate_unauthenticated(): void
    {
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $this->postJson( '/api/candidate', $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_failed_store_candidate_name_missing(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $data = Arr::except($data, ['name']);
        $this->postJson( '/api/candidate', $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_failed_store_candidate_experience_missing(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $data = Arr::except($data, ['experience']);
        $this->postJson( '/api/candidate', $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_failed_store_candidate_education_missing(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $data = Arr::except($data, ['education']);
        $this->postJson( '/api/candidate', $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_failed_store_candidate_bod_missing(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $data = Arr::except($data, ['bod']);
        $this->postJson( '/api/candidate', $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_failed_store_candidate_last_position_missing(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $data = Arr::except($data, ['last_position']);
        $this->postJson( '/api/candidate', $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_failed_store_candidate_applied_position_missing(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $data = Arr::except($data, ['applied_position']);
        $this->postJson( '/api/candidate', $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_failed_store_candidate_skills_missing(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $data = Arr::except($data, ['skills']);
        $this->postJson( '/api/candidate', $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_failed_store_candidate_email_missing(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $data = Arr::except($data, ['email']);
        $this->postJson( '/api/candidate', $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_failed_store_candidate_phone_missing(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $data = Arr::except($data, ['phone']);
        $this->postJson( '/api/candidate', $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_success_update_candidate(): void
    {
        $user = User::InRandomOrder()->first();
        $this->actingAs($user,'api');
        Storage::fake('public');
        $file = UploadedFile::fake()->create('test.pdf', 1000, 'application/pdf');
        $resume_url = Storage::url($file);
        $data = Candidate::factory([
            'resume' => $file,
            'resume_url' => $resume_url,
            'email' => 'testupdate@email.com',
        ])->make()->toArray();
        $validatedData = new StoreCandidateRequest($data);
        $oldDataId = Candidate::InRandomOrder()->first()->id;
        $this->patchJson(route('candidate.update', $oldDataId), $validatedData->toArray(),['X-Test-Request' => true])->assertStatus(200);
    }

    public function test_failed_update_candidate_unauthenticated(): void
    {
        $oldDataId = Candidate::InRandomOrder()->first()->id;
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $this->patchJson(route('candidate.update', $oldDataId), $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_failed_update_candidate_data_not_found(): void
    {
        $user = User::InRandomOrder()->first();
        $this->actingAs($user,'api');
        $oldDataId = 1000;
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $this->patchJson(route('candidate.update', $oldDataId), $data,['X-Test-Request' => true])->assertStatus(404);
    }


    public function test_failed_update_candidate_name_missing(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $oldDataId = Candidate::InRandomOrder()->first()->id;
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $data = Arr::except($data, ['name']);
        $this->patchJson(route('candidate.update', $oldDataId), $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_failed_update_candidate_experience_missing(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $oldDataId = Candidate::InRandomOrder()->first()->id;
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $data = Arr::except($data, ['experience']);
        $this->patchJson(route('candidate.update', $oldDataId), $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_failed_update_candidate_education_missing(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $oldDataId = Candidate::InRandomOrder()->first()->id;
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $data = Arr::except($data, ['education']);
        $this->patchJson(route('candidate.update', $oldDataId), $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_failed_update_candidate_bod_missing(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $oldDataId = Candidate::InRandomOrder()->first()->id;
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $data = Arr::except($data, ['bod']);
        $this->patchJson(route('candidate.update', $oldDataId), $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_failed_update_candidate_last_position_missing(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $oldDataId = Candidate::InRandomOrder()->first()->id;
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $data = Arr::except($data, ['last_position']);
        $this->patchJson(route('candidate.update', $oldDataId), $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_failed_update_candidate_applied_position_missing(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $oldDataId = Candidate::InRandomOrder()->first()->id;
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $data = Arr::except($data, ['applied_position']);
        $this->patchJson(route('candidate.update', $oldDataId), $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_failed_update_candidate_skills_missing(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $oldDataId = Candidate::InRandomOrder()->first()->id;
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $data = Arr::except($data, ['skills']);
        $this->patchJson(route('candidate.update', $oldDataId), $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_failed_update_candidate_email_missing(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $oldDataId = Candidate::InRandomOrder()->first()->id;
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $data = Arr::except($data, ['email']);
        $this->patchJson(route('candidate.update', $oldDataId), $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_failed_update_candidate_phone_missing(): void
    {
        $user = User::first();
        $this->actingAs($user,'api');
        $oldDataId = Candidate::InRandomOrder()->first()->id;
        $data = Candidate::factory(['email' => 'test@email.com'])->make()->toArray();
        $data = Arr::except($data, ['phone']);
        $this->patchJson(route('candidate.update', $oldDataId), $data,['X-Test-Request' => true])->assertStatus(500);
    }

    public function test_success_delete_candidate(): void
    {
        $this->assertTrue(true);
        $user = User::first();
        $this->actingAs($user,'api');
        $this->deleteJson('/api/candidate/1')->assertStatus(200);
    }

    public function test_failed_delete_candidate_unauthenticated(): void
    {
        $this->deleteJson('/api/candidate/1')->assertStatus(500);
    }

    public function test_failed_delete_candidate_data_not_found(): void
    {
        $this->assertTrue(true);
        $user = User::first();
        $this->actingAs($user,'api');
        $this->deleteJson('/api/candidate/1000')->assertStatus(404);
    }
}
