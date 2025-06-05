<?php

namespace App\Services;

use App\Models\Result;

class ResultService
{
    public function getLatestLimited($limit = 9)
    {
        return Result::with('event')
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }

    public function loadMoreResults($offset = 0, $limit = 9)
    {
        $query = Result::with('event')->orderBy('created_at', 'desc');
        $totalResults = $query->count();

        $results = $query->skip($offset)
            ->take($limit)
            ->get()
            ->map(function ($result) {
                $images = $result->images;
                $firstImage = $images ? explode(',', $images)[0] : null;
                
                return [
                    'result_id'   => $result->result_id,
                    'images'      => $firstImage,
                    'content'     => $result->content,
                    'event_name'  => optional($result->event)->name,
                    'location'    => optional($result->event)->location,
                    'description' => optional($result->event)->description,
                    'start_date'  => optional($result->event)->start_date,
                    'end_date'    => optional($result->event)->end_date,
                    'quantity_now' => optional($result->event)->quantity_now,
                    'max_quantity' => optional($result->event)->max_quantity,
                ];
            });

        $hasMore = ($offset + $limit) < $totalResults;

        return [
            'results' => $results,
            'hasMore' => $hasMore
        ];
    }

    public function getResultById($id)
    {
        return Result::with([
            'event.organization' => function ($query) {
                $query->select('organization_id', 'username');
            }
        ])->findOrFail($id);
    }
}
