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
    // get team member information
    public function getTeamMemberInfo($id)
    {
        $member_info = Team::find($id);
        return response()->json([
            'status' => 200,
            'member_info' => $member_info,
        ]);
    }
    // update team member information
    public function update(Request $request)
    {
        if ($request->edit_member_photo != '') {
            $member_info = Team::find($request->edit_member_id);
            if ($member_info->photo != '') {
                unlink(public_path('/backend_assets/uploads/teams/'.$member_info->photo));
            }
            $new_photo_name = $request->edit_member_id.'.'.$request->edit_member_photo->getClientOriginalExtension();
            Image::make($request->edit_member_photo)->resize(370, 388)->save(public_path('backend_assets/uploads/teams/' . $new_photo_name));
            Team::find($request->edit_member_id)->update([
                'photo' => $new_photo_name,
            ]);
        }

        Team::find($request->edit_member_id)->update([
            'name' => $request->edit_member_name,
            'designation' => $request->edit_member_designation,
        ]);
        return back()->with('status', 'Team Member Info Update Successfully!');
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
