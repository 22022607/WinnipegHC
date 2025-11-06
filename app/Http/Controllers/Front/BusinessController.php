<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Category;
use App\Models\BusinessAppointment;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        $categories = [];
        $locations = [];

        $businesses = Business::get();

        // Apply filters
        $filtered = $businesses->filter(function($biz) use ($request) {
            $matchesSearch = !$request->search || str_contains(strtolower($biz['name']), strtolower($request->search)) 
                || str_contains(strtolower($biz['description']), strtolower($request->search));

            $matchesCategory = $request->category === 'all' || $biz['category'] === $request->category;
            $matchesLocation = $request->location === 'all' || $biz['location'] === $request->location;

            return $matchesSearch && $matchesCategory && $matchesLocation;
        });

        return view('front.business.index', [
            'businesses' => $businesses,
            'categories' => $categories,
            'locations' => $locations,
        ]);
    }

    public function show($id)
    {
        // show single business profile
    }
    public function details($id)
    {
        $business = Business::with('membershipUser')->find($id);
   
        return view('front.business.details', compact('business'));
    }
   
    public function businessCategory()
    {
        $categories = Category::select('id', 'name')->orderBy('id', 'asc')->get();
        return view ('front.business.category',compact('categories'));
    }
     public function bookAppointment(Request $request, $id)
    {
        // dd($id);
        try {
            $business = Business::findOrFail($id);

            // Validate form input
            $validated = $request->validate([
                // 'service'    => 'required|string|max:255',
                'date'       => 'required',
                'appointment_time'       => 'required|string',
                'firstName'  => 'required|string|max:255',
                // 'lastName'   => 'required|string|max:255',
                'email'      => 'required|email',
                'phone'      => 'required|string|max:20',
                'notes'      => 'nullable|string',
            ]);

            // Save booking
            BusinessAppointment::create([
                'business_id' => $business->id,
                'date'        => $validated['date'],
                'appointment_time'        => $validated['appointment_time'],
                'first_name'  => $validated['firstName'],
                'last_name'   => $request->last_name,
                'email'       => $validated['email'],
                'phone'       => $validated['phone'],
                'notes'       => $validated['notes'] ?? null,
                'status'      => 'pending',
            ]);

            return redirect()->back()->with('success', 'Appointment booked successfully! We will contact you soon.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            \Log::error('Booking failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);

            return redirect()->back()->with('error', 'Something went wrong while booking your appointment. Please try again.');
        }
    }
}

   

