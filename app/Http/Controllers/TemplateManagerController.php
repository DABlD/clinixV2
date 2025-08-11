<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{RVU, ICD, Diagnosis};
use App\Models\{Drawing};
use Image;

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

    public function deleteDiagnosis(Request $req){
        Diagnosis::where('id', $req->id)->delete();
        Helper::log(auth()->user()->id, "deletad a Diagnosis", $req->id);
    }

    public function getRVU(){
        echo json_encode(RVU::where('clinic_id', auth()->user()->clinic_id)->get());
    }

    public function storeRVU(Request $req){
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

    public function deleteRVU(Request $req){
        RVU::where('id', $req->id)->delete();
        Helper::log(auth()->user()->id, "deletad a RVU", $req->id);
    }

    public function getICD(){
        echo json_encode(ICD::where('clinic_id', auth()->user()->clinic_id)->get());
    }

    public function storeICD(Request $req){
        $temp = new ICD();
        $temp->clinic_id = auth()->user()->clinic_id;
        $temp->code = $req->code;
        $temp->block = $req->block;
        $temp->description = $req->description;
        $temp->save();

        Helper::log(auth()->user()->id, "added a new ICD", $temp->id);

        echo true;
    }

    public function updateICD(Request $req){
        $temp = new ICD();
        $temp->code = $req->code;
        $temp->block = $req->block;
        $temp->description = $req->description;
        $temp->save();

        Helper::log(auth()->user()->id, "updated an ICD", $temp->id);

        echo true;
    }

    public function deleteICD(Request $req){
        ICD::where('id', $req->id)->delete();
        Helper::log(auth()->user()->id, "deletad a ICD", $req->id);
    }

    public function getDrawing(){
        echo json_encode(Drawing::where('clinic_id', auth()->user()->clinic_id)->get());
    }

    public function storeDrawing(Request $req){
        $drawing = new Drawing();
        
        $clinic = auth()->user()->clinic->name;
        $path = public_path("uploads/$clinic/drawings/");
        
        if (!is_dir($path)) {
            mkdir($path, 0775, true);
        }

        $temp = $req->file('image');
        $image = Image::make($temp);

        $name = $req->name . '-' . time() . "." . $temp->getClientOriginalExtension();

        $image->save($path . $name);
        $drawing->image = "uploads/$clinic/drawings/" . $name;

        $drawing->clinic_id = auth()->user()->clinic_id;
        $drawing->name = $req->name;
        $drawing->specialization = $req->specialization;
        $drawing->save();

        Helper::log(auth()->user()->id, "added a new Drawing", $drawing->id);

        echo true;
    }

    public function updateDrawing(Request $req){
        $temp = new Drawing();
        $temp->name = $req->name;
        $temp->specialization = $req->specialization;
        $temp->image = $req->image;
        $temp->save();

        Helper::log(auth()->user()->id, "updated an Drawing", $temp->id);

        echo true;
    }

    public function deleteDrawing(Request $req){
        Drawing::where('id', $req->id)->delete();
        Helper::log(auth()->user()->id, "deletad a Drawing", $req->id);
    }
}
