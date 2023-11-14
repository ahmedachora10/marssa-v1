<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register(Request $request)
    {
        $auth_user = auth()->user();
        $store = $auth_user->store()->first();
        $plan = $store->plan()->first();
        if (!$plan) {
            if ($auth_user->getRoleNames()[0] != 'SuperAdmin') {
                return redirect()->back()->with('error', 'package_cannot');
            }
        } else {
            if ($plan->users_count <= count($store->users()->get()))
                return redirect()->back()->with('error', 'package_cannot');
        }
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'status' => ['required', 'boolean'],
            'mobile' => ['required', 'string']
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }

        if ($auth_user->getRoleNames()[0] == 'SuperAdmin') {
            $permission = '1';
            $role = 'Admin';
        } else {
            $permission = '2';
            $role = 'SubUser';
        }
        $store = $auth_user->store()->first();

        $new_user = new User();
        $new_user['name'] = $data['name'];
        $new_user['username'] = $data['username'] ?? $data['email'];
        $new_user['email'] = $data['email'];
        $new_user['password'] = Hash::make($data['password']);
        $new_user['permission'] = $permission;
        $new_user['status'] = $data['status'];
        $new_user['mobile'] = $data['mobile'];
        $new_user->store()->associate($store);

        if(!empty($data['branch_id'])){
            $new_user->branch()->associate($data['branch_id']);
        }

        $new_user->save();
        $new_user->assignRole($role);


        event(new Registered($user = $new_user));
        //return back()->with('success', 'Successfully');
        toast(__('master.Successfully'),'success');
        return back();
    }

    public function admin_edit($id)
    {
        if ($id) {
            $user = User::whereId($id)->first();
            if ($user->getRoleNames()[0] == 'SuperAdmin') {
                return redirect(route('dashboard.index'));
            }
            $route = route('dashboard.admin.administrator.update');
            $context = [
                'title_page' => 'admin_edit',
                'user' => $user,
                'route' => $route
            ];
            return view('dashboard.store_staff', $context);
        }
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'id' => ['required', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $data['id']],
            'email' => ['required', 'string', 'max:255', 'unique:users,email,' . $data['id']],
            'status' => ['required', 'boolean'],
            'mobile' => ['required', 'string']
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }
        $user = User::where('id', $data['id'])->first();
        if ($user->getRoleNames()[0] == 'SuperAdmin') {
            return redirect(route('dashboard.index'));
        }
        $user->update([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'status' => $data['status'],
            'mobile' => $data['mobile'],
        ]);

        if(!empty($data['branch_id'])){
           $user->branch()->associate($data['branch_id'])->save();
        }
        return redirect(route('dashboard.admin.store_settings.store_staff'));
    }

    public function admin_delete($id)
    {
        if (!$id) {
            return back()->with('error', 'The Request Failed To Execute');
        }
        $user = User::whereId($id)->first();
        if ($user->getRoleNames()[0] == 'SuperAdmin') {
            return redirect(route('dashboard.index'));
        }
        $user->delete();
        toast(__('master.Successfully'),'success');
        return back();
        //return back()->with('success', 'Successfully');
    }
}
//Developed Saed Z. Sinwar
