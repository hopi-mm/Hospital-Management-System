<?php

namespace App\Http\Controllers\Api\Medicine;

use App\Http\Requests\Medicine\StoreMedicineRequest;
use App\Http\Requests\Medicine\UpdateMedicineRequest;
use App\Http\Resources\Medicine\MedicineResource;
use App\Models\Medicine;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Medicine\MedicineRepository;

class MedicineController extends Controller
{
    use HttpResponse;
    protected $medicineRepo;

    public function __construct(MedicineRepository $medicineRepo)
    {
        $this->medicineRepo = $medicineRepo;
    }
    public function index()
    {
        try {
            $medicines = $this->medicineRepo->allMedicines();
            return $this->success('success', MedicineResource::collection($medicines), 'Medicines Fetched Successfully', 200);
        } catch (\Exception $e) {
            return $this->fail('error', null, $e->getMessage(), 500);
        }
    }

    public function store(StoreMedicineRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $medicines = $this->medicineRepo->createMedicine($validatedData);
            $createdMedicine = $this->medicineRepo->getById($medicines);
            return $this->success('success', MedicineResource::make($createdMedicine), 'Medicine Created Successfully', 201);
        } catch (\Exception $e) {
            return $this->fail('error', null, $e->getMessage(), 500);
        }
    }

    public function show(Medicine $medicine)
    {
        try {
            $medicine = $this->medicineRepo->getById($medicine);
            return $this->success('success', MedicineResource::make($medicine), 'Medicine Created Successfully', 201);
        } catch (\Exception $e) {
            return $this->fail('error', null, $e->getMessage(), 500);
        }
    }

    public function update(UpdateMedicineRequest $request, Medicine $medicine)
    {
        try {
            $validatedData = $request->validated();
            $medicine = $this->medicineRepo->updateMedicine($validatedData, $medicine);
            $updatedMedicine = $this->medicineRepo->getById($medicine);
            return $this->success('success', MedicineResource::make($updatedMedicine), 'Medicine Updated Successfully', 201);
        } catch (\Exception $e) {
            return $this->fail('error', null, $e->getMessage(), 500);
        }
    }

    public function destroy(Medicine $medicine)
    {
        try {
            $medicine = $this->medicineRepo->deleteById( $medicine);
            return $this->success('success', null, 'Medicine Deleted Successfully', 204);
        } catch (\Exception $e) {
            return $this->fail('error', null, $e->getMessage(), 500);
        }
    }


}
