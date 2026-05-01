<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentResultRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //

        'student_id' => 'required',
        'subject_id' => 'required',
        'class_id' => 'required',
        'class_arm_id' => 'required',
        'term_id' => 'required|string',
        'session_id' => 'required',
        'ca_score' => 'required|numeric',
        'exam_score' => 'required|numeric',
        ];
    }
}
