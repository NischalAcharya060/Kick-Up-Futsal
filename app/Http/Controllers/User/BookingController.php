<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $facilities = Facility::all();

        return view('user.booking.index', compact('facilities'));
    }

    public function show($facilityId)
    {
        $facility = Facility::findOrFail($facilityId);
        $availableTimeSlots = $this->getAvailableTimeSlots($facility);

        return view('user.booking.show', compact('facility', 'availableTimeSlots'));
    }

    private function getAvailableTimeSlots($facility)
    {
        // Implement logic to get available time slots based on facility's opening and closing times
        // This can include querying existing bookings and determining available time slots

        // For simplicity, let's assume all time slots are available
        return ['09:00', '10:00', '11:00', '12:00', '13:00'];
    }

    public function book(Request $request, $facilityId)
    {
        $facility = Facility::findOrFail($facilityId);

        // Check if the facility is available for booking
        if (!$this->isFacilityAvailable($facility, $request->input('bookingTime'))) {
            return redirect()->route('user.booking.show', ['facilityId' => $facility->id])->with('error', 'Facility not available for booking at the selected time.');
        }

        // Create a new Booking model instance and save it to the database
        $booking = new Booking([
            'user_id' => auth()->id(), // Assuming the user is authenticated
            'facility_id' => $facility->id,
            'booking_date' => now()->toDateString(),
            'booking_time' => $request->input('bookingTime'),
        ]);

        $booking->save();

        // Redirect back to the facility page or a confirmation page
        return redirect()->route('user.booking.show', ['facilityId' => $facility->id])->with('success', 'Booking successful!');
    }

    private function isFacilityAvailable($facility, $selectedTime)
    {
        // Implement your logic to check if the facility is available for booking at the selected time
        // This can include checking existing bookings and determining availability

        // For simplicity, let's assume all time slots are available
        return true;
    }


}
