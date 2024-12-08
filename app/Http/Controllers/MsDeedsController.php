<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MsDeeds;
use App\Models\User;

class MsDeedsController extends Controller
{
    //

    public function guestDashboard(){
        $deeds = Msdeeds::paginate(3);
        $users = User::all();

        $datas = [
            'deeds'=>$deeds,
            'users'=>$users
        ];
        return view('Home', $datas);
    }

    public function ownerDashboard(){
        $deeds = Msdeeds::where('status', 'Requested')->paginate(3);
        $users = User::all();

        $datas = [
            'deeds'=>$deeds,
            'users'=>$users
        ];
        return view('Home', $datas);
    }

    public function takerDashboard(){
        $deeds = Msdeeds::where('status', 'Requested')->paginate(3);
        $users = User::all();

        $datas = [
            'deeds'=>$deeds,
            'users'=>$users
        ];
        return view('Home', $datas);
    }

    public function TakerDeedDetail(MsDeeds $deed) {

        return view('Detail', ['deed' => $deed]);
    }

    public function deedDetail(MsDeeds $deed) {

        return view('Detail', ['deed' => $deed]);
    }

    public function myDeeds()
    {
        // Get the user ID from session (assuming it's stored in session)
        $userId = session('userId');  // Or use auth()->id() if you are using Laravel's authentication system

        // Get deeds associated with the logged-in user
        $deeds = Msdeeds::where('owner_user_id', $userId)->paginate(3);

        // Prepare the data to pass to the view
        $datas = [
            'deeds' => $deeds
        ];

        // Return the view with deeds data
        return view('Mydeeds', $datas);
    }


    public function takerOnProgressDeeds()
    {
        $userId = Auth::user()->id;
        
        $deeds = Msdeeds::where('taker_user_id', $userId)->where('status', 'Taken')->paginate(3);

        $datas = [
            'deeds' => $deeds
        ];

        return view('MyDeeds', $datas);
    }

    public function takerDoneDeeds()
    {
        $userId = Auth::user()->id;
        
        $deeds = Msdeeds::where('taker_user_id', $userId)->where('status', 'Completed')->paginate(3);

        $datas = [
            'deeds' => $deeds
        ];

        return view('MyDeedsDone', $datas);
    }

    public function addDeed(){
        return view('Adddeeds');
    }

    public function storeDeed(Request $request)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'description' => 'required',
            'prize' => 'required|numeric|min:0',
        ]);

        // Retrieve the logged-in user's ID from session
        $ownerUserId = Auth::user()->id; // Assuming userId is stored in session during login


        // Create a new deed entry in the database
        MsDeeds::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'prize' => $validatedData['prize'],
            'status' => 'Requested',
            'owner_user_id' => $ownerUserId,
            'taker_user_id' => 0, // Default value
        ]);

        // Redirect back with a success message
        return redirect()->route('mydeed.index')->with('success', 'Deed added successfully.');
    }

    public function takeDeed(Request $request)
    {
        $userId = Auth::user()->id;

        $deedId = $request->deed_id;
        
        $deed = MsDeeds::find($deedId);

        if (!$deed) {
            return response()->json(['error' => 'Deed not found.'], 404);
        }

        if ($deed->taker_user_id != 0) {
            return response()->json(['error' => 'This deed has already been taken.'], 400);
        }

        if ($deed->owner_user_id == $userId) {
            return response()->json(['error' => 'You cannot take your own deed.'], 403);
        }

        // Update the taker_user_id
        $deed->status = 'Taken';
        $deed->taker_user_id = $userId;
        $deed->save();

        return redirect()->route('takerDashboardShow')->with('success', 'Deed added successfully.');
    }

    public function doneDeed(Request $request)
    {
        $deedId = $request->deed_id;
        
        $deed = MsDeeds::find($deedId);

        if (!$deed) {
            return response()->json(['error' => 'Deed not found.'], 404);
        }

        // Update the taker_user_id
        $deed->status = 'Completed';
        $deed->save();

        return redirect()->route('takerDashboardShow')->with('success', 'Deed added successfully.');
    }

    public function activity(){
        // Get the user ID from session (assuming it's stored in session)
        $userId = session('userId');  // Or use auth()->id() if you are using Laravel's authentication system

        // Get deeds associated with the logged-in user
        $deeds = Msdeeds::where('taker_user_id', $userId)->orderBy('status', 'desc')->paginate(3);

        // Prepare the data to pass to the view
        $datas = [
            'deeds' => $deeds
        ];

        // Return the view with deeds data
        return view('Activity', $datas);
    }

    public function cancelDeed(Request $request, $deedId)
    {
        // Get the logged-in user's ID
        $userId = session('userId');

        if (!$userId) {
            return response()->json(['error' => 'You must be logged in to cancel this deed.'], 403);
        }

        // Find the deed by ID
        $deed = MsDeeds::find($deedId);

        if (!$deed) {
            return response()->json(['error' => 'Deed not found.'], 404);
        }

        // Update the taker_user_id
        $deed->status = 'Requested';
        $deed->taker_user_id = 0;
        $deed->save();

        return response()->json(['success' => 'Deed successfully taken.']);
    }

    public function completeDeed(Request $request, $deedId)
    {
        // Get the logged-in user's ID
        $userId = session('userId');

        if (!$userId) {
            return response()->json(['error' => 'You must be logged in to complete this deed.'], 403);
        }

        // Find the deed by ID
        $deed = MsDeeds::find($deedId);

        if (!$deed) {
            return response()->json(['error' => 'Deed not found.'], 404);
        }

        // Update the taker_user_id
        $deed->status = 'Completed';
        $deed->save();

        return response()->json(['success' => 'Deed successfully taken.']);
    }

    public function deleteDeed($id)
    {
        // Find the deed by ID
        $deed = MsDeeds::find($id);

        // Check if the deed exists and if the logged-in user owns it
        if (!$deed || $deed->owner_user_id != session('userId')) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to delete this job.',
            ], 403);
        }

        // Delete the deed
        $deed->delete();

        return response()->json([
            'success' => true,
            'message' => 'Job deleted successfully.',
        ]);
    }
}