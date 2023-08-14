<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuditPlanRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'faculty_id' => 'required|exists:faculties,id',
            'study_program_id' => 'required|exists:users,id',
            'lead_auditor_id' => 'required|exists:users,id',
            'auditor_1_id' => 'nullable|exists:users,id',
            'auditor_2_id' => 'nullable|exists:users,id',
            'tanggal_rtm' => 'nullable|date',
        ];
    }
}
