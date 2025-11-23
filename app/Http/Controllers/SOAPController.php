<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, SOAP, SOAPBlood, SOAPObgyne, SOAPRefraction};
use DB;
use Image;

use App\Helpers\Helper;

class SoapController extends Controller
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

        $soapS = json_decode($req->soapS);
        $soapO = json_decode($req->soapO);
        $soapA = json_decode($req->soapA);
        $soapP = json_decode($req->soapP);

        $user = User::find($req->uid);
        $pid = $user->patient->patient_id;

        $soap->clinic_id = $user->clinic_id;
        $soap->user_id = $user->id;
        $soap->patient_id = $user->patient->id;

        //Soap
        $soap->s_type_of_visit = $soapS->s_type_of_visit;
        $soap->s_chief_complaint = $soapS->s_chief_complaint;
        $soap->s_history_of_present_illness = $soapS->s_history_of_present_illness;

        // sOap
        $soap->o_systolic = $soapO->o_systolic;
        $soap->o_diastolic = $soapO->o_diastolic;
        $soap->o_pulse = $soapO->o_pulse;
        $soap->o_pulse_type = $soapO->o_pulse_type;
        $soap->o_temperature = $soapO->o_temperature;
        $soap->o_temperature_unit = $soapO->o_temperature_unit;
        $soap->o_temperature_location = $soapO->o_temperature_location;
        $soap->o_respiration_rate = $soapO->o_respiration_rate;
        $soap->o_respiration_type = $soapO->o_respiration_type;
        $soap->o_weight = $soapO->o_weight;
        $soap->o_weight_unit = $soapO->o_weight_unit;
        $soap->o_height = $soapO->o_height;
        $soap->o_height_unit = $soapO->o_height_unit;
        $soap->o_o2_sat = $soapO->o_o2_sat;
        // $soap->o_drawing = $soapO->o_drawing;
        $soap->o_physical_examination = $soapO->o_physical_examination;

        // soAp
        // $soap->a_previous_diagnosis = $req->a_previous_diagnosis;
        $soap->a_diagnosis = $soapA->a_diagnosis;

        // soaP
        // $soap->p_laboratory_requests = $soapP->p_laboratory_requests;
        // $soap->p_imaging_requests = $soapP->p_imaging_requests;
        $soap->p_diagnosis_care_plan = $soapP->p_diagnosis_care_plan;
        // $soap->p_previous_medication = $soapP->p_previous_medication;
        $soap->p_therapeutic_care_plan = $soapP->p_therapeutic_care_plan;
        $soap->p_doctors_note = $soapP->p_doctors_note;
        // $soap->p_files = $req->files;

        $cname = auth()->user()->clinic->name;
        $folder = $user->lname . ', ' . $user->fname . " ($pid)";
        $path = public_path("uploads/$cname/Patients/$folder/");
        if (!is_dir($path)) {
            mkdir($path, 0775, true);
        }

        if($soapO->o_drawing){
            $imageData = str_replace('data:image/png;base64,', '', $soapO->o_drawing);
            $imageData = str_replace(' ', '+', $imageData);

            $image = Image::make(base64_decode($imageData))->encode('png');
            // $image->fill('#ffffff', 0, 0);
            $image2 = Image::canvas($image->width(), $image->height(), '#ffffff');
            $image2->insert($image, 'top-left', 0, 0)->encode('png');

            $name = 'SOAP Drawing-' . time() . ".png";

            $image2->save($path . $name);
            $soap->o_drawing = "uploads/$cname/Patients/$folder/" . $name;
        }

        if($req->hasFile('files')){
            $files = [];

            foreach($req->file('files') as $key => $file){
                $image = Image::make($file);
                $ctr = $key+1;

                $name = "SOAP File$ctr -" . time() . "." . $file->getClientOriginalExtension();

                $image->save($path . $name);
                array_push($files, "uploads/$cname/Patients/$folder/" . $name);
            }

            $soap->p_files = json_encode($files);
        }

        $soap->save();

        Helper::log(auth()->user()->id, "stored a SOAP. PID #$pid", $user->id);

        $soapB = new SOAPBlood();
        $soapB->soap_id = $soap->id;
        $soapB->value = $soapO->glucose->value;
        $soapB->unit = $soapO->glucose->unit;
        $soapB->remarks = $soapO->glucose->remarks;
        $soapB->datetime = $soapO->glucose->datetime;
        $soapB->save();

        $soapOB = new SOAPObgyne();
        $soapOB->soap_id = $soap->id;
        $soapOB->lmp = $soapO->obgyne->lmp;
        $soapOB->edc = $soapO->obgyne->edc;
        $soapOB->edc_source = $soapO->obgyne->edc_source;
        $soapOB->aog = $soapO->obgyne->aog;
        $soapOB->fh = $soapO->obgyne->fh;
        $soapOB->fht = $soapO->obgyne->fht;
        $soapOB->ie = $soapO->obgyne->ie;
        $soapOB->gravida = $soapO->obgyne->gravida != "" ? $soapO->obgyne->gravida : null;
        $soapOB->para = $soapO->obgyne->para != "" ? $soapO->obgyne->para : null;
        $soapOB->term = $soapO->obgyne->term != "" ? $soapO->obgyne->term : null;
        $soapOB->preterm = $soapO->obgyne->preterm != "" ? $soapO->obgyne->preterm : null;
        $soapOB->abortion = $soapO->obgyne->abortion != "" ? $soapO->obgyne->abortion : null;
        $soapOB->living = $soapO->obgyne->living != "" ? $soapO->obgyne->living : null;
        $soapOB->presentation = $soapO->obgyne->presentation;
        $soapOB->remarks = $soapO->obgyne->remarks;
        $soapOB->save();

        $soapR = new SOAPRefraction();
        $soapR->soap_id = $soap->id;
        $soapR->va_sc_od = $soapO->refractions->va_sc_od;
        $soapR->va_sc_os = $soapO->refractions->va_sc_os;
        $soapR->va_ph_od = $soapO->refractions->va_ph_od;
        $soapR->va_ph_os = $soapO->refractions->va_ph_os;
        $soapR->va_cc_od = $soapO->refractions->va_cc_od;
        $soapR->va_cc_os = $soapO->refractions->va_cc_os;
        $soapR->va_spec_od = $soapO->refractions->va_spec_od;
        $soapR->va_spec_od_sp = $soapO->refractions->va_spec_od_sp;
        $soapR->va_spec_od_cy = $soapO->refractions->va_spec_od_cy;
        $soapR->va_spec_od_ax = $soapO->refractions->va_spec_od_ax;
        $soapR->va_spec_os = $soapO->refractions->va_spec_os;
        $soapR->va_spec_os_sp = $soapO->refractions->va_spec_os_sp;
        $soapR->va_spec_os_cy = $soapO->refractions->va_spec_os_cy;
        $soapR->va_spec_os_ax = $soapO->refractions->va_spec_os_ax;
        $soapR->ar_spec_od = $soapO->refractions->ar_spec_od;
        $soapR->ar_spec_od_sp = $soapO->refractions->ar_spec_od_sp;
        $soapR->ar_spec_od_cy = $soapO->refractions->ar_spec_od_cy;
        $soapR->ar_spec_os = $soapO->refractions->ar_spec_os;
        $soapR->ar_spec_os_sp = $soapO->refractions->ar_spec_os_sp;
        $soapR->ar_spec_os_cy = $soapO->refractions->ar_spec_os_cy;
        $soapR->nr_spec_od = $soapO->refractions->nr_spec_od;
        $soapR->nr_spec_od_sp = $soapO->refractions->nr_spec_od_sp;
        $soapR->nr_spec_od_cy = $soapO->refractions->nr_spec_od_cy;
        $soapR->nr_spec_od_ax = $soapO->refractions->nr_spec_od_ax;
        $soapR->nr_spec_od_va = $soapO->refractions->nr_spec_od_va;
        $soapR->nr_spec_od_pd = $soapO->refractions->nr_spec_od_pd;
        $soapR->nr_spec_od_sh = $soapO->refractions->nr_spec_od_sh;
        $soapR->nr_spec_os = $soapO->refractions->nr_spec_os;
        $soapR->nr_spec_os_sp = $soapO->refractions->nr_spec_os_sp;
        $soapR->nr_spec_os_cy = $soapO->refractions->nr_spec_os_cy;
        $soapR->nr_spec_os_ax = $soapO->refractions->nr_spec_os_ax;
        $soapR->nr_spec_os_va = $soapO->refractions->nr_spec_os_va;
        $soapR->nr_spec_os_pd = $soapO->refractions->nr_spec_os_pd;
        $soapR->nr_spec_os_sh = $soapO->refractions->nr_spec_os_sh;
        $soapR->nr_type_of_lens = $soapO->refractions->nr_type_of_lens;
        $soapR->nr_type_of_frame = $soapO->refractions->nr_type_of_frame;
        $soapR->ee_od_straight = $soapO->refractions->ee_od_straight;
        $soapR->ee_od_up = $soapO->refractions->ee_od_up;
        $soapR->ee_od_down = $soapO->refractions->ee_od_down;
        $soapR->ee_od_mrd = $soapO->refractions->ee_od_mrd;
        $soapR->ee_od_lev_fxn = $soapO->refractions->ee_od_lev_fxn;
        $soapR->ee_od_lid_crease = $soapO->refractions->ee_od_lid_crease;
        $soapR->ee_od_lid_lag = $soapO->refractions->ee_od_lid_lag;
        $soapR->ee_os_straight = $soapO->refractions->ee_os_straight;
        $soapR->ee_os_up = $soapO->refractions->ee_os_up;
        $soapR->ee_os_down = $soapO->refractions->ee_os_down;
        $soapR->ee_os_mrd = $soapO->refractions->ee_os_mrd;
        $soapR->ee_os_lev_fxn = $soapO->refractions->ee_os_lev_fxn;
        $soapR->ee_os_lid_crease = $soapO->refractions->ee_os_lid_crease;
        $soapR->ee_os_lid_lag = $soapO->refractions->ee_os_lid_lag;
        $soapR->save();

        echo "success";
    }

    public function update(Request $req){
        if(isset($req->imageData) && $req->imageData != "null" && $req->imageData != null){
            $patient = Patient::where('id', $req->id)->first();
            $user = User::where('id', $patient->user_id)->first();

            $pid = $patient->patient_id;

            $cname = auth()->user()->clinic->name;
            $folder = $user->lname . ', ' . $user->fname . " ($pid)";
            $path = public_path("uploads/$cname/Patients/$folder/");
            
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
            $user->avatar = "uploads/$cname/Patients/$folder/" . $name;
            $user->save();
        }

        $result = Patient::where('id', $req->id)->update($req->except(['id', 'imageData', '_token']));

        echo Helper::log(auth()->user()->id, 'updated patient', $req->id);
    }

    public function delete(Request $req){
        User::find($req->id)->delete();
        Helper::log(auth()->user()->id, 'deleted patient', $req->id);
    }

    public function print(Request $req){
        $soap = SOAP::find($req->id);
        $soap->load('patient.user');

        return $this->_view('patients.printSoap', [
            'title' => "SOAP",
            'soap' => $soap
        ]);
    }

    public function index(Request $req){
        return $this->_view('patients.soap', [
            'title' => ucfirst($this->table),
            'userid' => $req->userid ?? "null"
        ]);
    }

    private function _view($view, $data = array()){
        return view("$view", $data);
    }
}
