<?php

namespace App\Http\Controllers;

use Illuminate\Http\{Request, JsonResponse};
use App\Models\{User, Patient, Clinic, Question, Import};
use Exception;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Helpers\Helper;

class ApiController extends Controller
{
    public function patientStore(Request $req){
        $user = new User();

        $clinic = Clinic::where('id', $req->clinic_id ?? 1)->first();

        $user->role = "Patient";
        $user->clinic_id = $clinic->id;
        $user->username = md5(now()->toDateTimeString());
        $user->password = "12345678";
        $user->fname = strtoupper($req->fname);
        $user->mname = strtoupper($req->mname);
        $user->lname = strtoupper($req->lname);
        $user->suffix = strtoupper($req->suffix);
        $user->birthday = $req->birthday;
        $user->gender = $req->gender;
        $user->contact = $req->contact;
        $user->email = $req->email;
        $user->address = $req->address;

        $ctr = Patient::where('created_at', 'like', now()->format('Y-m-d') . '%')->count();
        $pid = "P" . now()->format('ymd') . str_pad($ctr+1, 5, '0', STR_PAD_LEFT);

        if(isset($req->imageData) && $req->imageData != "null" && $req->imageData != null){
            $cname = $clinic->name;
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
        }

        $user->save();

        $patient = new Patient();
        $patient->user_id = $user->id;
        $patient->patient_id = $pid;
        $patient->hmo_provider = $req->hmo_provider;
        $patient->hmo_number = $req->hmo_number;
        $patient->employment_status = $req->employment_status;
        $patient->company_name = $req->company_name;
        $patient->company_position = $req->company_position;
        $patient->company_contact = $req->company_contact;
        $patient->sss = $req->sss;
        $patient->tin_number = $req->tin_number;
        $patient->birth_place = $req->birth_place;
        $patient->civil_status = $req->civil_status;
        $patient->nationality = $req->nationality;
        $patient->religion = $req->religion;
        $patient->save();

        $user->username = $patient->patient_id;
        $user->save();

        Helper::log(1, 'Patient Import', $user->id);

        $mhr = new MHR();
        $mhr->user_id = $user->id;
        $mhr->patient_id = $patient->id;

        $temp = array();
        $questions = Question::all();
        foreach($questions as $question){
            array_push($temp, [
                "id" => $question->id,
                "question" => $question->name,
                "type" => $question->type,
                "answer" => null,
                "remark" => null
            ]);
        }
        
        $mhr->qwa = json_encode($temp);
        $mhr->save();

        Helper::log(1, 'Generated MHR', $user->id);

        echo "success";
    }
}
