@extends('layouts.dashboard.app')

@section('title', 'Edit User')

@section('content')
    <div class="container">
        <div class="row">
            <div class="mx-auto col-md-6 mt-5">
                @include('includes.showErrorsSection')
                <h1 class="text-center">Edit User Information</h1>
                {!! Form::open(['route' => ['dashboard.user.update', $user->id], 'method' => 'PUT', 'files' =>true]) !!}
                <div class="form-group">
                    {!! Form::text('first_name', $user->first_name, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('last_name', $user->last_name, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::file('image', ['class' => 'form-control image']) !!}
                </div>
                <div class="form-group">
                    <img src="{{ asset('images/'. $user->image) }}" class="img-thumbnail image_preview" style="width: 75px; height: 75px;" alt="">
                </div>
                <div class="form-group">
                    <h5 class="mt-4 mb-2">Permissions</h5>
                    <div class="row">
                        <div class="col-12">
                            <!-- Custom Tabs -->
                            <div class="card">
                                <div class="card-header d-flex p-0">
                                    <h3 class="card-title p-3">Users</h3>
                                    {{--<ul class="nav nav-pills ml-auto p-2">
                                        <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Tab 1</a></li>
                                    </ul>--}}
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            @php $params = ['create', 'read', 'update', 'delete']; @endphp
                                            @foreach ($params as $param)
                                                <label>
                                                    {!! Form::checkbox('permissions[]', $param.'_users', $user->hasPermission($param.'_users')?'checked':'' ) !!}
                                                    {{ ucfirst($param) }}
                                                </label>
                                            @endforeach
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- ./card -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::button('<i class="fa fa-edit"></i> Update', ['type' => 'submit', 'class' => 'form-control btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>

        $('.image').change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.image_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        })

    </script>
@endpush
