<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User};
use DB;
use Image;

use App\Helpers\Helper;

class SOAPController extends Controller
{   
    public function __construct(){
        $this->table = "soaps";
    }

    public function get(Request $req){
        $array = SOAP::select($req->select);

        // IF HAS SORT PARAMETER $ORDER
        if($req->order){
            $array = $array->orderBy($req->order[0], $req->order[1]);
        }

        // IF HAS WHERE
        if($req->where){
            $array = $array->where($req->where[0], isset($req->where[2]) ? $req->where[1] : "=", $req->where[2] ?? $req->where[1]);
        }

        // IF HAS WHERE2
        if($req->where2){
            $array = $array->where($req->where2[0], isset($req->where2[2]) ? $req->where2[1] : "=", $req->where2[2] ?? $req->where2[1]);
        }

        // IF HAS JOIN
        if($req->join){
            $alias = substr($req->join, 1);
            $array = $array->join("$req->join as $alias", "$alias.fid", '=', "$this->table.id");
        }

        $array = $array->get();

        // IF HAS LOAD
        if($array->count() && $req->load){
            foreach($req->load as $table){
                $array->load($table);
            }
        }

        // IF HAS GROUP
        if($req->group){
            $array = $array->groupBy($req->group);
        }

        echo json_encode($array);
    }

    public function store(Request $req){
        $soap = new SOAP();

        $user = User::find($req->uid);
        $pid = $user->patient->patient_id;

        $soap->clinic_id = $user->clinic_id;
        $soap->user_id = $user->id;
        $soap->patient_id = $pid;

        //Soap
        $soap->s_type_of_visit = $req->soapS->s_type_of_visit;
        $soap->s_chief_complaint = $req->soapS->s_chief_complaint;
        $soap->s_history_of_present_illness = $req->soapS->s_history_of_present_illness;

        // sOap
        $soap->o_systolic = $req->soapO->o_systolic;
        $soap->o_diastolic = $req->soapO->o_diastolic;
        $soap->o_pulse = $req->soapO->o_pulse;
        $soap->o_pulse_type = $req->soapO->o_pulse_type;
        $soap->o_temperature = $req->soapO->o_temperature;
        $soap->o_temperature_unit = $req->soapO->o_temperature_unit;
        $soap->o_temperature_location = $req->soapO->o_temperature_location;
        $soap->o_respiration_rate = $req->soapO->o_respiration_rate;
        $soap->o_respiration_type = $req->soapO->o_respiration_type;
        $soap->o_weight = $req->soapO->o_weight;
        $soap->o_weight_unit = $req->soapO->o_weight_unit;
        $soap->o_height = $req->soapO->o_height;
        $soap->o_height_unit = $req->soapO->o_height_unit;
        $soap->o_o2_sat = $req->soapO->o_o2_sat;
        // $soap->o_drawing = $req->soapO->o_drawing;
        $soap->o_physical_examination = $req->soapO->o_physical_examination;

        // soAp
        // $soap->a_previous_diagnosis = $req->a_previous_diagnosis;
        $soap->a_diagnosis = $req->soapA->a_diagnosis;

        // soaP
        // $soap->p_laboratory_requests = $req->soapP->p_laboratory_requests;
        // $soap->p_imaging_requests = $req->soapP->p_imaging_requests;
        $soap->p_diagnosis_care_plan = $req->soapP->p_diagnosis_care_plan;
        // $soap->p_previous_medication = $req->soapP->p_previous_medication;
        $soap->p_therapeutic_care_plan = $req->soapP->p_therapeutic_care_plan;
        $soap->p_doctors_note = $req->soapP->p_doctors_note;
        // $soap->p_files = $req->files;

        if($req->soapO->o_drawing){
            $cname = auth()->user()->clinic->name;
            $folder = $user->lname . ', ' . $user->fname . " ($pid)";
            $path = public_path("uploads\\$cname\\Patients\\$folder\\");
            
            if (!is_dir($path)) {
                mkdir($path, 0775, true);
            }

            $extensions = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/gif' => 'gif',
                'image/webp' => 'webp',
                'image/bmp' => 'bmp',
            ];

            $imageData = str_replace('data:image/png;base64,', '', $req->soapO->o_drawing);
            $imageData = str_replace(' ', '+', $req->soapO->o_drawing);

            $image = Image::make($base64_decode($imageData));

            $name = 'SOAP Drawing-' . time() . "." . $extensions[$image->mime()];

            $image->save($path . $name);
            $soap->o_drawing = "uploads\\$cname\\Patients\\$folder\\" . $name;
        }

        if($req->hasFile('files')){
            $cname = $user->clinic->name;
            $folder = $user->lname . ', ' . $user->fname . " ($pid)";
            $path = public_path("uploads\\$cname\\Patients\\$folder\\");
            
            if (!is_dir($path)) {
                mkdir($path, 0775, true);
            }

            $extensions = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/gif' => 'gif',
                'image/webp' => 'webp',
                'image/bmp' => 'bmp',
            ];  

            $files = [];

            foreach($req->file('files') as $key => $file){
                $image = Image::make($file);
                $ctr = $key+1;

                $name = "SOAP File$ctr -" . time() . "." . $extensions[$image->mime()];

                $image->save($path . $name);
                array_push($files, "uploads\\$cname\\Patients\\$folder\\" . $name);
            }

            $soap->p_files = json_encode($files);
        }

        $soap->save();

        Helper::log(auth()->user()->id, "stored a SOAP. PID #$pid", $user->id);

        echo "success";
    }

    public function update(Request $req){
        if(isset($req->imageData) && $req->imageData != "null" && $req->imageData != null){
            $patient = Patient::where('id', $req->id)->first();
            $user = User::where('id', $patient->user_id)->first();

            $pid = $patient->patient_id;

            $cname = auth()->user()->clinic->name;
            $folder = $user->lname . ', ' . $user->fname . " ($pid)";
            $path = public_path("uploads\\$cname\\Patients\\$folder\\");
            
            if (!is_dir($path)) {
                mkdir($path, 0775, true);
            }

            $extensions = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/gif' => 'gif',
                'image/webp' => 'webp',
                'image/bmp' => 'bmp',
            ];

            $image = Image::make($req->imageData);
            $name = 'Avatar-' . time() . "." . $extensions[$image->mime()];

            $image->save($path . $name);
            $user->avatar = "uploads\\$cname\\Patients\\$folder\\" . $name;
            $user->save();
        }

        $result = Patient::where('id', $req->id)->update($req->except(['id', 'imageData', '_token']));

        echo Helper::log(auth()->user()->id, 'updated patient', $req->id);
    }

    public function delete(Request $req){
        User::find($req->id)->delete();
        Helper::log(auth()->user()->id, 'deleted patient', $req->id);
    }

    public function index(){
        $companies = User::where('role', 'Company')->distinct()->pluck('fname');

        return $this->_view('index', [
            'title' => ucfirst($this->table)
        ]);
    }

    private function _view($view, $data = array()){
        return view("$this->table.$view", $data);
    }
}
