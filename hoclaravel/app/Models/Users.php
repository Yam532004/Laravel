<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    public function getAllUsers($filters = [], $keyword = null, $sortByArr = null, $perPage = null)
    {
        // $users = DB::select('SELECT * FROM users ORDER BY create_at DESC');
        // DB::enableQueryLog();
        $users = DB::table($this->table)
            ->select('users.*', 'groups.name as group_name')
            ->join('groups', 'users.group_id', '=', 'groups.id');
        $orderBy = 'users.create_at';
        $orderType = 'desc';

        if (!empty($sortByArr) && is_array($sortByArr)) {
            if (!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])) {
                $orderBy = trim($sortByArr['sortBy']);
                $orderType = trim($sortByArr['sortType']);
            }
        }

        $users = $users->orderBy($orderBy, $orderType);

        if (!empty($filters)) {
            $users = $users->where($filters);
        }

        if (!empty($keyword)) {
            $users = $users->where(function ($query) use ($keyword) {
                $query->orwhere('fullname', 'like', '%' . $keyword . '%');
                $query->orwhere('email', 'like', '%' . $keyword . '%');
            });
        }
        // $sql =  DB::getQueryLog();
        // dd($sql);
        // $users= $users->get();
        if (!empty($perPage)) {
            $users = $users->paginate($perPage)->withQueryString();
        } else {
            $users = $users->get();
        }

        return $users;
    }

    public function addUser($data)
    {
        // DB::insert(
        //     'INSERT INTO users(fullname, email, create_at) values (?, ?, ?)',
        //     $data
        // );

        return  DB::table($this->table)->insert($data);
    }

    public function getDetail($id)
    {
        return DB::select('SELECT * FROM ' . $this->table . ' WHERE id = '. $id);
    }


    public function updateUser($data, $id)
    {
        // $data[] = $id;
        // return DB::update('UPDATE ' . $this->users . ' SET fullname = ?, email = ?, update_at = ? WHERE id = ?', $data);
        return DB::table($this->table)->where('id', $id)->update($data);
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

        // $lists = DB::table('users')->where('id', '>=', 6)->get();
        // $count = count($lists);

        // dd($count);
        $lists = DB::table('users')
            // ->selectRaw('email, fullname, count(id) as email_count')
            // ->where(DB::raw('id>6'))
            // ->where('id', '>', 6)
            // ->groupBy('email')
            // ->groupBy('fullname')
            // ->orwhereRaw('id > 6')
            // ->orderByRaw('create_at DESC, update_at ASC')
            // ->groupByRaw('email, fullname')
            // ->havingRaw('count(id) >?', [6])
            // ->where(
            //     'group_id',
            //     '=',
            //     function ($query) {
            //         $query->select('id')
            //             ->from('groups')
            //             ->where('name', '=', 'Addministration');
            //     }
            // )
            // ->select('email', DB::raw('(SELECT count(id) FROM "groups") as group_count'))
            ->selectRaw('email, (SELECT count(id) FROM `groups` as group_count')
            ->get();
        $sql =  DB::getQueryLog();
        // dd($sql);
        dd($lists);

        //GET once iem 
        $detail = DB::table($this->users)->first();
        dd($detail);
    }
}
