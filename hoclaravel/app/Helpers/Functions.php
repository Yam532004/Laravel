<?php 
use App\Models\Groups;

function isUpperCase($value, $message,  $fail){
    if($value !== mb_strtoupper($value, 'UTF-8')){
        $fail($message);
    }
}

function getAllGroup (){
    $groups = new Groups;
    return $groups->getAll();
}
