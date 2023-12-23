<?php

namespace App\Http\Requests\Api;

use App\Traits\requestApiTrait;
use Illuminate\Foundation\Http\FormRequest;

class CategoryDetailsRequest extends FormRequest
{
    use requestApiTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id'          => 'required|exists:categories,id',
        ];
    }
}
