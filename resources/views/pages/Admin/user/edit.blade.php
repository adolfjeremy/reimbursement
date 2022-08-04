<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit {{ $data->name }} Role</h5>
    <button type="button" class="btn-close btn-edit" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body text-start">
    <div class="container py-3" id="editUser">
        <select name="roles" id="roles" class="form-select" aria-label="Default select example">
            <option value="{{ $data->roles }}">{{ $data->roles }}</option>
            @if ($data->roles === 'USER')
            <option value="ADMIN">ADMIN</option>
            @endif
            @if ($data->roles === 'ADMIN')
            <option value="USER">USER</option>
            @endif
        </select>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary" onclick="update({{ $data->id }})">Update</button>
</div>