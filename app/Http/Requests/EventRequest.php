<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
     *    * @return array
     */
    public function rules()
    {
        $subject_ids = $this->user->subjects_unique->pluck('id')->toArray();
        $subject_ids = implode(',', $subject_ids);

        $classroom_ids = $this->user->teacher->subjects->where('id', $this->subject_id)->pluck('pivot.classroom_id')->toArray();
        $classroom_ids = implode(',', $classroom_ids);

        return [
            'title' => 'required|alpha_num_spaces|max:20',
            'subject_id' => [
                'required',
                'in:'.$subject_ids,
            ],
            'classroom_id' => [
                'required',
                'in:'.$classroom_ids,
            ],
            'date' => 'required|date|after_or_equal:today',
            'start' => 'required|time',
            'end' => 'required|time|after:start',
        ];
    }
}
