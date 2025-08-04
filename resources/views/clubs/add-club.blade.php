@extends('layouts.master')

@section('content')
{{-- message --}}
{!! Toastr::message() !!}

<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add Club</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="clubs.html">Clubs</a></li>
                        <li class="breadcrumb-item active">Add Club</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('club.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Club Details</span></h5>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Club ID <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" name="club_id" required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Club Name <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" name="club_name" required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Club Leader <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" name="club_leader" required>
                                    </div>
                                </div>

                                <!-- ✅ Updated date input -->
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms calendar-icon">
                                        <label>Founded Date <span class="login-danger">*</span></label>
                                        <input type="date" class="form-control" name="founded_date" value="{{ old('founded_date') }}" required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Number of Members <span class="login-danger">*</span></label>
                                        <input type="number" class="form-control" name="member_count" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Create Club</button>
                                    </div>
                                </div>

                            </div> <!-- row -->
                        </form>
                    </div> <!-- card-body -->
                </div> <!-- card -->
            </div> <!-- col -->
        </div> <!-- row -->
    </div> <!-- container-fluid -->
</div> <!-- page-wrapper -->

@endsection
