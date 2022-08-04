@extends('layouts.admin')

@section('title')
    Admin Dashboard
@endsection

@section('content')
    <section class="content_wrapper">
        <div class="container">
            <div class="row d-flex flex-column-reverse flex-md-row">
                <div class="col-12 col-md-6 overview_wrapper mt-3 m-md-0">
                    <h1>overview</h1>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="overview_item item-c1">
                        <div class="overview_inner">
                            <div class="icon">
                                <img src="/assets/images/icons/total.png" alt="">
                            </div>
                            <div class="text text-center">
                                <h2>Rp. {{ number_format($totalExps,0,"",".") }}</h2>
                                <span>total Expense</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="overview_item item-c2">
                        <div class="overview_inner">
                            <div class="icon">
                                <img src="/assets/images/icons/paid.png" alt="">
                            </div>
                            <div class="text text-center">
                                <h2>Rp. {{ number_format($approve,0,"",".") }}</h2>
                                <span>approve expense</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="overview_item item-c3">
                        <div class="overview_inner">
                            <div class="icon">
                                <img src="/assets/images/icons/expense.png" alt="">
                            </div>
                            <div class="text text-center">
                                <h2>Rp. {{ number_format($pending,0,"",".") }}</h2>
                                <span>pending expense</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="overview_item item-c4">
                        <div class="overview_inner">
                            <div class="icon">
                                <img src="/assets/images/icons/denied.png" alt="">
                            </div>
                            <div class="text text-center">
                                <h2>Rp. {{ number_format($denied,0,"",".") }}</h2>
                                <span>denied expense</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 overview_wrapper mt-3 m-md-0">
                    <h1>recent expense</h1>
                </div>
                <div class="col-12 col-md-6 add_wrapper">
                    <a class="btn btn-primary" href="{{ route('admin-report') }}">all expense</a>
                </div>
            </div>
            <div class="row mt-4 table-responsive">
                <div class="container">
                    <table class="table recent_expense_list text-center">
                        @if (count($rcExps) !== 0)
                        <thead>
                            <tr>
                                <th class="table-dark" scope="col">name</th>
                                <th class="table-dark" scope="col">date</th>
                                <th class="table-dark" scope="col">name</th>
                                <th class="table-dark" scope="col">price</th>
                                <th class="table-dark" scope="col">status</th>
                                <th class="table-dark" scope="col">reciept</th>
                                <th class="table-dark" scope="col">action</th>
                            </tr>
                        </thead>
                        @endif
                        <tbody>
                            @forelse ($rcExps as $rcExp)
                                <tr>
                                <td>{{ $rcExp->user->name }}</td>
                                <td>{{ $rcExp->entry_date }}</td>
                                <td>{{ $rcExp->name }}</td>
                                <td>Rp. {{ number_format($rcExp->amount,0,"",".") }}</td>
                                <td>{{ $rcExp->status }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ $rcExp->slug }}">
                                    Open
                                    </button>
                                    <div class="modal fade" id="{{ $rcExp->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">{{ $rcExp->name }} Receipt</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ asset("storage/" . $rcExp->receipt) }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="d-flex align-items-center justify-content-center">
                                    <button type="button" class="btn btn-success me-2" onClick="edit({{ $rcExp->id }})">Detail</button>
                                    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                    <button type="button" class="btn-close btn-edit" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <div class="container" id="editExps"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <p>There is no data</p>
                            @endforelse
                        </tbody>
                    </table>
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
            $.get("{{ url('admin/edit') }}/" + id, {}, function(data, status) {
                $("#exampleModalLabel").html('Update')
                $('#editExps').html(data);
                $('#exampleModal').modal('show');
            });
        }

        function update(id) {
            var remark = $("#remark").val();
            var status = $("#status").val()
             $.ajax({
                type: "get",
                url: "{{ url('admin/update') }}/" + id,
                data: "status=" + status + "&remark=" + remark,
                success: function(data) {
                    $(".btn-edit").click();
                    location.reload();
                }
            });
        }
    </script>
@endpush