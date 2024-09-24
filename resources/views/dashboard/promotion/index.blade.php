@extends('layouts.dashboardlayout')
@section('title', 'Promotions')
@section('breadcrumb1', 'Promotion Management')
@section('breadcrumb', 'Promotions')
@section('pageTitle', 'Promotions')
@section('content')
<style>
    tr {
        vertical-align: middle;
    }
</style>

<div class="container">
    <div class="mb-3">
        <!-- Large modal Button-->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">Add
            Promotion</button>
        <button type="button" class="btn btn-primary ms-1" data-bs-toggle="modal" data-bs-target="#chatModal">Create
            Promotion</button>
    </div>

    <!-- Suppliers Table -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Success - </strong> {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
            aria-label="Close"></button>
        <strong>Error - </strong> {{ session('error') }}
    </div>
    @endif

    <div class="table-responsive">
        <table id="promotionTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Details</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($promotions as $promotion)
                <tr>
                    <td>{{ $promotion->name }}</td>
                    <td>
                        @if ($promotion->image)
                        <img src="{{ asset('storage/promotionsImages/' . $promotion->image) }}"
                            alt="{{ $promotion->name }}" style="width:90%; height:80px; object-fit:cover; object-position:center;">
                        @endif

                    </td>
                    <td>{{ $promotion->details }}</td>
                    <td>{{ $promotion->start_date }}</td>
                    <td>{{ $promotion->end_date }}</td>
                    <td>
                        <a href="{{ route('promotions.edit', $promotion->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal Trigger -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chatModal">
        Open Chat
    </button>



</div>

{{-- Create Modal --}}
<div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Promotion</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('promotions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="details" class="form-label">Details</label>
                        <textarea id="details" name="details" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Promotion</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal -->
<div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chatModalLabel">Chat with AI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="chat-box">
                    <!-- Chat responses will appear here -->
                </div>
                <textarea id="user-input" class="form-control" placeholder="Type your message"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="send-btn">Send</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#promotionTable').DataTable({
            // DataTables configuration
            paging: true, // Enable pagination
            searching: true, // Enable search
            ordering: true, // Enable sorting
            lengthChange: false, // Disable page length change
            info: true, // Show table information
            pageLength: 15,
            language: {
                searchPlaceholder: "Search records...", // Placeholder text for search
                paginate: {
                    previous: "Prev",
                    next: "Next"
                },
                info: "Showing _START_ to _END_ of _TOTAL_ entries", // Info text
                infoEmpty: "No entries found", // Info text when no entries
                infoFiltered: "(filtered from _MAX_ total entries)"
            }
        });
    });
</script>
<script>
    document.getElementById('send-btn').addEventListener('click', async function() {
        const userInput = document.getElementById('user-input').value;
        if (userInput.trim() === '') return;

        const chatBox = document.getElementById('chat-box');

        chatBox.innerHTML += `<div><strong>You:</strong> ${userInput}</div>`;
        document.getElementById('user-input').value = '';

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const response = await fetch('/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    message: userInput
                })
            });

            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                const data = await response.json();
                chatBox.innerHTML += `<div><strong>AI:</strong> ${data.reply}</div>`;
            } else {
                const text = await response.text();
                chatBox.innerHTML += `<div><strong>Error:</strong> ${text}</div>`;
            }
        } catch (error) {
            console.error('Error:', error);
            chatBox.innerHTML += `<div><strong>Error:</strong> Something went wrong.</div>`;
        }
    });
</script>
@endpush