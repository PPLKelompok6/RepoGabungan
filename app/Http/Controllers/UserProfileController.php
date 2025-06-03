<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class UserProfileController extends Controller
{
    public function edit()
    {
        return view('user.profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $user = auth()->user();

            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                
                // Delete old image if exists
                if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                    Storage::disk('public')->delete($user->profile_picture);
                    Log::info('Old profile picture deleted', ['path' => $user->profile_picture]);
                }

                // Store new image
                $path = $file->store('profile-pictures', 'public');
                
                if (!$path) {
                    throw new \Exception('Failed to store image');
                }

                $user->profile_picture = $path;
                Log::info('New profile picture stored', [
                    'user_id' => $user->id,
                    'path' => $path,
                    'full_url' => Storage::disk('public')->url($path)
                ]);
            }

            $user->name = $request->name;
            $user->save();

            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            Log::error('Profile update failed', [
                'error' => $e->getMessage(),
                'user' => auth()->id(),
                'request_data' => $request->except('profile_picture')
            ]);
            return redirect()->back()
                ->with('error', 'Failed to update profile: ' . $e->getMessage())
                ->withInput();
        }
    }
} 