@extends('layouts.dashboard.app')

@section('title', 'Create Category')

@section('content')
    <div class="container">
        <div class="row">
            <div class="mx-auto col-md-6 mt-5">
                @include('includes.showErrorsSection')
                <h1 class="text-center">Create New Category</h1>
                {!! Form::open(['route' => 'dashboard.category.store', 'method' => 'post']) !!}
                <div class="form-group">
                    {!! Form::text('name', '', ['class' => 'form-control', "placeholder" => "Enter Category Name"]) !!}
                </div>
                <div class="form-group">

                    {!! Form::button('<i class="fa fa-plus"></i> Create', ['type' => 'submit', 'class' => 'form-control btn btn-success']) !!}

                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
