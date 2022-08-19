<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class RecordAnswerResource extends JsonResource
{

    public $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => (string)$this->id,
            'type' => 'Record Answer',
            'attribute' => [
                'user_id' => $this->user_id,
                'question_type' => $this->question_type,
                'answer' => $this->answer
            ]
        ];
    }
}
