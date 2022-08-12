<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Expense;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MonthlyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $from = Carbon::parse(sprintf(
            '%s-%s-01',
            $request->query('y', Carbon::now()->year),
            $request->query('m', Carbon::now()->month)
        ));

        $to = clone $from;
        $to->day =$to->daysInMonth;

        $month = $request->query('m', Carbon::now()->format('F'));
        $year = $from->year;
        $expenses = Expense::where('user_id',Auth::user()->id)->whereBetween('entry_date', [$from, $to])->orderBy('entry_date', 'desc')->paginate(10)->withQueryString();
        $report = Expense::where('user_id',Auth::user()->id)->whereBetween('entry_date', [$from, $to])->orderBy('entry_date', 'desc')->get();
        $pending = $report->where('status', 'PENDING')->sum('amount');
        $approve = $report->where('status', 'APPROVE')->sum('amount');
        $denied = $report->where('status', 'DENIED')->sum('amount');
        $totalExps = $report->sum('amount');

        return view('pages.report', [
            'expenses' => $expenses,
            'month' => $month,
            'year' => $year,
            'pending' => $pending,
            'approve' => $approve,
            'denied' => $denied,
            'totalExps' => $totalExps,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();
        
        if($request->file('receipt'))
        {
            $data['receipt'] = $request->file('receipt')->store('receipt');
        }

        $data['slug'] = Str::slug($request->name);
        
        Expense::create($data);

        return redirect()->route('monthly-report');
    }

    public function destroy( $id)
    {
        $item = Expense::findOrFail($id);
        Storage::delete($item->receipt);
        $item->delete();

        return redirect()->intended('/monthly-report');
    }
}
