<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\RecordType;
use App\Models\User;
use App\Models\Patient;
use App\Models\Appointment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\DoctorDetail;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::create(['name' => 'patient', 'guard_name' => 'api']);
        Role::create(['name' => 'doctor', 'guard_name' => 'api']);
        Role::create(['name' => 'admin', 'guard_name' => 'api']);
        Role::create(['name' => 'receptionist', 'guard_name' => 'api']);

        Medicine::create([
            'name' => 'Paracetamol',
            'description' => 'A painkiller',
            'price' => 100,
            'stock' => 10,
            'dosage' => '1 tablet',
            'unit' => 'tablet',
            'expired_at' => '2027-01-01'
        ]);

        Medicine::create([
            'name' => 'Betadine',
            'description' => 'A painkiller',
            'price' => 100,
            'stock' => 10,
            'dosage' => '1 tablet',
            'unit' => 'tablet',
            'expired_at' => '2027-01-01'
        ]);

        Medicine::create([
            'name' => 'bitamin C',
            'description' => 'A painkiller',
            'price' => 100,
            'stock' => 10,
            'dosage' => '1 tablet',
            'unit' => 'tablet',
            'expired_at' => '2027-01-01'
        ]);

        RecordType::create([
            'name' => 'General',
            'description' => 'General'
        ]);

        RecordType::create([
            'name' => 'Allergy',
            'description' => 'Allergy'
        ]);


        // User::factory(10)->create();

       $patientUser= User::factory()->create([
            'name' => 'Patient User',
            'email' => 'patient@gmail.com',
            'password'=> bcrypt('password')
        ]);

        $admin=User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password'=> bcrypt('password')
        ]);
        $admin->assignRole('admin');

        $receptionist=User::create([
            'name' => 'Receptionist User',
            'email' => 'receptionist@gmail.com',
            'password'=> bcrypt('password')
        ]);
        $receptionist->assignRole('receptionist');

        $patientUser->assignRole('patient');

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
            'email' => 'doctor@gmail.com',
            'password'=> bcrypt('password')
        ]);

        $doctorUser->assignRole('doctor');

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
}
