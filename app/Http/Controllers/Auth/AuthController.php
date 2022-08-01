<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
  
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
  
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("/")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('/');
    }


    public function userProfile()
    {
        if(Auth::check()){
            $user = \Auth::user();
            return view('auth.user_profile',compact('user'));
        }
    }


    // update user model
    public function updateUserProfile(Request $request)
    {
        $id = \Auth::id();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $update = User::where('id',$id)->update(['name' => $request['name'], 'email'=> $request['email']]);
        if($update){
          return redirect()->back()->with('success', 'Great! Updated successfully!');
        }
    }


    public function resetPassword()
    {
        $user = \App\Models\User::find(\Auth::user()->id);
        if (\Auth::attempt(['email' => $user->email, 'password' => request('password')])) {
            $new_password = request('new_password');
            $confirm_password = request('confirm_password');
            if ($new_password != $confirm_password) {
                return redirect()->back()->with('error', 'New password and confirmed one  do not match');
            }
            $user->update(['password' => bcrypt($new_password)]);
            return redirect()->back()->with('success', 'Password changed successfully');
        } else {
            return redirect()->back()->with('error', 'Current Password is not valid');
        }
        return redirect()->back()->with('success', 'Password Updated successfully');

    }
}
