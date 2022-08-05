<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Expense;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpenseRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index() {
        $from = Carbon::parse(sprintf(
            '%s-%s-01',
            Carbon::now()->year,
            Carbon::now()->month
        ));

        $month =Carbon::now()->format('F');
        $year = $from->year;

        $to = clone $from;
        $to->day =$to->daysInMonth;

        $rcExps = Expense::where('user_id',Auth::user()->id)->whereBetween('entry_date', [$from, $to])->orderBy('entry_date', 'desc')->take(5)->get();
        $expenses = Expense::where('user_id',Auth::user()->id)->whereBetween('entry_date', [$from, $to])->latest()->take(5)->get();
        $pending = $expenses->where('status', 'PENDING')->sum('amount');
        $approve = $expenses->where('status', 'APPROVE')->sum('amount');
        $denied = $expenses->where('status', 'DENIED')->sum('amount');
        $totalExps = $expenses->sum('amount');
        
        return view('pages.dashboard',[
            'rcExps' => $rcExps,
            'expenses' => $expenses,
            'pending' => $pending,
            'approve' => $approve,
            'denied' => $denied,
            'totalExps' => $totalExps,
            'month' => $month,
            'year' => $year
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

        return redirect()->route('dashboard');
    }

    public function destroy( $id)
    {
        $item = Expense::findOrFail($id);
        Storage::delete($item->receipt);
        $item->delete();

        return redirect()->intended('/');
    }
}
