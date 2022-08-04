<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Expense;

class DashboardController extends Controller
{
    public function index() {
        $from = Carbon::parse(sprintf(
            '%s-%s-01',
            Carbon::now()->year,
            Carbon::now()->month
        ));

        $to = clone $from;
        $to->day =$to->daysInMonth;

        $expenses = Expense::whereBetween('entry_date', [$from, $to])->get();
        $pending = $expenses->where('status', 'PENDING')->sum('amount');
        $approve = $expenses->where('status', 'APPROVE')->sum('amount');
        $denied = $expenses->where('status', 'DENIED')->sum('amount');
        $totalExps = $expenses->sum('amount');
        $rcExps = Expense::whereBetween('entry_date', [$from, $to])->orderBy('entry_date', 'desc')->take(5)->get();
        
        return view('pages.Admin.dashboard',[
            'expenses' => $expenses,
            'pending' => $pending,
            'approve' => $approve,
            'denied' => $denied,
            'totalExps' => $totalExps,
            'rcExps' => $rcExps,
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
