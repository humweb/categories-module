<?php
namespace Humweb\Categories;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CategoryRequest
 *
 * @package Humweb\Categories
 */
class CategoryRequest extends FormRequest
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
            'title' => 'required|max:255',
            'slug'  => 'required|max:255',
        ];
    }

}
