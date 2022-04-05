<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReportsCollection;
use App\Models\Report;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class ReportsController extends Controller
{
    public function index()
    {
        return Inertia::render('Reports/Index', [
            'filters' => Request::all('search', 'trashed'),
            'reports' => new ReportsCollection(
                    Report::orderBy('date')
                    ->filter(Request::only('search', 'trashed'))
                    ->paginate()
                    ->appends(Request::all())
            ),
        ]);
    }
}
