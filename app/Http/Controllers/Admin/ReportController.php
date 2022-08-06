<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class ReportController extends Controller
{
    public function index(Request $request) {
        $from = Carbon::parse(sprintf(
            '%s-%s-01',
            $request->query('y', Carbon::now()->year),
            $request->query('m', Carbon::now()->month)
        ));

        $to = clone $from;
        $to->day =$to->daysInMonth;

        $month = $request->query('m', Carbon::now()->format('F'));
        $year = $from->year;
        
        $users = User::get();

        if($request->query('u') === null) {
            $expenses = Expense::whereBetween('entry_date', [$from, $to])->orderBy('entry_date', 'desc')->paginate(5)->withQueryString();
        } else {
            $expenses = Expense::where('user_id', $request->query('u'))->whereBetween('entry_date', [$from, $to])->orderBy('entry_date', 'desc')->paginate(5)->withQueryString();
        }

        if($request->query('u') === null) {
            $reports = Expense::whereBetween('entry_date', [$from, $to])->orderBy('entry_date', 'desc')->get();
        } else {
            $reports = Expense::where('user_id', $request->query('u'))->whereBetween('entry_date', [$from, $to])->orderBy('entry_date', 'desc')->get();
        }

        $pending = $expenses->where('status', 'PENDING')->sum('amount');
        $approve = $expenses->where('status', 'APPROVE')->sum('amount');
        $denied = $expenses->where('status', 'DENIED')->sum('amount');
        $totalExps = $expenses->sum('amount');

        return view('pages.Admin.report', [
            'expenses' => $expenses,
            'month' => $month,
            'year' => $year,
            'users'=> $users,
            'pending' => $pending,
            'approve' => $approve,
            'denied' => $denied,
            'totalExps' => $totalExps,
            'reports' => $reports
        ]);
    }

    public function edit($id)
    {
        $data = Expense::findOrFail($id);
        return view('pages.Admin.edit', [
            'data' => $data
        ]);
    }

    public function update(Request $request, $id) {
        $data = Expense::findOrFail($id);
        $data->status = $request->status;
        $data->remark = $request->remark;
        $data->save();
        return redirect()->intended('/admin/monthly-report');
    }
}
