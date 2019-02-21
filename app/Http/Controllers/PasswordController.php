<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Hash;

class PasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return  void
     */
    public function __construct()
    {
        $this->middleware('role:admin')
            ->only(['indexAdmin']);
    }

    /**
     * Show change password page for Admin
     *
     * @return View
     */
    public function indexAdmin()
    {
        return view('users.admin.changePassword');
    }

    /**
     * Change password of user
     *
     * @param  Request $request
     * @return JSON
     */
    public function changePassword(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();

            $currentPassword = $request->currentPassword;
            $newPassword = $request->newPassword;
            $reTypeNewPassword = $request->reTypeNewPassword;

            if (!Hash::check($currentPassword, $user->password)) {
                return response('Wrong current password.', 400);
            }

            if ($newPassword != $reTypeNewPassword) {
                return response('
                    New Password and Re-Typed New Password does not match',
                    400
                );
            }

            $user->password = bcrypt($request->newPassword);
            $user->save();

            return response('Password changed successfully.', 200);
        }
    }
}
