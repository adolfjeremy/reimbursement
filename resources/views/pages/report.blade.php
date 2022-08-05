@extends('layouts.dashboard')

@section('title')
    Monthly Report
@endsection

@section('content')
    <section class="content_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 overview_wrapper mt-3 m-md-0">
                    <h1>{{$month }} {{ $year }} Report</h1>
                </div>
            </div>
            <div class="row">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Expense</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('monthly-report-store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Name:</label>
                                        <input name="name" type="text" class="form-control" id="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="amount" class="col-form-label">Price:</label>
                                        <input name="amount" type="number" class="form-control" id="amount" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="entry_date" class="col-form-label">Date:</label>
                                        <input name="entry_date" type="date" class="form-control" id="entry_date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="receipt" class="col-form-label">Receipt:</label>
                                        <input name="receipt" type="file" class="form-control" id="receipt" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="col-form-label">Description:</label>
                                        <textarea name="description" class="form-control" id="description"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
                                <img src="/assets/images/icons/approve.png" alt="">
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
                            <select name="y" class="form-select" id="y">
                            @foreach($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-xs-2 col-md-4 form-group">
                            <label for="month">Month</label>
                            <select name="m" class="form-select" id="y">
                            @foreach($months as $month)
                                    <option value="{{ $month }}">{{ $month }}</option>
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
                                    <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#{{ $expense->slug }}-detail">
                                        Detail
                                    </button>
                                    <div class="modal fade" id="{{ $expense->slug }}-detail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">{{ $expense->name }} Detail</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-4 fw-bold">Name</div>
                                                            <div class="col-8">{{ $expense->name }}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4 fw-bold">Date</div>
                                                            <div class="col-8">{{ $expense->entry_date }}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4 fw-bold">Price</div>
                                                            <div class="col-8">Rp. {{ number_format($expense->amount,0,"",".") }}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4 fw-bold">Status</div>
                                                            <div class="col-8">{{ $expense->status }}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4 fw-bold">Description</div>
                                                            <div class="col-8">
                                                                @if ($expense->description ===null)
                                                                    none
                                                                @else
                                                                    {{ $expense->description}}
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4 fw-bold">Remark</div>
                                                            <div class="col-8">
                                                                @if ($expense->remark ==null)
                                                                    none
                                                                @else
                                                                    {{ $expense->remark }}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{route('monthly-report-destroy', $expense->id)}}" class="btn btn-danger">Delete</a>
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
                {{ $expenses->links() }}
            </div>
        </div>
    </section>
@endsection
