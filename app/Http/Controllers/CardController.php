<?php

namespace App\Http\Controllers;

use App\Card;
use Validator;
use App\Device;
use App\Department;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CardController extends Controller
{
    /**
     * validation fields on form
     */
    protected function validator(Request $request)
    {
        $fields = [
            'inventory' => ['required', 'string', 'min:3', 'max:50',
                Rule::unique('cards')->ignore($request->id),
            ],            
            'model' => ['required', 'string', 'min:3'],
        ];
        
        return Validator::make($request->all(), $fields)->validate();
    }
    
    /**
     * show list card devices in admin panel
     */
    public function list()
    {
        $countPerPage = (int)env('COUNT_PER_PAGE');

        switch (auth()->user()->role) {
            case 'admin':
                $devices = Card::with('department', 'device')
                    ->sortable()->paginate($countPerPage);
                break;
            case 'manager':
                $devices = Card::with('department', 'device', 'user')
                    ->where('user_id', auth()->user()->id)
                    ->sortable()->paginate($countPerPage);
                break;
        }
        
        return view('list.cards', ['devices' => $devices]);
    }
    
    /**
     * show form for create or edit card device
     */
    public function showForm($id = '')
    {
        $devices = Device::get();
        $departments = Department::get();
        $status = ['Рабочее', 'Не рабочее', 'В ремонте'];

        if ($id) {
            $device = DB::table('cards')
                ->select('cards.*', 'departments.*', 'devices.*', 'departments.id as department_id', 'devices.id as device_id')
                ->rightjoin('departments', 'departments.id', '=', 'cards.department_id')
                ->rightjoin('devices', 'devices.id', '=', 'cards.device_id')
                ->where('cards.id', $id)->first();

            return view('form.card', ['device' => $device, 'devices' => $devices, 'departments' => $departments, 'id' => $id, 'status' => $status]);
        }

        return view('form.card', ['devices' => $devices, 'departments' => $departments, 'status' => $status]);
    }

    /**
     * create card device in DB
     */
    public function create(Request $request)
    {
        $this->validator($request);        
       
        if ($request->file('photo')) {
            $pathImage = $this->saveImage($request->file('photo'));
        } else {
            $pathImage = $request->file('photo');
        }

        Card::create([
            'inventory' => $request->inventory,
            'model' => $request->model,
            'device_id' => $request->device,
            'department_id' => $request->department,
            'user_id' => auth()->user()->id,
            'characteristic' => $request->characteristic,
            'condition' => $request->condition,
            'movement' => $request->movement,
            'comment' => $request->comment,
            'photo' => $pathImage,
        ]);
        
        return redirect(route('card'));
    }

    /**
     * update card device in DB
     */
    public function update(Request $request, $id)
    {
        $this->validator($request);
        
        if ($request->file('photo')) {
            $pathImage = $this->saveImage($request->file('photo'));
        } else {
            $device = Card::where('id', $id)->first();
            $pathImage = $device->photo;
        }

        Card::where('id', $id)
            ->update([
                'inventory' => $request->inventory,
                'model' => $request->model,
                'device_id' => $request->device,
                'department_id' => $request->department,
                'characteristic' => $request->characteristic,
                'condition' => $request->condition,
                'movement' => $request->movement,
                'comment' => $request->comment,
                'photo' => $pathImage,
        ]);

        return redirect(route('card'));
    }

    /**
     * delete card device in DB
     */
    public function delete($id)
    {
        Card::find($id)->delete();
        return redirect(route('card'));
    }

    /**
     * save image and return path
     */
    public function saveImage($image)
    {
        // Storage::putFileAs(public_path('images/device'), $image, $image->getClientOriginalName());
        // Image::configure(array('driver' => 'imagick'));

        Image::make($image)
            ->resize(750, null, function ($constraint) { $constraint->aspectRatio(); })
            ->save(public_path('images/device/' . $image->getClientOriginalName()));

        return '/images/device/' . $image->getClientOriginalName();
    }
}
