<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Organization;

class SearchController extends Controller
{
    public function searchEventsPage(Request $request)
    {
        $events = collect();
        $organizations = collect();
        if ($request->filled('query')) {
            $query = $request->input('query');
            $events = Event::where('name', 'like', '%' . $query . '%')
                ->select('event_id', 'name', 'images', 'location', 'quantity_now', 'max_quantity', 'start_date', 'end_date')
                ->limit(15)
                ->get();

            $organizations = Organization::where('username', 'like', '%' . $query . '%')
                ->select('organization_id', 'username', 'representative','phone', 'avatar', 'address', 'founded_at', 'description', 'website')
                ->limit(15)
                ->get();
        }
        return view('contents.search_events', compact('events', 'organizations'));
    }
} 