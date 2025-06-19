<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Patient;
use App\Models\Medicine;
use App\Models\Appointment;
use App\Models\DoctorDetail;
use App\Models\MedicalRecord;
use Spatie\Permission\Models\Role;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MedicalRecordTest extends TestCase
{

    use RefreshDatabase;

    protected $appointment,$recordType,$patient,$doctor;
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    #[Test]
    public function setUp(): void{
        parent::setUp();
        $date = now(); // or Carbon::now()
        $formatted = $date->format('Y-m-d');

        //  Role::create(['name' => 'patient', 'guard_name' => 'api']);
        // Role::create(['name' => 'doctor', 'guard_name' => 'api']);
        // Role::create(['name' => 'admin', 'guard_name' => 'api']);
        // Role::create(['name' => 'receptionist', 'guard_name' => 'api']);

        $patientUser= User::factory()->create([
                'name' => 'Patient User',
                'email' => 'patienttt@gmail.com',
                'password'=> bcrypt('password')
            ]);

            // $patientUser->assignRole(Role::findByName('patient','api'));

          $patient=Patient::create([
                'user_id'=>$patientUser->id,
                'name' => 'Patient',
                'relation' => 'me',
                'gender' => 'male',
                'dob' => '2000-01-01',
                'blood_type' => 'A+',
                'phone' => '1234567890'
            ]);

            $doctorUser=User::create([
                'name' => 'Doctor User',
                'email' => 'doctorr@gmail.com',
                'password'=> bcrypt('password')
            ]);

            // $doctorUser->assignRole(Role::findByName('doctor','api'));

            $doctor=DoctorDetail::create([
                'user_id'=>$doctorUser->id,
                'speciality' => json_encode(['Speciality 1', 'Speciality 2']),
                'experience' => json_encode(['Experience 1', 'Experience 2']),
                'education' => 'Education',
                'license_number' => '1234567890',
                  'availability' => [
                    'Mon' => ['09:00', '11:00', '13:00', '15:00'],
                    'Tue' => ['09:00', '11:00', '13:00', '15:00'],
                    'Wed' => ['09:00', '11:00', '13:00', '15:00'],
                    'Thu' => ['09:00', '11:00', '13:00', '15:00'],
                    'Fri' => ['09:00', '11:00', '13:00', '15:00'],
                ],
            ]);

            $appointment=Appointment::create([
                'patient_id'=>$patient->id,
                'doctor_id'=>$doctor->user_id,
                'stat_date' => '2023-01-01',
                'start_time' => '09:00',
                'status' => 'pending',
                'remarks'=>'Remarks'
            ]);


    }

#[Test]
    public function it_creates_medical_record_successfully()
    {
        $medicine = Medicine::create([
            'name' => 'Test Medicine',
            'description' => 'Test Description',
            'dosage' => 'Test Dosage',
            'unit' => 'Test Unit',
            'stock' => 100,
            'price' => 1000,
            'expired_at' => now()->addDays(7)
        ]);

        $medicalRecord=MedicalRecord::create([
            'appointment_id'=>$this->appointment->id,
            'record_type_id'=>1,
            'total_medicine_price'=>0  ,
            'title'=>'title',
            'description'=>'description'
        ]);

        $medicalRecord->medicines()->attach($medicine->id,[
            'quantity'=>2,
        ]);


        $data = [
            'appointment_id' => $this->appointment->id,
            'record_type_id' => '1',
            'total_medicine_price' => 2000,
            'title' => 'Test Title',
            'description' => 'Test Description',
            'medicines' => [
                [
                    'medicine_id' => $medicine->id,
                    'quantity' => 2,
                ]
            ]
        ];

        $response = $this->postJson(route('medical-records.store'), $data);

        $response->assertCreated();
        $this->assertDatabaseHas('medical_records', [
            'total_medicine_price' => 2000
        ]);

        $this->assertEquals(98, $medicine->fresh()->stock); // stock reduced
    }

    #[Test]
    public function it_fails_when_medicine_is_out_of_stock()
    {
        $medicine = Medicine::factory()->create([
            'stock' => 0,
            'price' => 1000
        ]);

        $data = [
            'patient_id' => 1,
            'diagnosis' => 'Test Diagnosis',
            'medicines' => [
                [
                    'medicine_id' => $medicine->id,
                    'quantity' => 1,
                ]
            ]
        ];

        $response = $this->postJson(route('medical-records.store'), $data);

        $response->assertStatus(500);
        $response->assertJsonFragment(['message' => "Medicine '{$medicine->name}' is out of stock."]);
    }

    #[Test]
    public function it_rolls_back_if_exception_occurs()
    {
        // No medicine provided → it will throw in logic when looping
        $data = [
            'patient_id' => 1,
            'diagnosis' => 'Test Diagnosis',
            'medicines' => []
        ];

        $response = $this->postJson(route('medical-records.store'), $data);
        $response->assertStatus(500);

        $this->assertDatabaseCount('medical_records', 0);
    }

    #[Test]
    public function it_validates_required_fields()
    {
        $response = $this->postJson(route('medical-records.store'), []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['patient_id', 'diagnosis', 'medicines']);
    }
}
