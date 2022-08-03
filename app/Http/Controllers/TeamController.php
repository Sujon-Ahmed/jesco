<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class TeamController extends Controller
{
    public function index()
    {
        $members = Team::all();
        return view('backend.teams.index', [
            'members' => $members,
        ]);
    }
    // store team member
    public function store(Request $request)
    {
        $team               = new Team();
        $team->name         = $request->member_name;
        $team->designation  = $request->member_designation;
        // upload team member photo
        $member_photo       = $request->member_photo;
        $photo_extension    = $member_photo->getClientOriginalExtension();
        $photo_name         = uniqid().'.'.$photo_extension;
        Image::make($member_photo)->resize(370,388)->save(public_path('backend_assets/uploads/teams/'.$photo_name));
        $team->photo        = $photo_name;
        $team->save();
        return back()->with('status', 'Team member inserted successfully!');
    }
    // update team member status update
    public function statusUpdate(Request $request)
    {
        $team = Team::find($request->id);
        $team->status = $request->team_status;
        $team->save();
        return 1;
    }
}
