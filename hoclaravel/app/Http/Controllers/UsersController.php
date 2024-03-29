<?php

namespace App\Http\Controllers;

use App\Models\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UsersRequest;

class UsersController extends Controller
{
    //
    private $users;
    const _PER_PAGE = 4;
    public function __construct()
    {
        $this->users = new Users();
    }
    public function index(Request $request)
    {
        // $statementUser = $this->users->statementUser('SELECT * FROM users');
        // dd($statementUser);
        $title = "List user";
        // $this->users->learnQueryBuider();
        $filters = [];
        $keyword = null;
        if (!empty($request->status)){
            $status = $request->status;
            // echo $status;
            if($status =='active'){
                $status = 1;
            }else{
                $status = 0;
            }
            $filters []= ['users.status', '=', $status];
        }

        if (!empty($request->group_id)){
            $groupId = $request->group_id;
            $filters []= ['users.group_id', '=', $groupId];
        }

        if (!empty($request->keyword)){
            $keyword = $request->keyword;
        }

        // Xu ly logic sap xep

        $sortBy = $request->input('sort-by');
        $sortType = $request->input('sort-type');
        $allSortType = ['asc', 'desc'];

        if(!empty($sortType) && in_array($sortType, $allSortType)){
            if($sortType == 'desc'){
                $sortType = 'asc';
            }
            else{
                $sortType = 'asc';
            }
        }else{
            $sortType = 'asc';
        }

        $sortArr =[
            'sortBy'=>$sortBy,
            'sortType'=> $sortType
        ];

        $userList = $this->users->getAllUsers($filters, $keyword, $sortArr, self::_PER_PAGE);
        return view('clients.users.users-list', compact('title', 'userList',  'sortType'));
    }

    public function add()
    {
        $title = "Add user";
        $allGroups = getAllGroup();
        return view('clients.users.add', compact('title', 'allGroups'));
    }
    public function postAdd(UsersRequest $request)
    {
        $dataInsert = [
           'fullname' =>  $request->fullname,
           'email' =>  $request->email,
           'group_id' =>  $request->group_id,
           'status' =>  $request->status,
           'create_at' => date('Y-m-d H:i:s')
            
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

         $allGroups = getAllGroup();
        return view('clients.users.edit', compact('title', 'userDetail', 'allGroups'));
    }

    public function postEdit(UsersRequest $request)
    {
       
        if (empty($id)) {
            return back()->with('Lien ket khong ton tai');
        }
        $dataInsert = [
            'fullname' =>  $request->fullname,
            'email' =>  $request->email,
            'group_id' =>  $request->group_id,
            'status' =>  $request->status,
            'update_at' => date('Y-m-d H:i:s')
             
         ];

        $this->users->updateUser($dataInsert, $id);

        return back()->with('msg', 'Update successful!');
    }

    public function delete($id){
        if (!empty($id)){
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail)){
                $deleteUser = $this->users->deleteUser($id);
                if($deleteUser){
                    $msg = 'Delete successfull!';
                }
                else{
                    $msg = "Ban khong the xoa nguoi dung luc nay. Vui long thu lai sau";
                }
            }
            else{
                $msg = "Nguoi dung khong ton tai";
            }
        }
        else{
            $msg = "Lien ket khong ton tai";
        }
        return redirect ()->route('users.index')->with('msg',$msg);
    }
}
