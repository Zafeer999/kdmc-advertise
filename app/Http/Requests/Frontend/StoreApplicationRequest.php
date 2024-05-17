<?php

namespace App\Http\Requests\Frontend;

use App\Models\Document;
use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
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
        $requestArray = [
            'full_name' => 'required|max:150',
            // 'address' => 'required|max:225',
            'contact_no' => 'required|digits:10',
            'alternate_contact_no' => 'nullable|digits:10',
            'advertise_type' => 'required|max:100',
            'ward_id' => 'required',
            // 'location_id' => 'required',
            'location' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'days' => 'required|in:1,3,5,7',
            'length' => 'required|max:40',
            'width' => 'required|max:30',
            // 'banner_id' => 'required',
            'banner_image' => 'required',
            'advertise_detail' => 'required',
            'building_name' => 'required',
            'area' => 'required',
            'landmark' => 'required',
            'city' => 'required',
            'pincode' => 'required|digits:6',
            'aadhar_card_no' => 'required|digits:12',
            // 'pan_card_no' => ['required', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]$/i'],
        ];

        $documents = Document::get();
        foreach($documents as $document)
        {
            $requestFile = 'docs_'.$document->id;
            ($document->is_required == 1) ? $requestArray[$requestFile] = 'required' : $requestArray[$requestFile] = 'nullable';
        }

        return $requestArray;
    }
}
