<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StWorkRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'employee_id' => 'required',
                    'st_work_date' => 'required',

                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|max:60|unique:bonuses,bonus_id,' . $this->input('bonus_id'),
                    'refer_id' => 'required',

                ];
            }
            default:
                break;
        }//switch
    }
}
