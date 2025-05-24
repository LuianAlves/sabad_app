<?php

namespace App\Http\Controllers\Business\Device\DeviceControl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeviceControlController extends Controller
{
    public function index() {
        return view('app.business.device.device_control.device_control_index');
    }
}
