<?php

namespace App\Http\Transformers;

use URL;
use App\Http\Transformers;

class APITransformer extends Transformer 
{
    /**
     * Transform
     * 
     * @param array $data
     * @return array
     */
    public function transform($data) 
    {
        if(is_array($data))
        {
            $data = (object)$data;
        }
        
        return [
            'eventId'           => (int) $data->id,
            'eventName'         => $data->name,
            'eventTitle'        => $data->title,
            'eventStartDate'    => date('d-m-Y', strtotime($data->start_date)),
            'eventEndDate'      => date('d-m-Y', strtotime($data->end_date))
        ];
    }

    public function createEvent($model = null)
    {
        return [
            'eventId'           => (int) $model->id,
            'eventName'         => $model->name,
            'eventTitle'        => $model->title,
            'eventStartDate'    => date('d-m-Y', strtotime($model->start_date)),
            'eventEndDate'      => date('d-m-Y', strtotime($model->end_date))
        ];
    }

    public function getTeamMembers($members)
    {
        $response = [];

        if(isset($members) && count($members))
        {
            foreach($members as $member)
            {
                $response[] = [
                    'memberId'          => (int) $member->id,
                    'title'             => $member->title,
                    'company'           => $member->company,
                    'designation'       => $member->designation,
                    'contact_number'    => $member->contact_number,
                    'image'             => URL::to('/').'/uploads/team/'.$member->profile_picture,
                    'category'          => (int) $member->category,
                    'description'       => $member->description
                ];
            }
        }
        return $response;
    }

    public function getContacts($members)
    {
        $response = [];

        if(isset($members) && count($members))
        {
            foreach($members as $member)
            {
                $response[] = [
                    'memberId'          => (int) $member->id,
                    'title'             => $member->title,
                    'company'           => $member->company,
                    'designation'       => $member->designation,
                    'contact_number'    => $member->contact_number,
                    'image'             => URL::to('/').'/uploads/team/'.$member->profile_picture,
                    'description'       => $member->description
                ];
            }
        }
        return $response;
    }
}
