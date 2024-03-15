<?php

namespace App\Http\Controllers;

use App\Models\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    //
    private $users;
    public function __construct()
    {
        $this->users = new Users();
    }
    public function index()
    {
        $title = "List user";
        $userList = $this->users->getAllUsers();
        return view('clients.users.users-list', compact('title', 'userList'));
    }

    public function add()
    {
        $title = "Add user";
        return view('clients.users.add', compact('title'));
    }
    public function postAdd(Request $request)
    {
        $request->validate([
            'fullname' => 'required|min:5',
            'email' => 'required|email|unique:users'
        ], [
            'fullname.required' => 'Full name is required',
            'fullname.min' => 'Full name is required as least 5 lenght',
            'email.required' => 'Email is required',
            'email.email' => 'Email is type email',
            'email.unnique' => 'Email is already',


        ]);
        $dataInsert = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];

        $this->users->addUser($dataInsert);
        return redirect()->route('users.index')->with('msg', "Add new User Successful!");
    }

    public function getEdit(Request $request, $id)
    {
        $title = "Update user";
        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail[0])) {
                $request->session()->put('id', $id);
                $userDetail = $userDetail[0];
            } else {
                return redirect()->route('users.index')->with('msg', 'Phan tu khong ton tai');
            }
        } else {
            return redirect()->route('users.index')->with('msg', 'Lien ket khong ton tai');
        }
        return view('clients.users.edit', compact('title', 'userDetail'));
    }

    public function postEdit(Request $request)
    {
        $id = session('id');
        if (empty($id)) {
            return back()->with('Lien ket khong ton tai');
        }
        $request->validate([
            'fullname' => 'required|min:5',
            'email' => 'required|email|unique:users,email' . $id
        ], [
            'fullname.required' => 'Full name is required',
            'fullname.min' => 'Full name is required as least 5 lenght',
            'email.required' => 'Email is required',
            'email.email' => 'Email is type email',
            'email.unnique' => 'Email is already',
        ]);

        $dataUpdate = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];

        $this->users->updateUser($dataUpdate, $id);

        return back()->with('msg', 'Update successful!');
    }
}
