<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * validation fields on form
     */
    protected function validator(Request $request)
    {
        $fields = [
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'email' => ['required', 'string', 'min:5',
                Rule::unique('users')->ignore($request->id),
            ],
            // 'password' => ['required', 'string', 'min:6'],             
        ];
        
        return Validator::make($request->all(), $fields)->validate();
    }

    /**
     * show list users in admin panel
     */ 
    public function list()
    {
        $countPerPage = (int)env('COUNT_PER_PAGE');
        $users = User::sortable()->paginate($countPerPage);

        return view('admin.users', ['users' => $users]);
    }

    /**
     * create user in DB
     */
    public function create(Request $request)
    {
        $this->validator($request); 

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, 
            'isblock' => $request->has('isblock') ? 1 : 0,
        ]);

        return redirect(route('user'));
    }

    /**
     * show form for create or edit user
     */
    public function showForm($id = '')
    {
        if ($id) {
            $user = User::find($id);
            
            return view('admin.form.user', ['user' => $user, 'id' => $id, 'roles' => ['admin', 'manager', 'user']]);
        }

        return view('admin.form.user', ['roles' => ['admin', 'manager', 'user']]);
    }
      
    /**
     * update user in DB
     */
    public function update(Request $request, $id)
    {
        $this->validator($request); 

        User::where('id', $id)
            ->update([
            'name' => $request->name,
            'email' => $request->email,    
            // 'password' => Hash::make($request->password),
            'role' => $request->role, 
            'isblock' => $request->has('isblock') ? 1 : 0,
        ]);

        return redirect(route('user'));
    }
   
    /**
     * delete user in DB
     */
    public function delete($id)
    {
        User::find($id)->delete();
        
        return redirect(route('user'));
    }
}
