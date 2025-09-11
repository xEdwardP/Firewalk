<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $batches = Batch::with('product', 'supplier')->latest()->get();

        if ($from && $to) {
            $batches = Batch::with('product', 'supplier')->whereBetween('expires_at', [$from, $to])->get();
        }

        $batches->each(function ($batch) {
            $expiresDate = Carbon::parse($batch->expires_at);
            $todayDate = Carbon::today();
            $batch->is_expired = $expiresDate->isPast();
            $batch->days_to_expire = $todayDate->diffInDays($expiresDate, false);
        });

        return view('admin.batches.index', [
            'title' => 'Lotes',
            'batches' => $batches,
        ]);
    }
}
