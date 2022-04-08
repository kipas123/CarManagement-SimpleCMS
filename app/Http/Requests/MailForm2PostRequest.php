<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailForm2PostRequest extends FormRequest
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
        return [
            'nameForm2' => 'required|max:10',
           'emailForm2' => 'required|email',
           'messageTextForm2' => 'required|max:1000',
	   'takForm2' =>'',
        ];
    }
         public function messages()
{
    return [
        'nameForm2.required' => 'Podaj imię!',
        'emailForm2.required' => 'Adres e-mail jest wymagany',
        'emailForm2.email' => 'Niepoprawny adres email',
        'messageTextForm2.required' => 'Brak tekstu wiadomości!',
    ];
}
}
