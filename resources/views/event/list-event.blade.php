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
                        <li class="breadcrumb-item active">All Events</li>
                    </ul>
                </div>
                <div class="col-auto text-end ms-auto">
                    <a href="{{ route('event/add/page') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Event
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Event Table -->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Organizer</th>
                                        <th>Date</th>
                                        <th>Price</th>
                                        <th>RSVP Status</th>
                                        <th>Attendees</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($events as $event)
                                        <tr>
                                            <td>{{ $event->event_name }}</td>
                                            <td>{{ $event->organizer }}</td>
                                            <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                                            <td>
                                                {{ $event->price > 0 ? 'KSh ' . number_format($event->price) : 'Free' }}
                                            </td>
                                            <td>
                                                @if($event->rsvp_enabled)
                                                    <span class="badge bg-success">Open</span>
                                                @else
                                                    <span class="badge bg-danger">Closed</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $event->attendee_count ?? 0 }}/{{ $event->rsvp_limit ?? '∞' }}
                                            </td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="{{ route('event.show', $event->id) }}" class="btn btn-sm bg-success-light me-2" title="View Event">
                                                        <i class="feather-eye"></i>
                                                    </a>

                                                    <a href="{{ route('event.edit', $event->id) }}" class="btn btn-sm bg-warning-light me-2" title="Edit Event">
                                                        <i class="feather-edit"></i>
                                                    </a>

                                                    @if($event->rsvp_enabled)
                                                        @if(($event->attendee_count ?? 0) < ($event->rsvp_limit ?? PHP_INT_MAX))
                                                            <form action="{{ url('event/rsvp/' . $event->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm bg-info-light" title="RSVP Now">
                                                                    <i class="fas fa-calendar-check"></i> RSVP
                                                                </button>
                                                            </form>
                                                        @else
                                                            <span class="badge bg-secondary" title="RSVP Limit Reached">Full</span>
                                                        @endif
                                                    @else
                                                        <span class="badge bg-light text-dark" title="RSVP Closed">N/A</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">No events found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Event Table -->

    </div>
</div>
@endsection
