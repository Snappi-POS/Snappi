<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockmovementController extends Controller
{

    public function index()
    {
        abort_if(!in_array('Menu Item', restaurant_modules()), 403);
        abort_if((!user_can('Show Menu Item')), 403);
        return view('stockmovements.index');
    }

}
