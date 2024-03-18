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
        $list = DB::table($this->users)
            ->select('email', 'fullname')
            // ->where('id', 6)
            // ->where('id', '<>', 5)
            // ->where('id', '<', 5)
            //  ->where('id', '>=', 4)
            //  ->where('id', '<=', 6)
           ->where('id', 6)
           ->where('fullname', 'Y Âm hii hii')
            ->get();
        dd($list);
        //GET once iem 
        $detail = DB::table($this->users)->first();
        dd($detail);
    }
}
