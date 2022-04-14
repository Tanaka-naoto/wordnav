<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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

            'before_word'        => ['required', 'string', 'max:255'],
            'background' => ['required', 'string', 'max:2000'],
            'category'    => ['required', 'integer'],
        ];
    }

    public function attributes()
    {
        return [
            'before_word'        => '言い変えたい言葉',
            'background' => 'いきさつ',
            'category'    => 'カテゴリ',
        ];
    }
}
