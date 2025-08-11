<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use DB;
use Image;

use App\Helpers\Helper;

class DoctorController extends Controller
{
    public function __construct(){
        $this->table = "doctors";
    }

    public function get(Request $req){
        $array = Doctor::select($req->select);

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

    public function getSpecializations(){
        echo json_encode(Doctor::distinct('specialization')->pluck('specialization'));
    }

    public function update(Request $req){
        $id = auth()->user()->clinic->id;

        if($req->hasFile('signature')){
            $doctor = Doctor::find($id);

            $cname = $doctor->user->clinic->name;
            $folder = $doctor->user->lname . ', ' . $doctor->user->fname . ' ' . substr($doctor->user->mname, 0, 1);
            $path = public_path("uploads/$cname/Doctors/$folder/");
            
            if (!is_dir($path)) {
                mkdir($path, 0775, true);
            }

            $temp = $req->file('signature');
            $image = Image::make($temp);

            $name = 'ESIG-' . time() . "." . $temp->getClientOriginalExtension();

            // $image->resize(250, 250);
            $image->save($path . $name);
            $doctor->signature = "uploads/$cname/Doctors/$folder/" . $name;
            $doctor->save();
        }
        else{
            $result = DB::table($this->table)->where('id', $req->id)->update($req->except(['id', '_token']));
        }

        echo Helper::log(auth()->user()->id, 'updated doctor details', $req->id);
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