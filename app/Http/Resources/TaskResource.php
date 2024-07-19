<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'TaskId' => $this->TaskId,
            "Deadline"=> $this->Deadline,
            "Title" => $this->Title,
            "Description" => $this->Description,
            "Image" => $this->Image,
            "Subject" => new SubjectResource($this->Subject)
        ];
    }
}
