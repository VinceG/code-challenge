<?php
namespace App\Http\Requests\Api\Users;

use Illuminate\Support\Str;
use App\Http\Requests\Api\BaseRequest;

class CreateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'first_name' => ['required', 'min:3'],
            'last_name' => ['required', 'min:3']
        ];
    }

    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        if ($this->method() != 'POST') {
            return $validator;
        }

        $validator->after(function () use ($validator) {
            // Fill in the gaps
            $this->merge([
                'id' => Str::random(5),
                'avatar' => 'https://lorempixel.com/128/128/'
            ]);
        });

        return $validator;
    }
}