<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{RVU, ICD, Diagnosis};

use App\Helpers\Helper;

class TemplateManagerController extends Controller
{
    public function getDiagnosis(){
        echo json_encode(Diagnosis::where('clinic_id', auth()->user()->clinic_id)->get());
    }

    public function storeDiagnosis(Request $req){
        $temp = new Diagnosis();
        $temp->clinic_id = auth()->user()->clinic_id;
        $temp->name = $req->name;
        $temp->save();

        Helper::log(auth()->user()->id, "added a new Diagnosis", $temp->id);

        echo true;
    }

    public function updateDiagnosis(Request $req){
        $temp = Diagnosis::find($req->id);
        $temp->name = $req->name;
        $temp->save();

        Helper::log(auth()->user()->id, "updated a Diagnosis", $temp->id);

        echo true;
    }

    public function getRVU(){
        echo json_encode(RVU::where('clinic_id', auth()->user()->clinic_id)->get());
    }

    public function storeRVU(){
        $temp = new RVU();
        $temp->clinic_id = auth()->user()->clinic_id;
        $temp->code = $req->code;
        $temp->block = $req->block;
        $temp->description = $req->description;
        $temp->save();

        Helper::log(auth()->user()->id, "added a new RVU", $temp->id);

        echo true;
    }

    public function updateRVU(Request $req){
        $temp = new RVU();
        $temp->code = $req->code;
        $temp->block = $req->block;
        $temp->description = $req->description;
        $temp->save();

        Helper::log(auth()->user()->id, "updated an RVU", $temp->id);

        echo true;
    }

    public function getICD(){
        echo json_encode(ICD::where('clinic_id', auth()->user()->clinic_id)->get());
    }

    public function storeICD(){
        $temp = new ICD();
        $temp->clinic_id = auth()->user()->clinic_id;
        $temp->name = $req->name;
        $temp->code = $req->code;
        $temp->save();

        Helper::log(auth()->user()->id, "added a new ICD", $temp->id);

        echo true;
    }

    public function updateICD(Request $req){
        $temp = new ICD();
        $temp->name = $req->name;
        $temp->code = $req->code;
        $temp->save();

        Helper::log(auth()->user()->id, "updated an ICD", $temp->id);

        echo true;
    }
}
