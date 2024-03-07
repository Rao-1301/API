<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilePhotos;
use App\Models\User;



class ProfilePhotosController extends Controller
{
    public function setProfilePhoto(Request $request)
    {
        $request->validate([
            'userID' => 'required|exists:users,id',
            'profImg' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $master = User::where('id', $request->userID)->first();

        if (!$master) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $fname = $master->fname;
        $lname = $master->lname;

        $profilePhoto = ProfilePhotos::updateOrCreate(
            ['userID' => $request->userID],
            ['profImg' => $request->file('profImg')->store('images/profiles')]
        );

        return response()->json([
            'message' => 'Profile photo set successfully',
            'data' => $profilePhoto,
            'fname' => $fname,
            'lname' => $lname,
        ], 200);
    }
}
