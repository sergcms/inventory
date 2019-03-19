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
            $device = DB::table('cards')
                ->select('cards.*', 'departments.*', 'devices.*', 'departments.id as department_id', 'devices.id as device_id')
                ->leftjoin('departments', 'departments.id', '=', 'cards.department_id')
                ->leftjoin('devices', 'devices.id', '=', 'cards.device_id')
                ->where('cards.inventory', $request->inventory)->first();
        } else {
            $device = DB::table('cards')
                ->select('cards.*', 'departments.*', 'devices.*', 'departments.id as department_id', 'devices.id as device_id')
                ->leftjoin('departments', 'departments.id', '=', 'cards.department_id')
                ->leftjoin('devices', 'devices.id', '=', 'cards.device_id')
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
        if ($request->isdevice) {
            $list = DB::table('cards')
                ->select('cards.*', 'departments.*', 'devices.*', 'departments.id as department_id', 'devices.id as device_id', 'cards.id as cards_id')
                ->leftjoin('departments', 'departments.id', '=', 'cards.department_id')
                ->leftjoin('devices', 'devices.id', '=', 'cards.device_id')
                ->where('devices.id', $request->search)
                ->orderBy('cards_id')->get();

                $name = Device::where('devices.id', $request->search)->first()->device;
        } else {
            // $list = DB::table('cards')
            //     ->select('cards.*', 'departments.*', 'devices.*', 'departments.id as department_id', 'devices.id as device_id', 'cards.id as cards_id')
            //     ->leftjoin('departments', 'departments.id', '=', 'cards.department_id')
            //     ->leftjoin('devices', 'devices.id', '=', 'cards.device_id')
            //     ->where('departments.id', $request->search)
            //     ->orderBy('cards_id')->get();

            $list = Card::with('department', 'device')->where('department_id', $request->search)->sortable()->paginate(15);

            $name = Department::where('departments.id', $request->search)->first()->department;
        }

        $count = 0;

        foreach ($list as $item) {
            $count++;    
        }
        
        return view('report.devices', ['devices' => $list, 'name' => $name, 'count' => $count, 'isdevice' => $request->isdevice]);
    }
}
