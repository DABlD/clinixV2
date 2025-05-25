<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Auth;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class UserController extends Controller
{
    public function __construct(){
        $this->table = "users";
    }

    public function get(Request $req){
        $array = DB::table($this->table)->select($req->select);

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

        echo $data->save();
    }

    public function update(Request $req){
        echo DB::table($this->table)->where('id', $req->id)->update($req->except(['id', '_token']));
    }

    public function updatePassword(Request $req){
        $user = User::find($req->id);
        $user->password = $req->password;
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
        User::find($req->id)->delete();
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
