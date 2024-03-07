<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; 


class UserController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'fname' => 'required|string',
            'lname' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'village' => 'required',
            'margStatus' => 'required',
            'education' => 'required',
            'contactNo' => 'required',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
        ]);

        $user = new User([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'village' => $request->village,
            'margStatus' => $request->margStatus,
            'education' => $request->education,
            'contactNo' => $request->contactNo,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->save();

        return response()->json(['statusCode' => 201, 'message' => 'User registered successfully']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json(['statusCode' => 401, 'message' => 'Unauthorized']);
        }
        
        $user = $request->user();
        $token = $user->createToken('MyApp')->accessToken;

        return response()->json(['statusCode' => 200, 'message' => 'Login successfull', 'token' => $token, 'data' => $user]);
    
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->token()->revoke();

        return response()->json(['statusCode' => 200, 'message' => 'Logged out successfully']);
    }
    public function getUserData(Request $request)
    {
        return $request->user();
    }
    public function findUser(Request $request)
    {
        $request->validate([
            'minAge' => 'required|string',
            'maxAge' => 'required|string',
            'gender' => 'required|string',
            
         ]);

        // Construct the age range string (e.g., "20-30")
        $ageRange = $request->minAge . '-' . $request->maxAge;
    
        // Get the gender from the route parameters
        $gender = $request->gender;
    
        // Query users based on age and gender
        $users = User::whereBetween('dob', [
            now()->subYears($request->maxAge),
            now()->subYears($request->minAge),
        ])->where('gender', $gender)->get();
    
        // Return the JSON response with the users
        return response()->json(['users' => $users]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|string',

        ]);
        $id=$request->id;
        $user=User::find($id);
    }
    public function getUserDetails($id)
    {
        $data = User::where('id', $id)->first();

        if (!$data) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json(['data' => $data], 200);
    }
    public function allUser()
    {
        $users = User::all();

        return response()->json(['users' => $users]);
    }
}