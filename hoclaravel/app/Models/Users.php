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
           $lists = DB::table('users')
           ->select('users.*', 'groups.name as group name')
            ->rightJoin('groups', 'users.group_id','=', 'groups.id')
            ->get();
        $sql =  DB::getQueryLog();
        dd($lists);
        // dd($sql);
        //GET once iem 
        $detail = DB::table($this->users)->first();
        dd($detail);
    }
}
