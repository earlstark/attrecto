@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Profile picture</div>
                <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-success">
                                        <p>{{ $message }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($message = Session::get('error'))
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif


                        <div class="row">
                        <div class="col">
                            @if(!file_exists($profile_img["base_path"] . $profile_img["url"]))
                                <img src="/profileImages/default.png"/>
                            @else
                                <img src="{{ $profile_img["url"] }}"/>
                            @endif
                        </div>
                        <div class="col">
                            <form method="post" enctype="multipart/form-data" action="/home/uploadImage">
                                @csrf
                                <input type="file" name="file" />
                                <button type="submit" class="btn btn-danger">
                                    Feltölt
                                </button>
                                <input type="hidden" name="method" value="doUploadImage">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
