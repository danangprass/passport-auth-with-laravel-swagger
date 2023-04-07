<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class StoreCandidateRequest extends FormRequest
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
            'name' => 'required',
            'experience' => 'required',
            'education' => 'required',
            'bod' => 'required|date',
            'last_position' => 'required',
            'applied_position' => 'required',
            'skills' => 'required',
            'email' => 'required|unique:candidates,email',
            'phone' => 'required',
            'resume' => 'required|mimes:pdf',
        ];
    }


    protected function prepareForValidation(): void
    {
        if (!$this->getValidatorInstance()->fails() && !$this->header('x-test-request')) {
            $resume = $this->file('resume');
            $file = Storage::putFile('public/files', $resume);
            $resume_url = url(Storage::url($file));
            $this->merge([
                'resume_url' => $resume_url,
            ]);
        }
    }
}
