<?php

namespace App\Http\Controllers;

use App\imgUploader;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            "profile_img" => Auth::user()->getProfileImageData(),
        ]);
    }

    public function uploadImage() {
        try {
            $res = (new imgUploader([
                "uploadPath" => public_path() . "/profileImages/",
                "imgName" => "profilePicture_" . Auth::id(),
                "imgThumName" => "profilePicture_thum_" . Auth::id(),
            ]))->upload();
        } catch (InvalidArgumentException $e) {
            return redirect()->route('home')
                ->with('error',$e->getMessage());
        }
        if ($res["ext"] != Auth::user()->getAttribute("profile_img_ext")) {
            @unlink(public_path() . "/profileImages/profilePicture_" . Auth::id() . "." . Auth::user()->getAttribute("profile_img_ext"));
            @unlink(public_path() . "/profileImages/profilePicture_thum_" . Auth::id() . "." . Auth::user()->getAttribute("profile_img_ext"));
        }
        Auth::user()->setAttribute("profile_img_ext", $res["ext"]);
        Auth::user()->save();

        return redirect()->route('home')
            ->with('success','Image uploaded');
    }

}
