

@extends('layouts.app')

@section('content')
<style>
    .table thead th {
        white-space: nowrap;   /* Prevents header text from wrapping */
    }
    .table td, .table th {
        vertical-align: middle; /* Center vertically */
    }
    .table td {
        max-width: 200px;      /* Limit column width */
        word-wrap: break-word; /* Wrap long content */
    }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="h4">Exhibitors</h2>
        {{-- <a href="{{ route('admin.exhibitor.create') }}" class="btn text-white" style="background-color: rgb(147 51 234)">
            Add Exhibitor
        </a> --}}
        <button 
            class="btn text-white" 
            style="background-color: rgb(147 51 234)" 
            onclick="openExhibitorModal()">
            Add Exhibitor
        </button>
    </div>

    @if($exhibitors->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="bg-dark text-white text-sm">
                    <tr>
                        <th>S.N</th>
                        <th>Exhibitor Name</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Website</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($exhibitors as $index => $exhibitor)
                        <tr>
                            <td>{{ $exhibitors->firstItem() + $index }}</td>
                            <td>{{ $exhibitor->name }}</td>
                            <td>{{ $exhibitor->title }}</td>
                            <td>{{ Str::words($exhibitor->description, 8, '...') }}</td>
                            <td>{{ $exhibitor->email }}</td>
                            <td>{{ $exhibitor->contact }}</td>
                            <td>{{ $exhibitor->website }}</td>
                            <td><img src="{{ asset($exhibitor->image) }}" alt="{{ $exhibitor->name }}" class="img-fluid" style="max-width: 100px;"></td>
                            <td>
                                <a href="{{ route('admin.exhibitor.edit', $exhibitor->id) }}" class="btn btn-sm btn-primary mb-1">Edit</a>
                                {{-- <form action="{{ route('admin.exhibitor.destroy', $exhibitor->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this exhibitor?')">Delete</button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
       <div class="d-flex justify-content-center mt-3">
            {{ $exhibitors->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-info">
            No exhibitors found.
        </div>
    @endif 
</div>
<!-- Exhibitor Selection Modal -->
<div id="exhibitorModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg p-6 w-96">
    <h2 class="text-lg font-semibold mb-4 text-center">Add Exhibitor</h2>

    <div class="flex items-center space-x-2">
      <!-- Exhibitor Type Select -->
      <select id="exhibitorTypeSelect"
              onchange="handleExhibitorTypeChange(this.value)"
              class="border rounded-md p-2 text-gray-700 w-full">
          <option value="">Select Exhibitor Type</option>
          <option value="member">Member</option>
          <option value="non_member">Non-Member</option>
      </select>
    </div>

    <!-- Hidden Member Dropdown -->
    <div class="mt-4">
      <select id="memberDropdown" 
              class="border rounded-md p-2 text-gray-700 hidden w-full"
              onchange="handleMemberSelect(this.value)" name="member_id">
          <option value="">Select Member</option>
          @foreach($members as $member)
              <option value="{{ $member->id }}">{{ $member->first_name }}</option>
          @endforeach
      </select>
    </div>

    <!-- Footer -->
    <div class="text-right mt-4">
      <button onclick="closeExhibitorModal()" class="text-sm text-gray-500 hover:text-gray-700">Cancel</button>
    </div>
  </div>
</div>

@endsection

 <script>
function openExhibitorModal() {
  const modal = document.getElementById('exhibitorModal');
  modal.classList.remove('hidden');
  modal.classList.add('flex');
}

function closeExhibitorModal() {
  const modal = document.getElementById('exhibitorModal');
  modal.classList.add('hidden');
  modal.classList.remove('flex');
}

function handleExhibitorTypeChange(value) {
  const memberDropdown = document.getElementById('memberDropdown');

  if (value === 'member') {
    memberDropdown.classList.remove('hidden');
  } else if (value === 'non_member') {
    memberDropdown.classList.add('hidden');
    window.location.href = "{{ route('admin.exhibitor.create') }}";
  } else {
    memberDropdown.classList.add('hidden');
  }
}

function handleMemberSelect(memberId) {
  if (memberId) {
   
    window.location.href = `/admin/exhibitors/create-from-member/${memberId}`;
  }
}
</script>                      

