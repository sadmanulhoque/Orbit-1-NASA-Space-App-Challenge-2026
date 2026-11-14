<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class HealthAssesmentRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sleep' => 'required|in:5,6,7,9',
            'exercise' => 'required|in:yes,partial,no',
            'bone' => 'required|in:none,mild,moderate',
            'mood' => 'required|in:excellent,good,low,stressed',
            'isolation' => 'required|in:low,medium,high',
            'energy' => 'required|in:high,normal,low',
        ];
    }
}
