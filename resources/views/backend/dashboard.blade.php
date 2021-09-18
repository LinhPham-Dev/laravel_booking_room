@extends('backend.layouts.master')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Dashboard</strong></h3>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Income</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">$47.482</h1>
                        <div class="mb-0">
                            <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> 3.65%
                            </span>
                            <span class="text-muted">Since last week</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Orders</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="shopping-bag"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">2.542</h1>
                        <div class="mb-0">
                            <span class="badge badge-danger-light"> <i class="mdi mdi-arrow-bottom-right"></i> -5.25%
                            </span>
                            <span class="text-muted">Since last week</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Activity</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="activity"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">16.300</h1>
                        <div class="mb-0">
                            <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> 4.65%
                            </span>
                            <span class="text-muted">Since last week</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Revenue</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">$20.120</h1>
                        <div class="mb-0">
                            <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> 2.35%
                            </span>
                            <span class="text-muted">Since last week</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid p-0">

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"><strong>Reservation List</strong></h1>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">User booking room</h5>
                </div>
                <div class="card-body">
                    <div id="fullcalendar"></div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('script-option')

<script src="{{ asset('assets/backend') }}/js/fullcalendar.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
            var calendarEl = document.getElementById("fullcalendar");
            var calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: "Materia",
                initialView: "dayGridMonth",
                initialDate: "2021-07-07",
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay"
                },
                events: [{
                        title: "All Day Event",
                        start: "2021-07-01"
                    },
                    {
                        title: "Long Event",
                        start: "2021-07-07",
                        end: "2021-07-10"
                    },
                    {
                        groupId: "999",
                        title: "Repeating Event",
                        start: "2021-07-09T16:00:00"
                    },
                    {
                        groupId: "999",
                        title: "Repeating Event",
                        start: "2021-07-16T16:00:00"
                    },
                    {
                        title: "Conference",
                        start: "2021-07-11",
                        end: "2021-07-13"
                    },
                    {
                        title: "Conference demo",
                        start: "2021-07-11T10:30:00",
                        end: "2021-07-12T12:30:00"
                    },
                    {
                        title: "Meeting",
                        start: "2021-07-12T10:30:00",
                        end: "2021-07-12T12:30:00"
                    },
                    {
                        title: "Lunch",
                        start: "2021-07-12T12:00:00"
                    },
                    {
                        title: "Meeting",
                        start: "2021-07-12T14:30:00"
                    },
                    {
                        title: "Birthday Party",
                        start: "2021-07-13T07:00:00"
                    },
                    {
                        title: "Click for Google",
                        url: "http://google.com/",
                        start: "2021-07-28"
                    }
                ]
            });
            setTimeout(function() {
                calendar.render();
            }, 250)
        });
</script>

@endsection
