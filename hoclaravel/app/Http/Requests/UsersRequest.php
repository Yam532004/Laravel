<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $uniqueEmail = 'unique:users';
        if(session('id')){
            $id = session ('id');
            $uniqueEmail = 'unique:users,email,'. $id;
        }
  
       
        return[
            'fullname' => 'required|min:5',
            'email' => 'required|email|unique:email|'.$uniqueEmail,
            'group_id' => ['required', 'integer',function ($attribute, $value, $fail){
                if ($value == 0){
                    $fail ('Bat buoc phai chon nhom');
                }
            }],
            'status' => 'required|integer'
        ];
    }
    public function messages(){
        return [
            'fullname.required' => 'Full name is required',
            'fullname.min' => 'Full name is required as least 5 lenght',
            'email.required' => 'Email is required',
            'email.email' => 'Email is type email',
            'email.unnique' => 'Email is already',
            'group_id.required' => 'Nhom khong duoc de trong',
            'group_id.integer' => 'Nhom khong hop le',
            'status.required' => 'Statua khong duoc de trong',
            'status.integer' => 'Statua khong hop le',
        ];
    }
}
