<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConductRecordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('manage-behavior');
    }

    public function rules(): array
    {
        return [
            'student_id' => ['required', 'exists:students,id'],
            'term_id' => ['nullable', 'exists:terms,id'],
            'academic_sessions_id' => ['nullable', 'exists:academic_sessions,id'],
            'type' => ['required', 'in:positive,negative'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'points' => ['required', 'integer', 'min:-100', 'max:100'],
            'incident_date' => ['required', 'date', 'before_or_equal:today'],
            'severity' => ['required_if:type,negative', 'in:minor,moderate,major,severe'],
            'location' => ['nullable', 'string', 'max:255'],
            'action_taken' => ['nullable', 'string'],
        ];
    }
}