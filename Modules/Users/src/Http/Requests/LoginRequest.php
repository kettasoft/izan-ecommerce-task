<?php

namespace Modules\Users\Http\Requests;

use App\Traits\Responsable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    use Responsable;

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        if ($this->isMethod('POST')) {
            return $this->createRules();
        }

        return $this->updateRules();
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the create validation rules that apply to the request.
     *
     * @return array
     */
    protected function createRules(): array
    {
        return [
            'username' => 'required|string|max:32',
            'password' => 'required|string|min:8',
        ];
    }

    /**
     * Get the update validation rules that apply to the request.
     *
     * @return array
     */
    protected function updateRules(): array
    {
        return [];
    }

    /**
     * @param Validator $validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = $this->sendErrorData($validator->errors()->toArray(), 'fail');

        throw new ValidationException($validator, $response);
    }
}
