 @php use Illuminate\Support\Str; @endphp


@extends('layouts.app')

@section('content')
<style>
    .table-light {
    --bs-table-color: #000;
    
}
</style>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="h4">Spotlight</h2>
       
    </div>

   @if($users_spotlight->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light text-white text-sm">
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Membership Type</th>
                        <th>Membership Date</th>
                        <th>Expiry Date</th>
                        <th>Spotlight Month</th>
                       

                    </tr>
                </thead>
                <tbody class="text-sm">
                     @foreach($users_spotlight as $key => $users)
                        <tr>
                            <td>{{ ++$key }}</td>
                           <td>{{ $users->user->first_name }} {{ @$users->user->last_name }}</td> 
                            <td>{{ $users->user->email }}</td> 
                            <td>{{ ucfirst($users->membership_type) }}</td>
                            <td>{{ date('Y-m-d',strtotime($users->start_date ?? '')) }}</td>
                            <td>{{ date('Y-m-d',strtotime($users->end_date ?? '')) }}</td>
                            <td>fd</td>
                         
                        </tr>
                    @endforeach
               
                </tbody>
            </table>
        </div>
        @else
        <p>No data Found</p>
        @endif
   
</div>
@endsection

