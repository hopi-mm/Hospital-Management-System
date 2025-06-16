<?php

namespace App\Repositories\MedicalRecord;

use App\Exceptions\OutOfStockException;
use App\Models\Medicine;
use App\Models\MedicalRecord;

class MedicalRecordRepository{


    public function allMedicalRecords(){
        return MedicalRecord::all();
    }

    public function createMedicalRecord($data){
        $medicalRecord= MedicalRecord::create($data);

        $totalMedicinePrice=0;
        $syncData=[];
        foreach ($data['medicines'] as $item) {

            $medicine=Medicine::findOrFail($item['medicine_id']);
            $quantity=$item['quantity'];

            //update stock
            $medicineStock=$medicine->stock;

            if ($medicineStock<=0) {
                throw new OutOfStockException("Medicine '{$medicine->name}' is out of stock.");
            }
            $stockLeft=$medicineStock-$quantity;
            $medicine->update(['stock'=>$stockLeft]);
            //add to total price
            $total=$medicine->price *$quantity;
            $totalMedicinePrice+=$total;
            $syncData[$medicine->id]=['quantity'=>$quantity];

            $medicalRecord->update(['total_medicine_price'=>$totalMedicinePrice]);

        }
        $medicalRecord->medicines()->sync($syncData);

        $medicalRecord->load('medicines');
        return $medicalRecord;
    }

    public function getById(MedicalRecord $medicalRecord){
        return $medicalRecord->load('medicines');
    }

    public function updateMedicalRecord($data,MedicalRecord $medicalRecord){

        //store old medicine quantity
       foreach ($medicalRecord->medicines as $oldMedicine) {
        $oldQuantity=$oldMedicine->pivot->quantity;
        $oldMedicine->update(['stock'=>$oldMedicine->stock+$oldQuantity]);
       }

       $totalPrice=0;
       $syncData=[];


       //update medical record
       $medicalRecord->update($data);

       //Apply new medicine quantities
       foreach ($data['medicines'] as $item) {
            $medicine=Medicine::findOrFail($item['medicine_id']);
            $quantity=$item['quantity'];

            //reduce stock
            $medicineStock=$medicine->stock;
            if ($medicineStock<=0) {
               throw new OutOfStockException("Medicine '{$medicine->name}' is out of stock.");
            }
            $stockLeft=$medicineStock-$quantity;
            $medicine->decrement('stock',$quantity);

            //add to total price
            $total=$medicine->price *$quantity;
            $totalPrice+=$total;
            $syncData[$medicine->id]=['quantity'=>$quantity];
       }

       $medicalRecord->update(['total_medicine_price'=>$totalPrice]);

       $medicalRecord->medicines()->sync($syncData);

       $medicalRecord->load('medicines');
       return $medicalRecord;

    }

    public function deleteById(MedicalRecord $medicalRecord){
        $medicalRecord=$medicalRecord->delete();
        return $medicalRecord;
    }
}
