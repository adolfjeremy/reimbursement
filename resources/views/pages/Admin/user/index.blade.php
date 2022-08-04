@extends('layouts.admin')

@section('title')
    Monthly Report
@endsection

@section('content')
    <section class="content_wrapper">
        <div class="container">
            <div class="row d-flex flex-column-reverse flex-md-row">
                <div class="col-12 col-md-6 overview_wrapper mt-3 m-md-0">
                    <h1>User List</h1>
                </div>
            </div>
            <div class="row mt-4 table-responsive">
                <div class="container">
                    <table class="table recent_expense_list text-center">
                        <thead>
                            <tr>
                                <th class="table-dark" scope="col">name</th>
                                <th class="table-dark" scope="col">email</th>
                                <th class="table-dark" scope="col">roles</th>
                                <th class="table-dark" scope="col" colspan="2">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles }}</td>
                                <td colspan="2" class="d-flex align-items-center justify-content-center">
                                     <button type="button" class="btn btn-primary text-light me-2" onClick="edit({{ $user->id }})">Role</button>
                                     <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content" id="editUser">
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{ route('delete-user', $user->id) }}" method="get">
                                        @csrf
                                        <button type="submit" class="btn btn-danger text-light">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                
                            @endforelse
                        </tbody>
                    </table>
                    <div class="row">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('ajax')
    <script>
        $(document).ready(function() {
            
            
        });
        function edit(id) {
            $.get("{{ url('admin/user-list/edit') }}/" + id, {}, function(data, status) {
                $('#editUser').html(data);
                $('#exampleModal').modal('show');
            });
        }

        function update(id) {
            var roles = $("#roles").val();
             $.ajax({
                type: "get",
                url: "{{ url('admin/user-list/update') }}/" + id,
                data: "roles=" + roles,
                success: function(data) {
                    $(".btn-edit").click();
                    location.reload();
                }
            });
        }
    </script>
@endpush