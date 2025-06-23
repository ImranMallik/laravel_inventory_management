<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $user = Auth::user();
        return view('admin.user-profile.index', compact('user'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        try {
            $user = auth()->user();

            // Handle image upload via trait
            if ($request->hasFile('image')) {
                $path = 'uploads/users';
                $newImagePath = $this->updateImage($request, 'image', $path, $user->photo);
                $user->photo = $newImagePath;
            }

            // Update user data
            $user->update([
                'name' => $request->name,
                'phone_num' => $request->phone_num,
                'address' => $request->address,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Profile updated successfully!',
            ], 200);
        } catch (\Exception $e) {
            logger()->error('Profile Update Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong while updating the profile.',
            ], 500);
        }
    }
}
