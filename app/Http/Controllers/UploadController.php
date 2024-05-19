<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class UploadController extends Controller
{

    public function index()
    {
        $data = File::select('id', 'name', 'photo')->get();

        return view('welcome', compact('data'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'photo' => 'required|mimes:png,jpg,jpeg,pdf|max:2000'
        ]);

        $ext = $request->file('photo')->extension();
        if (!in_array($ext, ['pdf', 'png', 'jpeg', 'jpg']))
            return redirect('/')
                ->withErrors('Format file tidak diperbolehkan.');

        //TODO: Saved to storage
        $file     = $request->file('photo');
        $fileName = time() . "." . $file->extension();
        $request->file('photo')->storeAs('file/', $fileName, 'sftp', 'public');

        File::create([
            'name' => $request->name,
            'photo' => $fileName
        ]);

        return redirect('/')
            ->withSuccess('Format file tidak diperbolehkan.');
    }
}
