<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\InventoryBranchBatch;
use Illuminate\Http\Request;

class InventoryBranchBatchController extends Controller
{
    public function index()
    {
        $branches = Branch::withCount('inventoryBranchBatches')->get();

        foreach ($branches as $branch) {
            $branch->totalInventory = InventoryBranchBatch::where('branch_id', $branch->id)->sum('branch_quantity');
        }

        return view('admin.inventory.branches_in_batches.index', [
            'title' => 'Inventario de sucursal por lotes',
            'branches' => $branches,
        ]);
    }

    public function showInventoryInBranch(Branch $branch)
    {
        $branch = Branch::findOrFail($branch->id);
        $inventoryBranchBatches = InventoryBranchBatch::where('branch_id', $branch->id)->with('batch.product', 'batch.supplier')->get();
        return view('admin.inventory.branches_in_batches.show', [
            'title' => 'Sucursal: ' . $branch->name,
            'branch' => $branch,
            'items' => $inventoryBranchBatches,
        ]);
    }
}
