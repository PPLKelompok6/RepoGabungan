<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('doctor.profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'specialization' => 'required|string'
        ]);

        try {
            $user = auth()->user();

            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                
                // Delete old image if exists
                if ($user->profile_picture) {
                    Storage::disk('public')->delete($user->profile_picture);
                }

                // Generate unique filename
                $filename = time() . '_' . $file->getClientOriginalName();
                
                // Store the file
                $path = $file->storeAs('profile-pictures', $filename, 'public');
                
                if (!$path) {
                    throw new \Exception('Failed to store image');
                }

                $user->profile_picture = $path;
                Log::info('Profile picture updated', ['user' => $user->id, 'path' => $path]);
            }

            $user->name = $request->name;
            $user->specialization = $request->specialization;
            $user->save();

            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            Log::error('Profile update failed', [
                'error' => $e->getMessage(),
                'user' => auth()->id()
            ]);
            return redirect()->back()
                ->with('error', 'Failed to update profile: ' . $e->getMessage())
                ->withInput();
        }
    }
}