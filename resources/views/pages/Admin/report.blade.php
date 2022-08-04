@extends('layouts.admin')

@section('title')
    Monthly Report
@endsection

@section('content')
    <section class="content_wrapper">
        <div class="container">
            <div class="row d-flex flex-column-reverse flex-md-row">
                <div class="col-12 col-md-6 overview_wrapper mt-3 m-md-0">
                    <h1>{{$month }} {{ $year }} Report</h1>                
                </div>
            </div>
            <div class="row mt-4">
                <form  method="get">
                    <div class="row">
                        <div class="col-xs-1 col-md-4 form-group">
                            <label for="year">Year</label>
                            @php
                                $years = collect(range(3, 0))->map(function ($item) {
                                return (string) date('Y') - $item;
                            });
                                $months = cal_info(0)['months'];
                            @endphp
                            <select name="y" class="form-select" id="y" required>
                                <option value="" selected>Select Year</option>
                            @foreach($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-xs-2 col-md-4 form-group">
                            <label for="month">Month</label>
                            <select name="m" class="form-select" id="y" required>
                                <option value="" selected>Select Month</option>
                            @foreach($months as $month)
                                <option value="{{ $month }}">{{ $month }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-xs-2 col-md-4 form-group">
                            <label for="month">User</label>
                            <select name="u" class="form-select" id="y" required>
                                <option value="" selected>Select User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-xs-4 col-md-4">
                            <label class="control-label">&nbsp;</label><br>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row mt-4 table-responsive">
                <div class="container">
                    <table class="table recent_expense_list text-center">
                        @if (count($expenses) !== 0)
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
                            @forelse ($expenses as $expense)
                                <tr>
                                <td>{{ $expense->user->name }}</td>
                                <td>{{ $expense->entry_date }}</td>
                                <td>{{ $expense->name }}</td>
                                <td>Rp. {{ number_format($expense->amount,0,"",".") }}</td>
                                <td>{{ $expense->status }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ $expense->slug }}">
                                    Open
                                    </button>
                                    <div class="modal fade" id="{{ $expense->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">{{ $expense->name }} Receipt</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ asset("storage/" . $expense->receipt) }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="d-flex align-items-center justify-content-center">
                                     <button type="button" class="btn btn-success me-2" onClick="edit({{ $expense->id }})">Detail</button>
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
            <div class="row">
                <div class="col-12">
                        {{ $expenses->links() }}
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