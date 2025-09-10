<?php

namespace App\Http\Controllers;

use App\Models\InventoryMovement;
use Illuminate\Http\Request;

class InventoryMovementController extends Controller
{
    public function index()
    {
        return view('admin.inventory.movements.index', [
            'title' => 'Movimientos de Inventario',
            'items' => InventoryMovement::latest()->get(),
        ]);
    }
}
