@extends('layouts.dashboard')

@section('title')
    Monthly Report
@endsection

@section('content')
    <section class="content_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 overview_wrapper mt-3 m-md-0">
                <h1>User Settings</h1>
                </div>
            </div>
            <div class="name_wrapper d-flex align-items-center">
                <div class="profile_picture" style="background-image: url('{{ asset("storage/" . $item->photo) }}')"></div>
                <a type="button" class="ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Change Profile Photo
                </a>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Upload Photo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('user.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="oldImage" value="{{ $item->photo }}">
                                    <input type="file" id="photo" name="photo" class="form-control w-100">
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('user.update', $item->id) }}" method="POST" class="mt-3 w-80">
                @method('PUT')
                @csrf
                <div class="mt-4 d-flex align-items-center justify-content-start">
                </div>
                <div class="row mt-3">
                    <label for="basic-url" class="form-label">Name</label>
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control" value="{{ $item->name }}">
                    </div>
                </div>
                <div class="row mt-2">
                    <label for="basic-url" class="form-label">Email</label>
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" value="{{ $item->email }}">
                    </div>
                </div>
                <div class="row mt-2">
                    <label for="basic-url" class="form-label">Password</label>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Isi jika ingin mengubah password">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </section>
@endsection