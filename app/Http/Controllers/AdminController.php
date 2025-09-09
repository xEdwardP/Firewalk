<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalBranches = Branch::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalPurchases = Purchase::count();
        $totalExpiredBatches = Batch::where('expires_at', '<', now())->count();
        $totalActiveBatches = Batch::where('expires_at', '>', now())->count();

        return view('admin.index', [
            'title' => 'Menu Principal',
            'totalBranches' => $totalBranches,
            'totalCategories' => $totalCategories,
            'totalSuppliers' => $totalSuppliers,
            'totalUsers' => $totalUsers,
            'totalProducts' => $totalProducts,
            'totalPurchases' => $totalPurchases,
            'totalExpiredBatches' => $totalExpiredBatches,
            'totalActiveBatches' => $totalActiveBatches,
        ]);
    }
}
