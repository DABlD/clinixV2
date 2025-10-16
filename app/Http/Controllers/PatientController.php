<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Patient, User};
use App\Models\{MHR, Question};
use DB;
use Image;

use App\Helpers\Helper;

class PatientController extends Controller
{
    public function __construct(){
        $this->table = "patients";
    }

    public function get(Request $req){
        $array = Patient::select($req->select ?? "*");
        $tc = 0;

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

        if(isset($req->filters)){
            $search = $req->search;

            $array = $array->join('users as u', 'u.id', '=', "$this->table.user_id");

            // Search filter: case-insensitive match on fname/lname (supports multi-word and reversed order)
            $array = $array->where(function($q) use($search) {
                $parts = preg_split('/\s+/', strtolower(trim($search)));

                if (count($parts) > 1) {
                    // Try both interpretations:
                    // (1) first = first word(s), last = last word
                    // (2) first = first word, last = remaining words
                    $firstPart = $parts[0];
                    $lastPart = end($parts);
                    $middle = implode(' ', array_slice($parts, 1, -1)); // anything in between

                    $q->where(function($q2) use ($firstPart, $middle, $lastPart) {
                        // Build possible full-name combinations (lowercased)
                        $q2->whereRaw("LOWER(CONCAT(u.fname, ' ', u.lname)) LIKE ?", ["%{$firstPart} {$middle} {$lastPart}%"])
                           ->orWhereRaw("LOWER(CONCAT(u.lname, ' ', u.fname)) LIKE ?", ["%{$firstPart} {$middle} {$lastPart}%"]);

                        // Extra fallback: handle multi-word first OR last names
                        $q2->orWhereRaw("LOWER(CONCAT(u.fname, ' ', u.lname)) LIKE ?", ["%{$firstPart} {$lastPart}%"])
                           ->orWhereRaw("LOWER(CONCAT(u.lname, ' ', u.fname)) LIKE ?", ["%{$firstPart} {$lastPart}%"]);
                    });
                } else {
                    // single-word fallback (lname or fname)
                    $q->whereRaw("LOWER(u.fname) LIKE ?", ["%{$search}%"])
                      ->orWhereRaw("LOWER(u.lname) LIKE ?", ["%{$search}%"]);
                }

            });
            
            $tc = $array->count();
            $array = $array->limit($req->limit)->offset($req->offset);
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

        // IF REQUEST IS ON PATIENT RECORD
        if($req->filters){
            $array = ["patients" => $array, "tc" => $tc];
        }

        echo json_encode($array);
    }

    public function store(Request $req){
        $user = new User();

        $user->role = "Patient";
        $user->clinic_id = auth()->user()->clinic_id;
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

        $pid = $req->patient_id;

        if(isset($req->imageData) && $req->imageData != "null" && $req->imageData != null){
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

        Helper::log(auth()->user()->id, 'created patient', $user->id);

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

        Helper::log(auth()->user()->id, 'generated MHR', $user->id);

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
