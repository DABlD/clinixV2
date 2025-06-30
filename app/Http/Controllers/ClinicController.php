<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\{User, Doctor};
use DB;

use App\Helpers\Helper;

class ClinicController extends Controller
{
    public function __construct(){
        $this->table = "clinics";
    }

    public function get(Request $req){
        $array = Clinic::select($req->select);

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
        // SAVE CLINIC
        $clinic = new Clinic();

        $clinic->name = $req->clinicData['name'];
        $clinic->location = $req->clinicData['location'];
        $clinic->region = $req->clinicData['region'];
        $clinic->contact = $req->clinicData['contact'];
        $clinic->pf = $req->clinicData['pf'];
        $clinic->save();

        Helper::log(1, 'created clinic', $clinic->id);

        // SAVE USER
        $user = new user();

        $user->fname = $req->userData['fname'];
        $user->mname = $req->userData['mname'];
        $user->lname = $req->userData['lname'];
        $user->suffix = $req->userData['suffix'];
        $user->contact = $req->userData['contact'];
        $user->email = $req->userData['email'];
        $user->role = $req->userDate['role'] ?? "Admin";
        $user->tnc_agreement = now();

        $user->clinic_id = $clinic->id;
        $user->username = $req->userData['username'];
        $user->password = $req->userData['password'];
        $user->save();

        Helper::log(1, 'new register', $user->id);

        $clinic->user_id = $user->id;
        $clinic->save();

        echo $clinic->id;
    }

    public function update(Request $req){
        $result = DB::table($this->table)->where('id', $req->id)->update($req->except(['id', '_token']));

        echo Helper::log(auth()->user()->id, 'updated clinic', $req->id);
    }

    public function index(){
        return $this->_view('index', [
            'title' => ucfirst($this->table)
        ]);
    }

    private function _view($view, $data = array()){
        return view("$this->table.$view", $data);
    }
}