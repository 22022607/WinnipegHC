

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
        <h2 class="h4">Presenters</h2>
   
              <button 
            class="btn text-white" 
            style="background-color: rgb(147 51 234)" 
            onclick="openPresenterModal()">
            Add Presenter
        </button>
    </div>

    @if($presenters->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="bg-dark text-white text-sm">
                    <tr>
                        <th>S.N</th>
                        <th>Presenter Name</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Website</th>
                        <th>Timeslot</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($presenters as $index => $presenter)
                        <tr>
                            <td>{{ $presenters->firstItem() + $index }}</td>
                            <td>{{ $presenter->name }}</td>
                            <td>{{ $presenter->title }}</td>
                            <td>{{ Str::words($presenter->description, 8, '...') }}</td>
                            <td>{{ $presenter->email }}</td>
                            <td>{{ $presenter->contact }}</td>
                            <td>{{ $presenter->website }}</td>
                            <td>{{ $presenter->timeslot }}</td>
                            <td><img src="{{ asset($presenter->image) }}" alt="{{ $presenter->name }}" class="img-fluid" style="max-width: 100px;"></td>
                            <td>
                              <a href="{{ route('admin.presenter.edit', $presenter->id) }}" class="btn btn-sm btn-primary mb-1">Edit</a>
                            </td>
                        </tr>
                    @endforeach

        <!-- Pagination -->
       <div class="d-flex justify-content-center mt-3">
            {{ $presenters->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-info">
            No presenters found.
        </div>
    @endif 
</div>
<div id="openPresenterModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg p-6 w-96">
    <h2 class="text-lg font-semibold mb-4 text-center">Add Presenter</h2>

    <div class="flex items-center space-x-2">
      <!-- Presenter Type Select -->
      <select id="presenterTypeSelect"
              onchange="handlePresenterTypeChange(this.value)"
              class="border rounded-md p-2 text-gray-700 w-full">
          <option value="">Select Presenter Type</option>
          <option value="member">Member</option>
          <option value="non_member">Non-Member</option>
      </select>
    </div>

    <!-- Hidden Member Dropdown -->
    <div class="mt-4">
      <select id="memberDropdown" 
              class="border rounded-md p-2 text-gray-700 hidden w-full"
              onchange="handleMemberSelect(this.value)">
          <option value="">Select Member</option>
          @foreach($members as $member)
              <option value="{{ $member->id }}">{{ $member->first_name }}</option>
          @endforeach
      </select>
    </div>

    <!-- Footer -->
    <div class="text-right mt-4">
      <button onclick="closePresenterModal()" class="text-sm text-gray-500 hover:text-gray-700">Cancel</button>
    </div>
  </div>
</div>

@endsection

      <script>
function openPresenterModal() {
  const modal = document.getElementById('openPresenterModal');
  modal.classList.remove('hidden');
  modal.classList.add('flex');
}

function closePresenterModal() {
  const modal = document.getElementById('openPresenterModal');
  modal.classList.add('hidden');
  modal.classList.remove('flex');
}

function handlePresenterTypeChange(value) {
  const memberDropdown = document.getElementById('memberDropdown');

  if (value === 'member') {
    memberDropdown.classList.remove('hidden');
  } else if (value === 'non_member') {
    memberDropdown.classList.add('hidden');
    window.location.href = "{{ route('admin.presenter.create') }}";
  } else {
    memberDropdown.classList.add('hidden');
  }
}

function handleMemberSelect(memberId) {
  if (memberId) {

    window.location.href = `/admin/presenters/create-from-member/${memberId}`;
  }
}
</script>                      

