<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $bookings = Booking::where('customer_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->get();

        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'Pending')->count();
        $confirmedBookings = Booking::where('status', 'Confirmed')->count();

        return view('welcome', compact(
            'bookings',
            'totalBookings',
            'pendingBookings',
            'confirmedBookings'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'email' => 'required|email',
            'booking_date' => 'required'
        ]);

        Booking::create([
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'booking_date' => $request->booking_date,
            'status' => 'Pending'
        ]);

        return redirect('/')
            ->with('success', 'Booking Added Successfully!');
    }

    public function update(Request $request, Booking $booking)
    {
        $booking->update([
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'booking_date' => $request->booking_date
        ]);

        return redirect('/')
            ->with('success', 'Booking Updated Successfully!');
    }

    public function confirm(Booking $booking)
    {
        $booking->update([
            'status' => 'Confirmed'
        ]);

        return redirect('/')
            ->with('success', 'Booking Confirmed Successfully!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect('/')
            ->with('success', 'Booking Deleted Successfully!');
    }
}