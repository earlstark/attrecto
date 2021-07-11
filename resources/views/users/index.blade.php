@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/css/bootstrap-datepicker3.css">
    <link rel="stylesheet" href="/css/bootstrap-datepicker3.standalone.css">
    <script src="/js/bootstrap-datepicker.js"></script>
    <script src="/js/todos.js"></script>
    <script>
        todos.token = '{{ csrf_token() }}';
    </script>
    <div class="modal fade" id="todosModal" tabindex="-1" role="dialog" aria-labelledby="todosModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="todoModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <input name="user_id" id="modal_user_id" type="hidden" value="">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col">
                                {!! Form::text('name', null, array('id' => 'todo_name', 'placeholder' => 'Name','class' => 'form-control')) !!}
                            </div>
                            <div class="col">
                                {{ Form::text('date', '', array('placeholder' => 'Date', 'id' => 'todo_datepicker', 'autocomplete' => 'off')) }}
                            </div>
                            <div class="col">
                                <button class="btn btn-primary" onclick="todos.submitModal()">
                                    Add
                                </button>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col">
                            <div id="todo_container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>Profile picture</th>
            <th>Name</th>
            <th>Email</th>
            <th>Todo</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $user)
            <tr>
                <td>
                    <a href="/profileimg/{{ $user->id }}">
                        @if(!file_exists($user->getProfileImageData()["base_path"] . $user->getProfileImageData()["url"]))
                            <img src="/profileImages/default.png"/>
                        @else
                            <img src="{{ $user->getProfileImageData()["url"] }}"/>
                        @endif
                    </a>
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <div id="todo_display_div_{{ $user->id }}">
                        @foreach($user->todos()->get()->toArray() as $todo)
                                <div class="row">
                                    <div class="col">
                                        {{ $todo["name"] }}
                                    </div>
                                    <div class="col">
                                        {{ $todo["date"] }}
                                    </div>
                                </div>
                        @endforeach
                    </div>
                    <button class="btn btn-primary todo_modal_opener_button" data_id="{{ $user->id }}" data_name="{{ $user->name }}" data_todo_data='{{ $user->todos()->get() }}'>
                        Manage
                    </button>
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>

    {!! $data->links('pagination::bootstrap-4') !!}

    <script>
        todos.setShowModalEvents();
    </script>

@endsection