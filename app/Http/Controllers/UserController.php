<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Clinic};
use App\Models\{Admin, Nurse, Patient, Cashier};
use App\Models\{Imaging, Laboratory, Receptionist};
use DB;
use Auth;
use Image;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use App\Helpers\Helper;

class UserController extends Controller
{
    public function __construct(){
        $this->table = "users";
    }

    public function get(Request $req){
        $array = User::select($req->select);

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
        $data = new User();

        $data->clinic_id = auth()->user()->clinic_id;

        $data->username = $req->username;
        $data->fname = $req->fname;
        $data->mname = $req->mname;
        $data->lname = $req->lname;
        $data->role = $req->role;
        $data->email = $req->email;
        $data->birthday = $req->birthday;
        $data->gender = $req->gender;
        $data->address = $req->address;
        $data->contact = $req->contact;
        $data->password = $req->password;
        $data->save();

        $role = "App\\Models\\$req->role";
        $temp = new $role();
        $temp->user_id = $data->id;
        $temp->tin = $req->tin;
        $temp->sss = $req->sss;
        $temp->philhealth = $req->philhealth;
        $temp->pagibig = $req->pagibig;

        $temp->save();

        Helper::log(auth()->user()->id, "created $data->role user", $data->id);

        echo 1;
    }

    public function update(Request $req){
        if($req->hasFile('avatar')){
            $user = User::find($req->id);

            $clinic = $user->clinic->name;
            $path = public_path("uploads\\$clinic\\avatars\\");
            
            if (!is_dir($path)) {
                mkdir($path, 0775, true);
            }

            $temp = $req->file('avatar');
            $image = Image::make($temp);

            $name = $user->lname . '_' . $user->fname . '-' . time() . "." . $temp->getClientOriginalExtension();

            $image->resize(250, 250);
            $image->save($path . $name);
            $user->avatar = "uploads\\$clinic\\avatars\\" . $name;
            $user->save();
        }
        else{
            $except1 = ['id', '_token', 'avatar', 'sss', 'tin', 'philhealth', 'pagibig'];
            $include = ['sss', 'tin', 'philhealth', 'pagibig'];

            DB::table($this->table)->where('id', $req->id)->update($req->except($except1));

            if(sizeof($req->only($include))){
                DB::table(strtolower($req->role) . 's')->where('user_id', $req->id)->update($req->only($include));
            }
        }

        echo Helper::log(auth()->user()->id, 'updated user', $req->id);
    }

    public function updatePassword(Request $req){
        $user = User::find($req->id);
        $user->password = $req->password;

        Helper::log(auth()->user()->id, 'updated password of user', $req->id);

        $user->save();
    }

    public function forgotPassword(Request $req){
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions
        try {
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'info@onehealthnetwork.com.ph';   //  sender username
            $mail->Password = '1nf0P@55w0rd';       // sender password
            $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
            $mail->Port = 587;                          // port - 587/465

            $mail->setFrom('info@onehealthnetwork.com.ph', 'One Health Network');
            $mail->addAddress($req->email);

            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = "Password Reset";

            $route = route('resetPassword');
            $link = "<a href='$route?email=$req->email'>link</a>";
            $mail->Body    = "Click $link to reset password";

            // $mail->AltBody = plain text version of email body;

            if( !$mail->send() ) {
                echo "Email sending failed";
            }
            
            else {
                echo "Email sent successfully";
            }

        } catch (Exception $e) {
            echo "Error. Email not sent";
        }
    }

    public function resetPassword(Request $req){

        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions
        try {
            $pass = Str::random(8);

            $user = User::where('email', $req->email)->first();
            $user->password = $pass;
            $user->save();

            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'info@onehealthnetwork.com.ph';   //  sender username
            $mail->Password = '1nf0P@55w0rd';       // sender password
            $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
            $mail->Port = 587;                          // port - 587/465

            $mail->setFrom('info@onehealthnetwork.com.ph', 'One Health Network');
            $mail->addAddress($req->email);

            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = "New Password";

            $route = route('resetPassword');
            $mail->Body    = "Your new password is: <b>$pass</b>. <br>Change your password immediately after login.";

            // $mail->AltBody = plain text version of email body;

            if( !$mail->send() ) {
                echo "Email sending failed";
            }
            
            else {
                echo "Email sent successfully";
            }

        } catch (Exception $e) {
            echo "Error. Email not sent";
        }
    }

    public function delete(Request $req){
        echo User::find($req->id)->delete();
        Helper::log(auth()->user()->id, 'deleted user', $req->id);
    }

    public function profile(){
        $user = auth()->user();

        $role = strtolower($user->role);
        $user->load($role);
        $user->tin = $user->{$role}->tin;
        $user->sss = $user->{$role}->sss;
        $user->philhealth = $user->{$role}->philhealth;
        $user->pagibig = $user->{$role}->pagibig;

        $nurse = Nurse::where('doctor_id', auth()->user()->doctor->id)->get();
        $nurse->load('user');

        $settings = Clinic::where('id', $user->clinic_id)->first();

        return $this->_view('profile', [
            'title' => "Profile",
            'data' => $user,
            'nurses' => $nurse,
            'settings' => $settings->toArray()
        ]);
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
