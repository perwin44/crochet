<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\StripeSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index()
    {
        
        $stripeSetting = StripeSetting::first();
        //$codSetting = CodSetting::first();


        return view('admin.payment-settings.index', compact( 'stripeSetting'));
    }
}
