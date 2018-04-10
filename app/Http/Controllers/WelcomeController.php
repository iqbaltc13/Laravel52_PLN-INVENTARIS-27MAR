<?php namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Area;
use App\Models\Ruang;
use Input;
use Request;
use DB;
use View;
use Redirect;
use Validator;
use Mail;
use File;
use Storage;
use Alert;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function del()
    {
        /*File::delete('D:\xampp\htdocs\inventarisasi\storage\framework\sessions/42acc0ca08d7d26a2ebdd8518b4d930c9366c6a3');*/

        $files = Storage::files('local');
        var_dump($files);
        //foreach($files as $a);

    }

	public function index()
	{
		return view('awal');
	}


public function forgot(){

    if(Request::isMethod('post'))
        {

             $data = Input::all();
             $id=DB::table('users')->where('email','=',$data['email'])->get();
             if($id==NULL)
             {
                  alert()->error('email yang anda masukkan salah');
    
                //echo "yes";
                return Redirect::back()->with('message', 'Jangan ada yang kosong atau ketik ulang password dan password tidak sama');
             }
             else{
             $a=bcrypt($data['email']);
             $b=$data['email'];
             $sql="call sent_remember_token('$a','$b')";
             DB::connection()->getPdo()->exec($sql);
             DB::commit();


             $data2 = array('token'=>$a);
      Mail::send('mail', $data2, function($message) use ($b) {
         $message->to($b, 'Admin@inventarisPLN')->subject
            ('Token Ubah Password');
         $message->from('xyz@gmail.com','admin Inventaris PLN');
      });

      $stro='Silahkan Cek '.$b;
            alert()->basic($stro, 'Pesan baru telah dikirim')
    ->persistent('Close');
              return view('token');

             }
             
             
         } 
        
    }
	public function token(){

	if(Request::isMethod('post'))
        {

             $data = Input::all();
             $id=DB::table('users')->where('remember_token','=',$data['token'])->get();
             if($id==NULL)
             {
				   alert()->error('token yang anda masukkan salah');
             	//echo "yes";
             	return Redirect::back()->with('message', 'Jangan ada yang kosong atau ketik ulang password dan password tidak sama');
             }
             else{
             
             

              return view('auth.reset',['x'=>$id[0]->id]);

             }
             
             
         } 
		
	}

	public function ubahpassword()
   {
       
       if(Request::isMethod('post'))
        {

             $data = Input::all();
             $id=DB::table('users')->where('id','=',$data['id'])->get();
             
             $rules = array(
            'password2'=>'required|same:password3',        
            'password3'=>'required|same:password2',);
             $validation = Validator::make(Input::all(), $rules);
             if ($validation->fails())
             {
				 alert()->error('jangan ada yang kosong, password dan ketik ulang password harus sama');
             //return redirect()->route('/editakun/', [$id[0]->id]);
            return Redirect::back()->with('message', 'Jangan ada yang kosong atau ketik ulang password dan password tidak sama');
             }
             else{
             $data = Input::all();
             $password=bcrypt($data['password2']);
             
             $x=$id[0]->id;
             $sql="call chgpassword('$password','$x')";
             DB::connection()->getPdo()->exec($sql);
             DB::commit();
			  alert()->success('berhasil mengubah password, silahkan login');
             //return redirect()->route('/detailakun/', [$id[0]->id]);
             return Redirect::to('auth/login');
             //return Redirect::route('detailakun', array($x));
             }
         } 
   }

}
