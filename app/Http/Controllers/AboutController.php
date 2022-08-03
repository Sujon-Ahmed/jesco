<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Team;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $team_members = Team::where('status', 1)->take(3)->get();
        $brands = Brand::where('status', 1)->get();
        return view('frontend.about',[
            'team_members' => $team_members,
            'brands' => $brands,
        ]);
    }
}
