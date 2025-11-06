

@extends('layouts.app')

@section('content')
<style>
    .table-light {
    --bs-table-color: #000;
    
}
</style>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="h4">Leads Management</h2>
       
    </div>

   
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light text-white text-sm">
                    <tr>
                        <th>S.N</th>
                        <th>Email</th>
                        <th>Date</th>
                     

                    </tr>
                </thead>
                <tbody class="text-sm">
                     @foreach($leads as $key => $lead)
                        <tr>
                            <td>{{ ++$key }}</td>
                            
                            <td>{{ $lead->email }}</td>
                            <td>{{ date('Y-m-d',strtotime($lead->created_at)) }}</td>
                         
                        </tr>
                    @endforeach
               
                </tbody>
            </table>
        </div>
   
</div>
@endsection
