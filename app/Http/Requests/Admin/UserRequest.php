<?php

namespace App\Http\Requests\Admin;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|between:3,25',
                    'phone' => 'required',
                ];
                break;
            case 'PUT':
                break;
            case 'PATCH':
                $id = $this->segment(3);
                return [
                    'name' => 'required|between:3,25|unique:users,name,' . $id,
                    'phone' => 'required|unique:users,phone,' . $id,
                    'introduction' => 'max:80',
                ];
                break;
            case 'DELETE':
                break;
            default:
                return [];
                break;
        }
    }
}
