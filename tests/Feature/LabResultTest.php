<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\LabResult;

class LabResultTest extends TestCase
{

    public function test_index_returns_lab_results()
    {
        LabResult::factory()->count(3)->create();
        $response = $this->getJson('/api/lab-results');
        $response->assertStatus(200)->assertJsonStructure(['status','data','message',]);
    }

    public function test_store_creates_lab_result()
    {
        $payload = [
            'appointment_id'  => 1,
            'test_name'       => 'Blood Test',
            'result_summary'  => 'Normal',
            'detailed_result' => 'Detailed description here',
            'performed_at'    => now(),
        ];

        $response = $this->postJson('/api/lab-results', $payload);
        $response->assertStatus(201)->assertJsonFragment(['test_name' => 'Blood Test']);
        $this->assertDatabaseHas('lab_results', ['appointment_id' => 1,'test_name' => 'Blood Test',]);
    }

    public function test_show_returns_specific_lab_result()
    {
        $lab = LabResult::factory()->create();
        $response = $this->getJson("/api/lab-results/{$lab->id}");
        $response->assertStatus(200)->assertJsonFragment(['id' => $lab->id]);
    }

    public function test_update_modifies_lab_result()
    {
        $lab = LabResult::factory()->create();
        $payload = [
            'appointment_id'  => 1,
            'test_name'       => 'Updated Test',
            'result_summary'  => 'Updated Summary',
            'detailed_result' => 'Updated Details',
            'performed_at'    => now()->addDay()->toDateString(),
        ];

        $response = $this->putJson("/api/lab-results/{$lab->id}", $payload);
        $response->assertStatus(201)->assertJsonFragment(['test_name' => 'Updated Test']);
        $this->assertDatabaseHas('lab_results', [
            'id' => $lab->id,
            'test_name' => 'Updated Test',
        ]);
    }

    public function test_destroy_deletes_lab_result()
    {
        $lab = LabResult::factory()->create();
        $response = $this->deleteJson("/api/lab-results/{$lab->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('lab_results', ['id' => $lab->id]);
    }
}
