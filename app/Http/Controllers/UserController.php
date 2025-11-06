<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipUser;
use App\Models\MembershipPayment;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $users= MembershipUser::whereIn('status',['1','2'])->with('membership_details')->get();


        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function updateStatus(Request $request, $id)
    {
        $user = MembershipUser::findOrFail($id);
        $user->status = $request->status; // 1 = Enable, 2 = Disable
        $user->save();

        return response()->json(['success' => true]);
    }
    public function userSpotlight()
    {
        $users_spotlight=MembershipPayment::whereIn('membership_type',['spotlight','event_spotlight'])->with('user')->get();
        
        return view('user.spotlight',compact('users_spotlight'));
    }

}
