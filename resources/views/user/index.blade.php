 @php use Illuminate\Support\Str; @endphp


@extends('layouts.app')

@section('content')
<style>
    .table-light {
    --bs-table-color: #000;
    
}
</style>
<div class="container mt-4" >
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
                        <th>Membership Type</th>
                        <th>Membership Date</th>
                        <th>Expiry Date</th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody class="text-sm">
                     @foreach($users as $key => $user)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $user->first_name }} {{ @$user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->membership_type) }}</td>
                            <td>{{ date('Y-m-d',strtotime($user->membership_details->start_date ?? '')) }}</td>
                            <td>{{ date('Y-m-d',strtotime($user->membership_details->next_payment_date ?? '')) }}</td>
                            <td>
                                <!-- HTML (Blade Template) -->
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input 
                                    type="checkbox"
                                    data-id="{{ $user->id }}"
                                    
                                    class="user-status-toggle sr-only peer"
                                    {{ $user->status == 1 ? 'checked' : '' }}
                                >
                                <div
                                    class="w-14 h-8 bg-gray-300 peer-focus:outline-none rounded-full peer
                                        peer-checked:after:translate-x-6 peer-checked:after:border-white
                                        after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                        after:bg-white after:border-gray-300 after:border after:rounded-full
                                        after:h-7 after:w-7 after:transition-all
                                        peer-checked:bg-blue-600">
                                </div>
                            </label>


                            </td>
                         
                        </tr>
                    @endforeach
               
                </tbody>
            </table>
        </div>
   
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
   

 $(function() {

    $('.user-status-toggle').change(function() {
        var status = $(this).prop('checked') ? 1 : 2; 

        var user_id = $(this).data('id'); 

         

        $.ajax({

            type: "POST",

            dataType: "json",
             
            url: '/admin/user/status/' + user_id,


            data: {  _token: '{{ csrf_token() }}','status': status, 'user_id': user_id},

            success: function(data){
                if (data.success) {
                    alert('User status updated successfully');
                } else {
                    alert('Update failed!');
                }

            }

        });

    })

  })
</script>

