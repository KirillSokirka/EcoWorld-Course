<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:announcements,title|max:100',
            'description' => 'required|max:255',
            'location' => 'required|max:100',
            'date' => 'required|date',
            'images' => 'nullable',
            'images.*' => 'nullable|image',
        ];
    }
}
