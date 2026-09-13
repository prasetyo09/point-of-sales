<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstructionController extends Controller
{
    public function indexAdmin()
    {
        $title = "Instructions For Use (Administrator)";
        $subtitle = "Information regarding how to use the application";
        return view('instruction.admin', compact( 'title','subtitle'));
    }

    public function indexCashier()
    {
        $title = "Instructions For Use (Cashier)";
        $subtitle = "Information regarding how to use the application";
        return view('instruction.cashier', compact( 'title','subtitle'));
    }

    public function indexLeader()
    {
        $title = "Instructions For Use (Leader)";
        $subtitle = "Information regarding how to use the application";
        return view('instruction.leader', compact( 'title','subtitle'));
    }
}
