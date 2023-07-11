@extends('layouts.app')

@section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SUPER ADMIN-->
                @if($role=='super-admin')
                @include('dashboard.admin')
                @endif

                @if($role=='user')
                    @include('dashboard.user')
                @endif
                @if($role=='student')
                    @include('dashboard.student')
                @endif

                @if($role=='lecturer')
                    @include('dashboard.lecturer')
                @endif

            </div>
        </section>
        <!-- /.content -->

@endsection
