<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Users extends Model
{
    use HasFactory;
    protected $users = 'users';
    public function getAllUsers()
    {
        $users = DB::select('SELECT * FROM users ORDER BY create_at DESC');
        return $users;
    }

    public function addUser($data)
    {
        DB::insert(
            'INSERT INTO users(fullname, email, create_at) values (?, ?, ?)',
            $data
        );
    }

    public function getDetail($id)
    {
        return DB::select('SELECT * FROM ' . $this->users . ' WHERE id = ?', [$id]);
    }


    public function updateUser($data, $id)
    {
        $data[] = $id;
        return DB::update('UPDATE ' . $this->users . ' SET fullname = ?, email = ?, update_at = ? WHERE id = ?', $data);
    }

    public function deleteUser($id)
    {
        return DB::delete('DELETE FROM ' . $this->users . ' WHERE id=?', [$id]);
    }

    public function statementUser($sql)
    {
        return DB::statement($sql);
    }

    public function learnQueryBuider()
    {
        //GET all item
        DB::enableQueryLog();
        // $id = 6;
        // $lists = DB::table($this->users)
        //     ->select('email', 'fullname', 'id', 'update_at', 'create_at')
        //     ->where('id', 6)
        //    ->where(function($query) use ($id){
        //         $query->where('id', '<', $id)->orwhere('id', '>', $id);
        //    })
        // ->where('fullname', 'like', '%bfhefeer%')
        // ->whereBetween('id', [4, 6])
        // ->wherenotBetween('id', [4, 6])
        // ->whereNotIn('id', [4, 6])
        // ->whereNotNull('update_at')
        // ->whereYear('create_at', '2024')
        // ->whereColumn('create_at','<>', 'update_at')

        // ->get();
        //Join bảng 
        // $lists = DB::table('users')
            //    ->select('users.*', 'groups.name as group name')
            //     ->rightJoin('groups', 'users.group_id','=', 'groups.id')
            // ->orderBy('create_at', 'asc')
            // ->orderBy('id', 'desc')
            // ->inRandomOrder()
            // ->select(DB::raw('count(id) as email_count'), 'email', 'fullname')
            // ->groupBy('email')
            // ->groupBy('fullname')

            // ->having('email_count', '>=', 2)
            // ->limit(2)
            // ->offset(2)
            // ->take(2)
            // ->skip(2)
            // ->get();
        // dd($lists);
        // $status = DB::table('users')->insert([
        //     'fullname' =>'PNT',
        //     'email' => 'PNT@gmail.com',
        //     'group_id' => 1,
        //     'create_at' => date('Y-m-d H:i:s')

        // ]);
        // dd($status);
        // $statusId = DB::getPdo()->lastInsertId();

        // $lastId = DB::table('users')->insertGetId([
        //     'fullname' =>'PNT',
        //         'email' => 'PNT@gmail.com',
        //         'group_id' => 1,
        //         'create_at' => date('Y-m-d H:i:s')
        // ]);
        // dd($lastId);

        // $status = DB::table('users')->where('id', 11)
        // ->update([
        //     'fullname' => 'Phan Ngoc Trieu', 
        //     'email' => 'PhanTRieu@gmail.com',
        //     'update_at'=> date('Y-m-d H:i:s')
        // ]) ;
        // $status = DB::table('users')
        // ->where('id', 11)
        // ->delete();

        //Dem so ban ghi 

        $lists = DB::table('users')->where('id', '>=', 6)->get();
        $count = count($lists);

        dd($count);

        $sql =  DB::getQueryLog();
        dd($sql);
        //GET once iem 
        $detail = DB::table($this->users)->first();
        dd($detail);
    }
}
