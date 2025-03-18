<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avatar;
use App\Models\User;

class AvatarController extends Controller
{
    public function uploadAvatar(Request $request, $userId)
    {
       
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $user = User::findOrFail($userId);
        
        if ($user->avatar) {
            $avatarPath = public_path('storage/avatars/'.$user->avatar->image);
            if (file_exists($avatarPath)) {
                unlink($avatarPath);
            }
            $user->avatar->delete();
        }

        
        $imageName = time().'.'.$request->image->extension();
        $request->image->storeAs('avatars', $imageName, 'public');

        $avatar = new Avatar();
        $avatar->user_id = $user->id;
        $avatar->image = $imageName;
        $avatar->save();

        return back()->with('success', 'Avatar uploaded successfully.');
    }
}
