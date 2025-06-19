<?php

namespace App\Http\Controllers\Api\Appointment;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Requests\Appointment\StoreAppointmentRequest;
use App\Http\Requests\Appointment\UpdateAppointmentRequest;
use App\Http\Resources\Appointment\AppointmentResource;
use App\Repositories\Appointment\AppointmentRepository;
use App\Traits\HttpResponse;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    use HttpResponse;
    protected $appointmentRepo;
    public function __construct(AppointmentRepository $appointmentRepository)
    {
        // $this->middleware('role:patient|reception')->only(['store']);
        $this->appointmentRepo = $appointmentRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $appointment = $this->appointmentRepo->getAllAppointment();
            return $this->success('success', AppointmentResource::collection($appointment), 'All Appointments are Retrieved', 200);
        } catch (Exception $e) {
            return $this->fail('fail', null, $e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        //
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();
            $appointment = $this->appointmentRepo->createAppointment($validatedData);
            $appointmentData = $this->appointmentRepo->getById($appointment);
            DB::commit();
            return $this->success('success', AppointmentResource::make($appointmentData), 'Appointment Created', 201);
        } catch (Exception $e) {
            DB::rollback();
            return $this->fail('fail', null, $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
        try {
            $appointmentData = $this->appointmentRepo->getById($appointment);
            return $this->success('success', AppointmentResource::make($appointmentData), 'Appointment Retrieved Successfully', 201);
        } catch (Exception $e) {
            return $this->fail('fail', null, $e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        //
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();

            $updated = $this->appointmentRepo->updateAppointment($appointment, $validatedData);

            if (!$updated) {
                DB::rollBack();
                return $this->fail('fail', null, 'Update failed', 400);
            }

            $appointmentData = $this->appointmentRepo->getById($appointment);
            DB::commit();
            return $this->success('success',  AppointmentResource::make($appointmentData), 'Appointment Updated Successfully!', 200);
        } catch (Exception $e) {
            DB::rollback();
            return $this->fail('fail', null, $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
        DB::beginTransaction();
        try {
            $appointment = $this->appointmentRepo->deleteAppointment($appointment);
            DB::commit();
            return $this->success('success', null, 'Appointment Deleted Successfully', 200);
        } catch (Exception $e) {
            DB::rollback();
            return $this->fail('fail', null, $e->getMessage(), 500);
        }
    }
}
