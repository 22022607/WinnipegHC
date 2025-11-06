<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventFestival;
use App\Models\Presenter;
use App\Models\Exhibitor;
use App\Models\MembershipUser;
use App\Models\Order;

class FestivalController extends Controller
{
    public function festival()
    {
        $festivals = EventFestival::paginate(10);
        return view('festival.index', compact('festivals'));
    }
    public function create(Request $request)
    {

        return view('festival.create');
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'host' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'facebook' => 'nullable|url|max:255',
            'admission_fee' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:2048', 
            'website' => 'nullable|url|max:255',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'total_seats' => 'nullable|integer|min:0',
        ]);

         if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

           
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/festival_images';

          
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

           
            $file->move($destinationPath, $filename);

            $validatedData['image'] = 'festival_images/' . $filename;
        }
        EventFestival::create($validatedData);

        return redirect()->route('admin.festival')->with('success', 'Festival event created successfully!');
    }
    public function edit(Request $request, $id)
    {
        $festival = EventFestival::findOrFail($id);
        return view('festival.edit', compact('festival'));
    }
    public function update(Request $request, $id)
    {
        $festival = EventFestival::findOrFail($id);
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'host' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'facebook' => 'nullable',
            'admission_fee' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'website' => 'nullable|url|max:255',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'total_seats' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/festival_images';

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);

            $validatedData['image'] = 'festival_images/' . $filename;
        }

        $festival->update($validatedData);

        return redirect()->route('admin.festival')->with('success', 'Festival event updated successfully!');
    }
    public function presenters()
    {
        $presenterMemberIds = Presenter::pluck('member_id')->toArray();
        $members = MembershipUser::whereNotIn('id', $presenterMemberIds)->get();
        $presenters = Presenter::paginate(10);
        return view('presenters.index', compact('presenters', 'members'));
    }
    public function createPresenter(Request $request)
    {
        return view('presenters.create');
    }
    public function storePresenter(Request $request)
    {
       $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'image' => 'nullable|image|max:2048', 
            'website' => 'nullable|url|max:255',
            'timeslot' => 'nullable|date_format:H:i',
            
        ]);

         if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

           
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/presenter_images';

          
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

           
            $file->move($destinationPath, $filename);

            $validatedData['image'] = 'presenter_images/' . $filename;
        }
        Presenter::create($validatedData);

        return redirect()->route('admin.presenter')->with('success', 'Presenter  created successfully!');
    }
    public function exhibitors(Request $request)
    {
        $exhibitorMemberIds = Exhibitor::pluck('member_id')->toArray();
        $members = MembershipUser::whereNotIn('id', $exhibitorMemberIds)->get();
        $exhibitors = Exhibitor::paginate(10);
        return view('exhibitors.index', compact('exhibitors', 'members'));
    }
    public function createExhibitor()
    {
        return view('exhibitors.create');
    }
    public function storeExhibitor(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'image' => 'nullable|image|max:2048', 
            'website' => 'nullable|url|max:255',
            
        ]);

         if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

           $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/exhibitor_images';

           if (!file_exists($destinationPath)) {
               mkdir($destinationPath, 0755, true);
           }

           
            $file->move($destinationPath, $filename);

            $validatedData['image'] = 'exhibitor_images/' . $filename;
        }
        Exhibitor::create($validatedData);

        return redirect()->route('admin.exhibitor')->with('success', 'Exhibitor created successfully!');
    }
    public function createExhibitorFromMember($id)
    {
       
        $member = MembershipUser::findOrFail($id);
        $existing = Exhibitor::where('email', $member->email)->first();
        if ($existing) {
            return redirect()->route('admin.exhibitor')
                            ->with('info', 'This member is already added as an exhibitor.');
        }

       
        Exhibitor::create([
            'name' => trim($member->first_name . ' ' . ($member->last_name ?? '')),
            'contact' => $member->phone ?? null,
            'member_id' => $member->id,
            'email' => $member->email ?? null,
        ]);

        return redirect()->route('admin.exhibitor')
                        ->with('success', 'Exhibitor created successfully from member!');
    }
     public function createPresenterFromMember($id)
    {
       
        $member = MembershipUser::findOrFail($id);
        $existing = Presenter::where('email', $member->email)->first();
        if ($existing) {
            return redirect()->route('admin.presenter')
                            ->with('info', 'This member is already added as a presenter.');
        }

       
        Presenter::create([
            'name' => trim($member->first_name . ' ' . ($member->last_name ?? '')),
            'contact' => $member->phone ?? null,
            'member_id' => $member->id,
            'email' => $member->email ?? null,
        ]);

        return redirect()->route('admin.presenter')
                        ->with('success', 'Presenter created successfully from member!');
    }
    public function editExhibitor(Request $request, $id)
    {
        $exhibitor = Exhibitor::findOrFail($id);
        return view('exhibitors.edit', compact('exhibitor'));
    }
    public function updateExhibitor(Request $request, $id)
    {
        $exhibitor = Exhibitor::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'image' => 'nullable|image|max:2048', 
            'website' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/exhibitor_images';

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);

            $validatedData['image'] = 'exhibitor_images/' . $filename;
        }

        $exhibitor->update($validatedData);

        return redirect()->route('admin.exhibitor')->with('success', 'Exhibitor updated successfully!');
    }
     public function editPresenter(Request $request, $id)
    {
        $presenter = Presenter::findOrFail($id);
        return view('presenters.edit', compact('presenter'));
    }
    public function updatePresenter(Request $request, $id)
    {
        $presenter = Presenter::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'image' => 'nullable|image|max:2048', 
            'website' => 'nullable|url|max:255',
            'timeslot' => 'nullable|date_format:H:i',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/presenter_images';

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);

            $validatedData['image'] = 'presenter_images/' . $filename;
        }

        $presenter->update($validatedData);

        return redirect()->route('admin.presenter')->with('success', 'Presenter updated successfully!');
    }
     public function festivalBookedTickets()
    {
        $bookedTickets = Order::where(['type' => 'festival_ticket', 'status' => 'paid'])->get();
        // dd($bookedTickets);
        return view('festival.booked_ticket', compact('bookedTickets'));
    }
        public function festivalTransactions()
    {
        $transactions = Order::with('exhibitor')->whereIn('type', ['festival_ticket','exhibitor_table'])->get();
        return view('festival.transactions', compact('transactions'));
    }
}