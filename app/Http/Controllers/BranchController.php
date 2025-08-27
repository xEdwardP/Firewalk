<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $title = 'Sucursales';
        $items = Branch::all();
        return view('admin.branches.index', compact('title', 'items'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Branch $branch)
    {
        //
    }

    public function edit(Branch $branch)
    {
        //
    }

    public function update(Request $request, Branch $branch)
    {
        //
    }

    public function destroy(Branch $branch)
    {
        //
    }
}
