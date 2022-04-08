<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailForm1PostRequest extends FormRequest
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
            'nameForm1' => 'required|max:12',
           'emailForm1' => 'required|email',
           'brandForm1' => 'required|max:10',
           'modelForm1' => 'required|max:10',
           'priceForm1' => 'numeric',
           'messageTextForm1' => 'max:1000',
           'phoneNumberForm1' => 'max:12',
	   'takForm1' =>'',
        ];
    }
    
     public function messages()
{
    return [
        'brandForm1.required' => 'Podaj marke!',
        'modelForm1.required' => 'Podaj model!',
        'nameForm1.required' => 'Podaj imię!',
	'nameForm1.max' => 'Za długie imię! Max. 12 znaków!',
        'emailForm1.required' => 'Podaj poprawny adres email!',
        'emailForm1.email' => 'Podaj poprawny adres email!',
        'priceForm1.numeric' => 'Cena musi być liczbą!',
        'phoneNumberForm1.max' => 'Podaj poprawny numer!',
    ];
}
}
