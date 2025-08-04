@extends('layouts.master')

@section('content')
{!! Toastr::message() !!}
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Events</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Events</li>
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
                        <input type="text" class="form-control" placeholder="Search by Event ID ...">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Event Name ...">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Organizer ...">
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
                                    <h3 class="page-title">Events</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
                                    <a href="{{ route('event.store') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Event</a>
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
                                    <th>Event ID</th>
                                    <th>Name</th>
                                    <th>Organizer</th>
                                    <th>Date</th>
                                    <th>Attendees</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($events as $event)
                                <tr>
                                    <td>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>{{ $event->id }}</td>
                                    <td><h2><a>{{ $event->event_name }}</a></h2></td>
                                    <td>{{ $event->organizer }}</td>
                                    <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                                    <td>{{ $event->attendee_count }}</td>
                                    <td class="text-end">
                                        <div class="actions">
                                            <a href="{{ route('event.show', ['id' => $event->id]) }}" class="btn btn-sm bg-success-light me-2">
                                                <i class="feather-eye"></i>
                                            </a>
                                            <a href="{{ route('event.edit', ['id' => $event->id]) }}" class="btn btn-sm bg-danger-light">
                                                <i class="feather-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No events found.</td>
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
<!-- JS includes like DataTables or toastr scripts -->
@endsection

@endsection
