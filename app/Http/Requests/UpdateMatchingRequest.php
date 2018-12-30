<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Matching;

class UpdateMatchingRequest extends FormRequest
{

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
     * @return array
     */
    public function rules()
    {
        $shiftId       = $this->shift_id;
        $requestMethod = $this->method();
        $rules         = Matching::$rules;

        switch ($requestMethod) {
            case 'PATCH':
            case 'PUT':
                // Adding Additional Where Clauses
                // You may also specify more conditions that will be added as "where" clauses to the query:
                // 'name' => 'required|string|unique:shift_id'
                // In this rule, only rows with "id" equal to the $shiftId would be included in the unique check.
                $rules['shift_id'] = $rules['shift_id'] . ',id,' . $shiftId;
                break;
        }

        return $rules;
    }
}
