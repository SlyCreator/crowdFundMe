<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreDonationRequest extends FormRequest
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
        $currentDate = Carbon::now()->format('d-m-Y');

        return [
            "title" => 'required|string',
            "description" =>'required|string',
            "cover_image_url"=> 'required|string',
            "goal"=> 'required|integer',
            "start_date" => [
                'required',
                'date_format:d-m-Y',
                'after_or_equal:' . $currentDate,
            ],
            "end_date" => [
                'required',
                'date_format:d-m-Y',
                'after:' . $currentDate,
            ],
        ];
    }
}
