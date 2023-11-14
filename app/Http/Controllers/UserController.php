<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::where('permission', 2)->paginate(12);
        $title_page = 'users';
        $route = route('dashboard.admin.users.register');
        return view('dashboard.users', ['title_page' => $title_page, 'users' => $users, 'route' => $route]);
    }

    public function user_add(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'status' => ['required', 'boolean'],
            'mobile' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }
        $new_user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'permission' => '2',
            'status' => $data['status'],
            'mobile' => $data['mobile'],
        ]);
        $new_user->assignRole('User');
        event(new Registered($user = $new_user));
        toast(__('master.Successfully'), 'success');
        return redirect()->back();
        //return back()->with('success', 'Successfully');
    }

    public function user_delete($id)
    {
        if (!$id) {
            return back()->with('error', 'The Request Failed To Execute');
        }
        $user = User::whereId($id)->first();
        if ($user->getRoleNames()[0] == 'SuperAdmin' or $user->getRoleNames()[0] == 'Admin') {
            return redirect(route('dashboard.index'));
        }
        $user->delete();
        toast(__('master.Successfully'), 'success');
        return redirect()->back();
        //return back()->with('success', 'Successfully');
    }

    public function user_edit($id)
    {
        $user = User::whereId($id)->first();
        if (!$user or $user->getRoleNames()[0] == 'SuperAdmin' or $user->getRoleNames()[0] == 'Admin') {
            return redirect()->back();
        }
        $title_page = 'user_edit';
        $route = route('dashboard.admin.users.update');
        return view('dashboard.users', ['title_page' => $title_page, 'user' => $user, 'route' => $route]);
    }

    public function user_update(Request $request)
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
        if ($user->getRoleNames()[0] == 'SuperAdmin' or $user->getRoleNames()[0] == 'Admin') {
            return redirect(route('dashboard.index'));
        }
        $user->update([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'status' => $data['status'],
            'mobile' => $data['mobile'],
        ]);
        return redirect(route('dashboard.admin.users.index'));
    }

    public function video_watched(Request $request)
    {
        $auth_user = auth()->user();
        $v = $auth_user->video_watched;
        $auth_user->update([
            'video_watched' => $v + 1,
        ]);
        toast(__('master.Successfully'), 'success');
        return redirect()->back();
        //return back()->with('success', 'Successfully');

    }


    public function profile()
    {
        $context = [
            'title_page' => 'profile',
        ];
        return view('dashboard.profile', $context);
    }

    public function store(Request $request)
    {
        $id = auth()->user()->id;
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            // 'email' => [ 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $id],
            'mobile' => ['nullable', 'string', 'min:8'],
            'image' => ['image', 'mimes:jpg,png,jpeg'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }
        $user = User::where('id', $id);
        $user->update([
            'name' => $request->all()['name'],
            // 'email' => $request->all()['email'],
            'mobile' => $request->all()['mobile'],
        ]);
        if ($request->all()['password']) {
            $user->update([
                'password' => Hash::make($request->all()['password']),
            ]);
        }
        $image = $request->file('image');
        if ($image != "") {
            $new_name = 'user_' . $id . '_image.' . $image->getClientOriginalExtension();
            $image->move(public_path('users_assets/'), $new_name);
            $user->update(['image' => 'users_assets/' . $new_name]);
        }
        toast(__('master.Successfully'), 'success');
        return redirect()->back();
        //return back()->with('success', 'Successfully');
    }

    public function steps(Request $request)
    {
        auth()->user()->update([
            'steps' => 'end'
        ]);
        session()->flash('modal-change-lang', true);
        return response()->json('success');
    }
}
//Developed Saed Z. Sinwar