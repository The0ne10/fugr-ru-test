<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class NotebookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fullName' => $this->fullName,
            'company' => $this->company,
            'phone' => (int)$this->phone,
            'mail' => $this->email,
            'birthday' => $this->when($this->birthday != null, function () {
                return Carbon::parse($this->birthday)->format('Y-m-d');
            }, function () {
                return null;
            }),
            'image' => $this->image,
        ];
    }
}
