@extends('layouts.dashboard.app')

@section('title', 'Edit Category')

@section('content')
    <div class="container">
        <div class="row">
            <div class="mx-auto col-md-6 mt-5">
                @include('includes.showErrorsSection')
                <h1 class="text-center">Edit New Category</h1>
                {!! Form::open(['route' => ['dashboard.category.update', $category->id], 'method' => 'PUT']) !!}
                <div class="form-group">
                    {!! Form::text('name', $category->name, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">

                    {!! Form::button('<i class="fa fa-edit"></i> Edit', ['type' => 'submit', 'class' => 'form-control btn btn-primary']) !!}

                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
