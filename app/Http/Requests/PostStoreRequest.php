<?php

namespace App\Http\Requests;

use App\Policies\PostPolicy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $post = $this->route('post');

        return is_null($post) ? true : Gate::allows('update', $post);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|min:10|max:70',
            'body' => 'required|string|min:50',
            'img' => 'nullable|image'
        ];
    }
}
