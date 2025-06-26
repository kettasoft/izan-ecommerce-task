<?php

namespace Modules\Categories\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
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
            'slug' => 'required|string|max:255|unique:categories,slug',
            'parent_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:55',
            'status' => 'required|in:active,inactive',
        ];
    }

    /**
     * Get the update validation rules that apply to the request.
     *
     * @return array
     */
    protected function updateRules(): array
    {
        return [
            'slug' => 'required|string|max:255|unique:categories,slug,' . $this->route('category'),
            'parent_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:55',
            'status' => 'required|in:active,inactive',
        ];
    }
}
