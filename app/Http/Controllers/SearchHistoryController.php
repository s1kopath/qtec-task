<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SearchHistory;

class SearchHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = SearchHistory::query();

        $selectedKeywords = [];
        $selectedUsers = [];

        if ($request->filled('keywords')) {
            $selectedKeywords = $request->keywords;
            $query->whereIn('keyword', $selectedKeywords);
        }
        if ($request->filled('users')) {
            $selectedUsers = $request->users;
            $query->where('user_name', $selectedUsers);
        }
        if ($request->filled('yesterday')) {
            $query->whereDate('search_time', Carbon::yesterday());
        }
        if ($request->filled('last_week')) {
            $query->whereBetween('search_time', [Carbon::now()->subWeek(), Carbon::now()]);
        }
        if ($request->filled('last_month')) {
            $query->whereBetween('search_time', [Carbon::now()->subMonth(), Carbon::now()]);
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();

            $query->whereBetween('search_time', [$startDate, $endDate]);
        }

        $searches = $query->paginate(10);
        $searches->appends($request->query());

        $keywords = SearchHistory::selectRaw('keyword, count(*) as count')
            ->groupBy('keyword')
            ->orderByDesc('count')
            ->get();

        $users = SearchHistory::select('user_name')
            ->distinct()
            ->orderBy('user_name')
            ->get();

        return view('welcome', compact('searches', 'keywords', 'users', 'selectedKeywords', 'selectedUsers'));
    }
}
