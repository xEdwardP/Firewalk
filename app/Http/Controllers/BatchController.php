<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index(){
        $batches = Batch::with('product', 'supplier')->latest()->get();
        $batches->each(function($batch){
            $batch->is_expired = Carbon::parse($batch->expires_at)->isPast();
        });
        

        return view('admin.batches.index', [
            'title' => 'Lotes',
            'batches' => $batches,
        ]);
    }
}
