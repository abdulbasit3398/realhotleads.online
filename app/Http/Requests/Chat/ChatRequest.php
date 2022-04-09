<?php

namespace App\Http\Requests\Chat;

use Illuminate\Foundation\Http\FormRequest;

class ChatRequest extends FormRequest
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
        if(request()->customer_support) {
            return [
                'message' => 'required',
            ];
        } elseif(request()->send_message_form ){
            return [
                'form_receiver_id' => 'required',
                'message' => 'required',
            ];
        }else{
            return [
                'receiver_id' => 'required',
                'message' => 'required',
            ];
        }

    }
}
