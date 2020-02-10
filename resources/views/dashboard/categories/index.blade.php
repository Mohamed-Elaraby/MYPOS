@extends('layouts.dashboard.app')

@section('title', 'Categories')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto mt-5">
                @include('includes.showErrorsSection')
                <h1 class="text-center">Categories List <small>[ {{ $categories->total() }} ]</small></h1>

                {!! Form::open(['route' => 'dashboard.category.index', 'method' => 'get']) !!}
                    {!! Form::search('search', request()->search, ['class' => '']) !!}
                    {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}

                @if (Auth::user()->hasPermission('create_categories'))
                    <a href="{{ route('dashboard.category.create') }}" class="btn btn-success btn-sm mb-5 mt-5"><i class="fa fa-plus"></i> Create</a>
                @else
                    <button class="btn btn-success btn-sm mb-5 mt-5" disabled><i class="fa fa-plus"></i> Create</button>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index=>$category)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $category->name }}</td>

                                <td>
                                    @if (Auth::user()->hasPermission('update_categories'))
                                        <a href="{{ route('dashboard.category.edit', $category->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    @else
                                        <button class="btn btn-primary btn-sm" disabled><i class="fa fa-edit"></i></button>
                                    @endif

                                    @if (Auth::user()->hasPermission('delete_categories'))
                                        {!! Form::open(['route' => ['dashboard.category.destroy', $category->id], 'method' => 'delete', 'style' => 'display:inline-block']) !!}
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
                {{ $categories->appends(request()->query())->links() }}
            </div>
        </div>

    </div>
@endsection




