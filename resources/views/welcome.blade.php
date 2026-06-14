<!DOCTYPE html>
<html>
<head>
    <title>Booking Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light">

<div class="container mt-5">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow p-4">

        <h2 class="text-center mb-4">
            Booking Management System
        </h2>

        <!-- Dashboard Cards -->
        <div class="row mb-4">

            <div class="col-md-4">
                <div class="card bg-primary text-white p-3">
                    <h5>Total Bookings</h5>
                    <h2>{{ $totalBookings }}</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-warning text-dark p-3">
                    <h5>Pending Bookings</h5>
                    <h2>{{ $pendingBookings }}</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-success text-white p-3">
                    <h5>Confirmed Bookings</h5>
                    <h2>{{ $confirmedBookings }}</h2>
                </div>
            </div>

        </div>

        <!-- Search -->
        <form method="GET" action="/" class="mb-4">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search by name or email">
        </form>

        <!-- Add Booking -->
        <form action="{{ route('bookings.store') }}" method="POST">

            @csrf

            <div class="row">

                <div class="col-md-4">
                    <input type="text"
                           name="customer_name"
                           class="form-control"
                           placeholder="Customer Name"
                           required>
                </div>

                <div class="col-md-4">
                    <input type="email"
                           name="email"
                           class="form-control"
                           placeholder="Email"
                           required>
                </div>

                <div class="col-md-3">
                    <input type="date"
                           name="booking_date"
                           class="form-control"
                           required>
                </div>

                <div class="col-md-1">
                    <button class="btn btn-primary">
                        Add
                    </button>
                </div>

            </div>

        </form>

        <hr>

        <!-- Booking Table -->
        <table class="table table-bordered table-striped">

            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
                <th>Status</th>
                <th width="300">Actions</th>
            </tr>
            </thead>

            <tbody>

            @foreach($bookings as $booking)

                <tr>

                    <form action="{{ route('bookings.update',$booking->id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <td>{{ $booking->id }}</td>

                        <td>
                            <input type="text"
                                   name="customer_name"
                                   value="{{ $booking->customer_name }}"
                                   class="form-control">
                        </td>

                        <td>
                            <input type="email"
                                   name="email"
                                   value="{{ $booking->email }}"
                                   class="form-control">
                        </td>

                        <td>
                            <input type="date"
                                   name="booking_date"
                                   value="{{ $booking->booking_date }}"
                                   class="form-control">
                        </td>

                        <td>

                            @if($booking->status == 'Pending')
                                <span class="badge bg-warning">
                                    Pending
                                </span>
                            @else
                                <span class="badge bg-success">
                                    Confirmed
                                </span>
                            @endif

                        </td>

                        <td>

                            <button class="btn btn-primary btn-sm">
                                Update
                            </button>

                    </form>

                    @if($booking->status == 'Pending')

                        <form action="{{ route('bookings.confirm',$booking->id) }}"
                              method="POST"
                              style="display:inline">

                            @csrf
                            @method('PATCH')

                            <button class="btn btn-success btn-sm">
                                Confirm
                            </button>

                        </form>

                    @endif

                    <form action="{{ route('bookings.destroy',$booking->id) }}"
                          method="POST"
                          style="display:inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm">
                            Delete
                        </button>

                    </form>

                        </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

</body>
</html>