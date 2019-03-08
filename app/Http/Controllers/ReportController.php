<?php

namespace App\Http\Controllers;

use App\Device;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * show form report
     */
    public function showForm(Request $request)
    {
        if ($request->getPathInfo() == "/report/department") {
            $isDevice = false;

            $list = Department::get();

        } elseif ($request->getPathInfo() == "/report/device") {
            $isDevice = true;

            $list = Device::get();
        } else {

            return view('form.report', ['list' => $list]);
        }

        return view('form.report', ['list' => $list, 'isdevice' => $isDevice]);
    }

    public function showReport(Request $request)
    {
        if ($request->isdevice) {
            $list = DB::table('cards')
            ->select('cards.*', 'departments.*', 'devices.*', 'departments.id as department_id', 'devices.id as device_id', 'cards.id as cards_id')
            ->leftjoin('departments', 'departments.id', '=', 'cards.department_id')
            ->leftjoin('devices', 'devices.id', '=', 'cards.device_id')
            ->where('devices.id', $request->search)
            ->orderBy('cards_id')->get();


        } else {
            $list = Department::where('id', $request->search)->first();
        }

        $count = 0;

        foreach ($list as $item) {
            $count++;    
        }

        $name = $request->isdevice ? $list[0]->device : $list[0]->department;

        return view('report.devices', ['devices' => $list, 'name' => $name, 'count' => $count, 'isdevice' => $request->isdevice]);
    }
    
}
