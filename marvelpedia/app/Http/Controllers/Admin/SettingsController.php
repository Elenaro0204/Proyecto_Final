<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        // Obtener todos los settings
        $settings = Setting::pluck('value','key')->toArray();

        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'logo' => 'nullable|image|max:2048',
            'main_color' => 'nullable|string|max:7',
            'background_image' => 'nullable|image|max:4096',
            'twitter' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
        ]);

        // Guardar archivos si los hay
        if($request->hasFile('logo')){
            $path = $request->file('logo')->store('settings', 'public');
            $data['logo'] = '/storage/'.$path;
        }

        if($request->hasFile('background_image')){
            $path = $request->file('background_image')->store('settings', 'public');
            $data['background_image'] = '/storage/'.$path;
        }

        // Guardar settings en la tabla
        foreach($data as $key => $value){
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('status','Configuración actualizada correctamente');
    }
}
