@extends('layouts.master')

@section('content')
{!! Toastr::message() !!}
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Clubs</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Clubs</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Search Filters -->
        <div class="student-group-form">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Club ID ...">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Club Name ...">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Leader ...">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="search-student-btn">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Search Filters -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">

                        <!-- Table Header -->
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Clubs</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
                                    <a href="{{ route('club.store') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Club</a>
                                </div>
                            </div>
                        </div>
                        <!-- /Table Header -->

                        <table class="table border-0 table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </th>
                                    <th>Club ID</th>
                                    <th>Name</th>
                                    <th>Leader</th>
                                    <th>Founded</th>
                                    <th>Member Limit</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($clubs as $club)
                                <tr>
                                    <td>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>{{ $club->club_id }}</td>
                                    <td><h2><a>{{ $club->club_name }}</a></h2></td>
                                    <td>{{ $club->club_leader }}</td>
                                    <td>{{ \Carbon\Carbon::parse($club->founded_date)->format('Y') }}</td>
                                    <td>{{ $club->member_count }}</td>
                                    <td class="text-end">
                                        <div class="actions d-flex flex-row gap-4">
                                            <!-- View -->
                                            <a href="#" class="btn btn-sm bg-success-light">
                                                <i class="feather-eye"></i>
                                            </a>
                                            <!-- Edit -->
                                            <a href="{{ route('club/edit/page', ['id' => $club->id]) }}" class="btn btn-sm bg-danger-light">
                                                <i class="feather-edit"></i>
                                            </a>
                                            <!-- Join -->
                                            <form action="{{ route('club.join', $club->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm bg-info-light w-100 mt-1">
                                                    <i class="fas fa-user-plus"></i> Join
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No clubs found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
<!-- You can include JS for DataTables or toastr here -->
@endsection

@endsection
