 @php use Illuminate\Support\Str; @endphp


@extends('layouts.app')

@section('content')
<style>
    .table-light {
    --bs-table-color: #000;
    
}
</style>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">User Management</h2>
       
    </div>

   
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light text-white text-sm">
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Membership</th>
                        <th>Membership Date</th>

                    </tr>
                </thead>
                <tbody class="text-sm">
                     @foreach($users as $key => $user)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $user->first_name }} {{ @$user->first_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ strtoupper($user->membership_type) }}</td>
                            <td>{{ date('Y-m-d',strtotime($user->created_at)) }}</td>
                         
                        </tr>
                    @endforeach
               
                </tbody>
            </table>
        </div>
   
</div>
@endsection
