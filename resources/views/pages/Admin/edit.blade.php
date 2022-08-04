<div class="row mt-2">
    <div class="col-4 fw-bold">Name</div>
    <div class="col-8">{{ $data->name }}</div>
</div>
<div class="row mt-2">
    <div class="col-4 fw-bold">Date</div>
    <div class="col-8">{{ $data->entry_date }}</div>
</div>
<div class="row mt-2">
    <div class="col-4 fw-bold">Price</div>
    <div class="col-8">Rp. {{ number_format($data->amount,0,"",".") }}</div>
</div>
<div class="row mt-2">
    <div class="col-4 fw-bold">Description</div>
    @if ($data->description === null)
        <div class="col-8">none</div>
    @else
        <div class="col-8">{{ $data->description }}</div>
    @endif
</div>
<div class="row mt-2">
    <div class="col-4 fw-bold">Status</div>
    <div class="col-8">
        <select id="status" name="status" class="form-select">
            <option style="text-transform: uppercase" value="{{ $data->status }}">{{ $data->status }}</option>
            @if ($data->status === "APPROVE")
                <option value="DENIED">DENIED</option>
                <option value="PENDING">PENDING</option>
            @elseif ($data->status === "DENIED") 
                <option value="APPROVE">APPROVE</option>
                <option value="PENDING">PENDING</option>
            @else
                <option value="APPROVE">APPROVE</option>
                <option value="DENIED">DENIED</option>
            @endif
        </select>
    </div>
</div>
<div class="row mt-2">
    <div class="col-4 fw-bold">Remark</div>
    <div class="col-8">
        <textarea name="remark" class="form-control" id="remark" placeholder="tambahkan komentar untuk expense ini">{!! $data->remark !!}</textarea>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary" onclick="update({{ $data->id }})">Update</button>
</div>