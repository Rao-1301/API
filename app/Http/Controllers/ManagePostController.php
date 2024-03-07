<?php

namespace App\Http\Controllers;
use App\Models\ManagePost;
use App\Models\ProfilePhotos;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class ManagePostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'userID' => 'required|exists:users,id',
            'posts' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules for images
            'caption' => 'nullable|string|max:255',
        ]);

        // Retrieve the profImg from the profilephoto table
        // $profilePhoto = ProfilePhotos::where('userID', $request->userID)->first();

        // if (!$profilePhoto) {
        //     return response()->json(['error' => 'Profile photo not found'], 404);
        // }

        // Retrieve the profImg
        // $profImg = $profilePhoto->profImg;

        // Retrieve fname and lname from the master table
        $user = User::where('id', $request->userID)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $fname = $user->fname;
        $lname = $user->lname;

        $managePost = ManagePost::create([
            'userID' => $request->userID,
            'posts' => $request->file('posts')->store('imgs/posts', 'public'), // Store the image and get its path
            'caption' => $request->caption,
            // 'profImg' => $profImg, // Use the profImg from profilephoto table
        ]);

        return response()->json([
            'message' => 'Post created successfully',
            'data' => $managePost,
            'user_info' => ['fname' => $fname, 'lname' => $lname], // Include user info in the response
        ], 201);
    }
    
    public function getPost()
    {
      
        $posts = ManagePost::with('user')->latest()->get();
        return response()->json($posts);  
    }
}
