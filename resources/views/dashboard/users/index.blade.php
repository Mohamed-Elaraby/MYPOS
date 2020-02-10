@extends('layouts.dashboard.app')

@section('title', 'Users')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto mt-5">
                @include('includes.showErrorsSection')
                <h1 class="text-center">Users List <small>[ {{ $users->total() }} ]</small></h1>

                {!! Form::open(['route' => 'dashboard.user.index', 'method' => 'get']) !!}
                    {!! Form::search('search', request()->search, ['class' => '']) !!}
                    {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}

                @if (Auth::user()->hasPermission('create_users'))
                    <a href="{{ route('dashboard.user.create') }}" class="btn btn-success btn-sm mb-5 mt-5"><i class="fa fa-plus"></i> Create</a>
                @else
                    <button class="btn btn-success btn-sm mb-5 mt-5" disabled><i class="fa fa-plus"></i> Create</button>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>First Name</th>
                            <th>First Name</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index=>$user)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a href="{{ route('dashboard.downloadImage', $user->image) }}"><img class="img-thumbnail" style="width: 75px; height: 75px;" src="{{ asset('images/'. $user->image) }}" alt=""></a></td>
                                <td>
                                    @if (Auth::user()->hasPermission('update_users'))
                                        <a href="{{ route('dashboard.user.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    @else
                                        <button class="btn btn-primary btn-sm" disabled><i class="fa fa-edit"></i></button>
                                    @endif

                                    @if (Auth::user()->hasPermission('delete_users'))
                                        {!! Form::open(['route' => ['dashboard.user.destroy', $user->id], 'method' => 'delete', 'style' => 'display:inline-block']) !!}
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure Remove This Is User?')"><i class="fa fa-trash"></i></button>
                                        {!! Form::close() !!}
                                    @else
                                        <button class="btn btn-danger btn-sm" disabled><i class="fa fa-trash"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>{{--end of table--}}
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>

    </div>
@endsection




