<?php

namespace App\Http\Controllers;

use Validator;
use App\Device;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class DeviceController extends Controller
{
    /**
     * validation fields on form
     */
    protected function validator(Request $request)
    {
        $fields = [
            'device' => ['required', 'string', 'min:3', 'max:50',
                Rule::unique('devices')->ignore($request->id),
            ],            
        ];
        
        return Validator::make($request->all(), $fields)->validate();
    }
    
    /**
     * show list devices in admin panel
     */
    public function list()
    {
        $devices = Device::all();

        return view('admin.device-list', ['devices' => $devices]);
    }

    /**
     * show form for create or edit device
     */
    public function show($id = '')
    {
        if ($id) {
            $device = Device::find($id);
            return view('form.device', ['device' => $device, 'id' => $id]);
        }
        return view('form.device');
    }

    /**
     * create device in DB
     */
    public function create(Request $request)
    {
        $this->validator($request);

        Device::create([
            'device' => $request->device,
        ]);

        return redirect(route('device'));
    }

    /**
     * update device in DB
     */
    public function update(Request $request, $id)
    {
        $this->validator($request);

        Device::where('id', $id)
            ->update([
            'device' => $request->device,
        ]);
        
        return redirect(route('device'));
    }

    /**
     * delete device in DB
     */
    public function delete($id)
    {
        Device::find($id)->delete();
        return redirect(route('device'));
    }
}
