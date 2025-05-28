<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BearCertificateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $userId = Auth::id();
        $certificateId = $this->route('certificate')?->id;
        
        return [
            'owner_name' => [
                'required',
                'string',
                'max:255',
                'min:2',
                'regex:/^[a-zA-Z\s\-\.\']+$/'
            ],
            'bear_name' => [
                'required',
                'string',
                'max:255',
                'min:2',
                'regex:/^[a-zA-Z0-9\s\-\.\']+$/',
                'unique:bear_certificates,bear_name,' . $certificateId . ',id,user_id,' . $userId . ',is_active,1'
            ],
            'adoption_date' => [
                'required',
                'date',
                'before_or_equal:today',
                'after_or_equal:' . Carbon::now()->subYears(10)->format('Y-m-d')
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'owner_name.required' => 'Please enter your name.',
            'owner_name.regex' => 'Name can only contain letters, spaces, hyphens, dots, and apostrophes.',
            'owner_name.min' => 'Name must be at least 2 characters long.',
            'bear_name.required' => 'Please enter your teddy bear\'s name.',
            'bear_name.regex' => 'Bear name can only contain letters, numbers, spaces, hyphens, dots, and apostrophes.',
            'bear_name.min' => 'Bear name must be at least 2 characters long.',
            'bear_name.unique' => 'You already have an active certificate for a bear with this name. Please choose a different name.',
            'adoption_date.required' => 'Please select an adoption date.',
            'adoption_date.before_or_equal' => 'Adoption date cannot be in the future.',
            'adoption_date.after_or_equal' => 'Adoption date seems too old. Please check the date.'
        ];
    }
}