<?php

namespace App\Http\Controllers;

use App\imgUploader;
use App\Models\User;
use InvalidArgumentException;

class ProfilePictureManagerController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        return view('users.profileimg', [
            "profile_img" => User::find($id)->getProfileImageData(),
            "user_id" => $id,
        ]);
    }

    public function uploadImage($id) {
        /**
         * @var $user User
         */
        $user = User::find($id);
        try {
            $res = (new imgUploader([
                "uploadPath" => public_path() . "/profileImages/",
                "imgName" => "profilePicture_" . $id,
                "imgThumName" => "profilePicture_thum_" . $id,
            ]))->upload();
        } catch (InvalidArgumentException $e) {
            return redirect("profileimg/". $id)->with('error',$e->getMessage());
        }
        if ($res["ext"] != $user->getAttribute("profile_img_ext")) {
            @unlink(public_path() . "/profileImages/profilePicture_" . $id. "." . $user->getAttribute("profile_img_ext"));
            @unlink(public_path() . "/profileImages/profilePicture_thum_" . $id . "." . $user->getAttribute("profile_img_ext"));
        }
        $user->setAttribute("profile_img_ext", $res["ext"]);
        $user->save();

        return redirect("profileimg/". $id)->with('success','Image uploaded');
    }
}
