<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Day;

class UpdateDayRequest extends FormRequest
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
        $dayId         = $this->day;
        $requestMethod = $this->method();
        $rules         = Day::$rules;

        switch ($requestMethod) {
            case 'PATCH':
            case 'PUT':
                // Adding Additional Where Clauses
                // You may also specify more conditions that will be added as "where" clauses to the query:
                // 'name' => 'required|string|unique:days'
                // In this rule, only rows with "id" equal to the $dayId would be included in the unique check.
                $rules['name'] = $rules['name'] . ',id,' . $dayId;
                break;
        }

        return $rules;
    }
}
