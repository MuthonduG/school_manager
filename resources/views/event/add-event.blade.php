@extends('layouts.master')

@section('content')
{!! Toastr::message() !!}

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add Event</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('event/list/page') }}">Events</a></li>
                        <li class="breadcrumb-item active">Add Event</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('event.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Event Details</span></h5>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group local-forms">
                                        <label>Event Name <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" name="event_name" required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group local-forms">
                                        <label>Club ID <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" name="club_id" required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group local-forms">
                                        <label>Organizer</label>
                                        <input type="text" class="form-control" name="organizer" placeholder="Optional">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group local-forms">
                                        <label>Description <span class="login-danger">*</span></label>
                                        <textarea class="form-control" name="description" rows="3" required></textarea>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group local-forms calendar-icon">
                                        <label>Event Date <span class="login-danger">*</span></label>
                                        <input type="date" class="form-control" name="event_date" required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-3">
                                    <div class="form-group local-forms">
                                        <label>Price <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" name="price" placeholder="e.g., Free or KES 100" required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-3">
                                    <div class="form-group local-forms">
                                        <label>RSVP Limit</label>
                                        <input type="number" class="form-control" name="rsvp_limit" placeholder="Leave blank for unlimited">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="rsvp_enabled" checked>
                                        <label class="form-check-label">Enable RSVP</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="student-submit mt-3">
                                        <button type="submit" class="btn btn-primary">Create Event</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div> <!-- card-body -->
                </div> <!-- card -->
            </div> <!-- col -->
        </div> <!-- row -->
    </div> <!-- container-fluid -->
</div> <!-- page-wrapper -->
@endsection
