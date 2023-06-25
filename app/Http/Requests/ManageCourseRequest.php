<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ManageCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'course_id' => 'string',
            'course_name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'date_time' => 'required',
            'seats' => 'required',
            'duration_days' => 'required',
            'instructor_name' => 'required'
        ];
    }
}
