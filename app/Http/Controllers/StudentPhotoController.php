<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentPhotoController extends Controller
{
    /**
     * Show photo upload page
     */
    public function show(Student $student)
    {
        return view('students.photo', compact('student'));
    }

    /**
     * Store uploaded photo
     */
    public function store(Request $request, Student $student)
    {
        $request->validate([
            'photo' => 'required|string',
        ]);

        try {
            // Delete old photo if exists
            if ($student->photo) {
                Storage::disk('public')->delete('students/' . $student->photo);
            }

            // Decode base64 image
            $imageData = $request->photo;
            
            // Remove data:image/png;base64, or data:image/jpeg;base64, prefix
            if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                $imageData = substr($imageData, strpos($imageData, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, gif
            } else {
                return back()->withErrors(['photo' => 'Invalid image format']);
            }

            // Decode base64
            $imageData = base64_decode($imageData);

            if ($imageData === false) {
                return back()->withErrors(['photo' => 'Failed to decode image']);
            }

            // Generate unique filename
            $filename = 'student_' . $student->id . '_' . time() . '.' . $type;

            // Save to storage/app/public/students/
            Storage::disk('public')->put('students/' . $filename, $imageData);

            // Update student record
            $student->update(['photo' => $filename]);

            return redirect()
                ->route('students.show', $student->id)
                ->with('success', 'Photo uploaded successfully!');

        } catch (\Exception $e) {
            return back()->withErrors(['photo' => 'Failed to save photo: ' . $e->getMessage()]);
        }
    }

    /**
     * Show ID card page
     */
    public function idCard(Student $student)
    {
        // Check if student has photo
        if (!$student->photo) {
            return redirect()
                ->route('students.show', $student->id)
                ->with('error', 'Please upload a photo before generating ID card.');
        }

        return view('students.idcard', compact('student'));
    }

    /**
     * Print ID card
     */
    public function printIdCard(Student $student)
    {
        // Check if student has photo
        if (!$student->photo) {
            return redirect()
                ->route('students.show', $student->id)
                ->with('error', 'Please upload a photo before printing ID card.');
        }

        return view('students.idcard-print', compact('student'));
    }
}