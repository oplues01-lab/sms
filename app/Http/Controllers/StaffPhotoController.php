<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffPhotoController extends Controller
{
    public function create(Staff $staff)
    {
        return view('staff.photo_capture', compact('staff'));
    }

    public function store(Request $request, Staff $staff)
    {
        $request->validate([
            'photo' => 'required'
        ]);

        // Camera capture (base64)
        if (str_starts_with($request->photo, 'data:image')) {
            $image = $request->photo;
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);

            $fileName = 'staff_'.$staff->id.'.png';
            Storage::disk('public')->put('staff/'.$fileName, base64_decode($image));
        }
        // Uploaded file
        else {
            $fileName = 'staff_'.$staff->id.'.jpg';
            $request->file('photo')->storeAs('staff', $fileName, 'public');
        }

        $staff->update(['photo' => $fileName]);

        return redirect()
            ->route('staff.show', $staff->id)
            ->with('success', 'Staff photo saved successfully');
    }
}
