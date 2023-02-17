<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = [
            'message' => 'Logout Successfully',
            'alert-type' => 'success',
        ];
        return redirect('/login')->with($notification);
    }

    public function profile()
    {
        $userId = Auth::user()->id;
        $adminData = User::find($userId);
        return view('admin.admin_profile', compact('adminData'));
    }

    public function adminProfileUpdate(Request $request)
    {
        $userId = Auth::user()->id;
        $userData = User::find($userId);
        $userData->name = $request->name;
        // $userData->email=$request->email;
        $userData->username = $request->username;
        if ($request->file('profileImg')) {
            $file = $request->file('profileImg');
            $fileName = Carbon::now()->format('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $fileName);
            $userData['profile_image'] = $fileName;
        }
        $userData->save();
        $notification = [
            'message' => 'Profile Update Success',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('admin.profile')
            ->with($notification);
    }

    public function adminPasswordUpdate(Request $request)
    {
        $userPass = Auth::user()->password;
        $validateData = $request->validate([
            'oldPass' => 'required',
            'newPass' => 'required',
            'confirmPass' => 'required|same:newPass',
        ]);
        if (Hash::check($request->oldPass, $userPass)) {
            $userId = Auth::user()->id;
            $user = User::find($userId);
            $user->password = bcrypt($request->newPass);
            $user->save();
            session()->flush('message', 'Password update successfully');
            $notification = [
                'message' => 'Password update successfully. Please Login Using New Password.',
                'alert-type' => 'success',
            ];
            return redirect()
                ->route('login')
                ->with($notification);
        } else {
            // session()->flush('message', 'Old Password not matched');
            $notification = [
                'message' => 'Old Password not matched',
                'alert-type' => 'error',
            ];
            return redirect()
                ->back()
                ->with($notification);
        }
    }
}
