<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageTourRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'thumbnail' => ['sometimes', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'price' => ['required', 'integer'],
            'days' => ['required', 'integer'],
            'about' => ['required', 'string', 'max:100'],

            /**
             * di Laravel simbol .* digunakan untuk validasi setiap item di dalam array.
             * contoh: 
             * <input type="file" name="package_photos[]" multiple>
             * 
             * maka isi request nya:
             * package_photos = [
             *  file1.jpg,
             *  file2.png,
             *  file3.jpg
             * ]
             */      
            'photos' => ['sometimes', 'array'],
            'photos.*' => ['image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'thumbnail.max' => 'Thumbnail maksimal 2MB',
            'photos.*.max' => 'Setiap foto maksimal 2MB',
        ];
    }
}
