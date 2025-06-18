<?php

namespace App\Repositories\RecordType;

use App\Models\RecordType;

class RecordTypeRepository{

    public function allRecordTypes(){
        return RecordType::all();
    }

    public function createRecordType($data){
        return RecordType::create($data);
    }

    public function getById(RecordType $recordType){
        return $recordType;
    }

    public function updateRecordType($data,RecordType $recordType){
        $recordType->update($data);
        return $recordType;
    }

    public function deleteById(RecordType $recordType){
        $recordType->delete();
        return $recordType;
    }

}
