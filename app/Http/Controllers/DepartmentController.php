<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DepartmentController extends Controller
{
   /**
     * validation fields on form
     */
    protected function validator(Request $request)
    {
        $fields = [
            'department' => ['required', 'string', 'min:3', 'max:50',
                Rule::unique('departments')->ignore($request->id),
            ], 
        ];
        
        return Validator::make($request->all(), $fields)->validate();
    }
    
    /**
     * show list departments in admin panel
     */
    public function list()
    {
        $countPerPage = (int)env('COUNT_PER_PAGE');

        switch (auth()->user()->role) {
            case 'admin':
                $departments = Department::with('user')->sortable()->paginate($countPerPage);
                break;
            case 'manager':
                // $departments = User::find(auth()->user()->id)->departments;
                $departments = Department::where('user_id', auth()->user()->id)->sortable()->paginate($countPerPage);
                break;
        }
        
        return view('list.departments', ['departments' => $departments,]);
    }
       
    /**
     * show form for create or edit department
     */
    public function showForm($id = '')
    {
        if ($id) {
            $department = Department::find($id);
            $users = User::get();

            return view('form.department', ['department' => $department, 'id' => $id, 'users' => $users]);
        }

        return view('form.department');
    }

    /**
     * create department in DB
     */
    public function create(Request $request)
    {
        $this->validator($request);

        Department::create([
            'department' => $request->department,
            'address' => $request->address,
            'user_id' => auth()->user()->id,
        ]);
        
        return redirect(route('department'));
    }

    /**
     * update department in DB
     */
    public function update(Request $request, $id)
    {       
        $this->validator($request);

        if ($request->user) {
            Department::where('id', $id)
                ->update([
                'department' => $request->department,
                'address' => $request->address,
                'user_id' => $request->user,
            ]);
        } else {
            Department::where('id', $id)
                ->update([
                'department' => $request->department,
                'address' => $request->address,
            ]);
        }

        return redirect(route('department'));
    }

    /**
     * delete department in DB
     */
    public function delete($id)
    {
        Department::find($id)->delete();

        return redirect(route('department'));
    }
}
