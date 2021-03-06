<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use App\Mail\AccountCreated;
use App\Models\Activation;
use App\Models\District;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CustomerRegisterController extends Controller
{
    protected $active;

    public function __construct(Activation $active)
    {
        $this->active = $active;
        $address = District::where('matp', 01)->get();
        view()->share(compact('address'));
    }

    public function getRegister()
    {
        return view('customer.register');
    }

    public function postRegister(Request $request)
    {
        $data = $request->all();
        $rules = [
            'email' => 'required|email|unique:customer',
            'password' => 'required',
            'name' => 'required',
            'phone' => 'required'
        ];
        $messages = [
            'name.required' => "Không được để trống",
            'email.required' => "Không được để trống",
            'phone.required' => "Không được để trống",
            'password.required' => "Không được để trống"
        ];
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->with("error", $validator->errors())->withInput();
        }
        $data['password'] = bcrypt($data['password']);
        $user = Customer::create($data);
        $user->type = 'customer';
        $activation = $this->active->createToken($user);
        Mail::to($user->email)->send(new AccountCreated($user, $activation));
        return redirect()->route('customer.login');

    }

    public function activeAccount($id, $token)
    {
        $check = $this->active->where('user_id', $id)
            ->where('token', $token)
            ->first();
        if ($check) {
            $user = Customer::find($id);
            $user->is_active = 1;
            $user->save();
            return redirect()->route('customer.index');
        }
    }
}
