<table id="ExportData">
    @if (count($reports) !== 0)
    <thead>
        <tr>
            <th>Employee Name</th>
            <th>Date</th>
            <th>Expense Type</th>
            <th>Price</th>
            <th>Status</th>
            <th>Description</th>
            <th>Remark</th>
        </tr>
    </thead>
    @endif
    <tbody>
        @forelse ($reports as $report)
            <tr>
            <td>{{ $report->user->name }}</td>
            <td>{{ $report->entry_date }}</td>
            <td>{{ $report->name }}</td>
            <td>Rp. {{ number_format($report->amount,0,"",".") }}</td>
            <td>{{ $report->status }}</td>
            <td>{{ $report->description }}</td>
            <td>{{ $report->remark }}</td>
        </tr>
        @empty
            <p>There is no data</p>
        @endforelse
    </tbody>
</table>