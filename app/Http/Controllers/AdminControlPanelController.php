<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminControlPanelController extends Controller
{
    public function show_allow_menu()
    {
        return view('ControlPanel.AllowMenu');
    }
}
