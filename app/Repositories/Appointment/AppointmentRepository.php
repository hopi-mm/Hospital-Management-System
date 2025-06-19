<?php

namespace App\Repositories\Appointment;

use App\Models\Appointment;

class AppointmentRepository
{

    public function getAllAppointment()
    {
        return Appointment::all();
    }

    public function getById(Appointment $appointment)
    {
        return $appointment;
    }

    public function createAppointment($data)
    {
        return Appointment::create($data);
    }

    public function updateAppointment($appointment, $data)
    {
        return $appointment->update($data);
    }

    public function deleteAppointment(Appointment $appointment)
    {
        return $appointment->delete();
    }
}
