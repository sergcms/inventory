<?php

namespace App\Http\Controllers;

use App\Card;
use App\Device;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * show form report device or department
     */
    public function showForm(Request $request)
    {
        $list = [];

        switch ($request->getPathInfo()) {
            case '/report/department':
                $isDevice = false;
                $list = Department::get();
                break;
            case '/report/device':
                $isDevice = true;
                $list = Device::get();
                break;
            case '/report/card':
                return view('form.report-card');
                break;
        }

        return view('form.report', ['list' => $list, 'isdevice' => $isDevice]);
    }

     /**
     * show one card device
     */
    public function report(Request $request, $id = '')
    {
        if (!$id) {
            $device = Card::with('department', 'device')
                        ->where('cards.inventory', $request->inventory)->first();
        } else {
            $device = Card::with('department', 'device')
                ->where('cards.id', $id)->first();
        }
        
        if (empty($device)) {
            abort(404);
        }
       
        return view('report.card', ['device' => $device]);
    }

    /**
     * show report table device or department
     */
    public function showReport(Request $request)
    {
        $countPerPage = (int)env('COUNT_PER_PAGE');

        if ($request->isdevice) {

            switch (auth()->user()->role) {
                case 'admin':
                    $list = Card::with('department', 'device', 'user')
                        ->where('device_id', $request->search)
                        ->sortable()->paginate($countPerPage);
                    break;
                case 'manager':
                    $list = Card::with('department', 'device', 'user')
                        ->where('device_id', $request->search)
                        ->where('user_id', auth()->user()->id)
                        ->sortable()->paginate($countPerPage);
                    break;
            }
            
            $name = Device::where('devices.id', $request->search)->first()->device;
        } else {
            switch (auth()->user()->role) {
                case 'admin':
                    $list = Card::with('department', 'device', 'user')
                        ->where('department_id', $request->search)
                        ->sortable()->paginate($countPerPage);
                    break;
                case 'manager':
                    $list = Card::with('department', 'device', 'user')
                        ->where('department_id', $request->search)
                        ->where('user_id', auth()->user()->id)
                        ->sortable()->paginate($countPerPage);
                    break;
            }

            $name = Department::where('departments.id', $request->search)->first()->department;
        }

        $count = 0;

        foreach ($list as $item) {
            $count++;    
        }
        
        return view('report.devices', ['devices' => $list, 'name' => $name, 'count' => $count, 'isdevice' => $request->isdevice]);
    }
}
