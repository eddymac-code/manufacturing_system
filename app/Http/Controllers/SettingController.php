<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'branch']);
    }
    
    public function index()
    {
        $data = Setting::all();

        return view('setting.data', [
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {   
        // dd($request);
        Setting::where('setting_key', 'company_name')->update(['setting_value' => $request->company_name]);
        Setting::where('setting_key', 'company_country')->update(['setting_value' => $request->company_country]);
        Setting::where('setting_key', 'company_address')->update(['setting_value' => $request->company_address]);
        Setting::where('setting_key', 'company_city')->update(['setting_value' => $request->company_city]);
        Setting::where('setting_key', 'company_zip')->update(['setting_value' => $request->company_zip]);
        Setting::where('setting_key', 'company_email')->update(['setting_value' => $request->company_email]);
        Setting::where('setting_key', 'company_website')->update(['setting_value' => $request->company_website]);
        Setting::where('setting_key', 'company_pin')->update(['setting_value' => $request->company_pin]);
        Setting::where('setting_key', 'company_currency')->update(['setting_value' => $request->company_currency]);
        Setting::where('setting_key', 'currency_symbol')->update(['setting_value' => $request->currency_symbol]);
        Setting::where('setting_key', 'currency_position')->update(['setting_value' => $request->currency_position]);

        if ($request->hasFile('company_logo')) {
            $destination_path = 'public/images';
            $photo = $request->file('company_logo');
            $photo_name = $photo->getClientOriginalName();
            $request->file('company_logo')->storeAs($destination_path, $photo_name);

            Setting::where('setting_key', 'company_logo')->update(['setting_value' => $photo_name]);
        }

        return redirect()->back()->with('success', 'Settings Updated Successfully!');
    }
}
