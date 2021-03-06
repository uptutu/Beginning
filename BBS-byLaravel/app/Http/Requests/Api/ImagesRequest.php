<?php

namespace App\Http\Requests\Api;



class ImagesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'type' => 'required|string|in:avatar, topic'
        ];

        if ($this->type === 'avatar') {
            $rules['image'] = 'required|mimes:jpeg, bmp, png, gif|dimensions:min_width=200,min_height=200';
        } else {
            $rules['image'] = 'required|mimes:jpeg, bmp, png, gif';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'image.dimensions' => '照片清晰度不够，宽高需要 200px 以上'
        ];
    }
}
