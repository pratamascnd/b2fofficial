@extends("layout.dashboard.main")

@section("title", "Edit Streamer - B2F Official")
@section("namepage", "Streamer")
@section("content")
    <div class="container">
        <div class="page-inner">
            <div class="d-md-flex align-items-center justify-content-between mb-4 mt-1">
                <div>
                    <ul class="breadcrumbs p-0 m-0 d-flex align-items-center list-unstyled">
                        <li class="nav-home">
                            <a href="{{ route('dashboard.index') }}" class="text-secondary">
                                <i class="icon-home"></i>
                            </a>
                        </li>
                        <li class="separator px-2">
                            <i class="icon-arrow-right" style="font-size: 12px"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('streamer-profile.index') }}" class="text-b2f font-weight-bold">Streamer</a>
                        </li>
                        <li class="separator px-2">
                            <i class="icon-arrow-right" style="font-size: 12px"></i>
                        </li>
                        <li class="nav-item">
                            <a class="text-dark font-weight-bold">Edit Streamer</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Edit Streamer: {{ $data->name }}</div>
                        </div>
                        {{-- Gunakan method PUT untuk update --}}
                        <form action="{{ route('streamer-profile.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="card-body">
                                <div class="row">
                                    {{-- Image Preview & Input --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="image">Profile Image</label>
                                            <div class="mb-3">
                                                <small class="text-muted d-block mb-2">Current Image:</small>
                                                <img src="{{ asset('storage/' . $data->image) }}" alt="Preview" class="img-thumbnail" style="max-height: 150px;">
                                            </div>
                                            <input type="file" class="form-control" id="image" name="image">
                                            <small class="text-muted">Upload new image if you want to change it. (Max 2MB)</small>
                                        </div>
                                    </div>

                                    {{-- Name --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name', $data->name) }}">
                                        </div>
                                    </div>

                                    {{-- Full Name --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="full_name">Full Name</label>
                                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter full name" value="{{ old('full_name', $data->full_name) }}">
                                        </div>
                                    </div>

                                    {{-- Link Instagram 1 --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link_instagram1">Link Instagram 1</label>
                                            <input type="url" class="form-control" id="link_instagram1" name="link_instagram1" placeholder="https://..." value="{{ old('link_instagram1', $data->link_instagram1) }}">
                                        </div>
                                    </div>

                                    {{-- Link Instagram 2 --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link_instagram2">Link Instagram 2 (Optional)</label>
                                            <input type="url" class="form-control" id="link_instagram2" name="link_instagram2" placeholder="https://..." value="{{ old('link_instagram2', $data->link_instagram2) }}">
                                        </div>
                                    </div>

                                    {{-- Link Tiktok 1 --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link_tiktok1">Link Tiktok 1</label>
                                            <input type="url" class="form-control" id="link_tiktok1" name="link_tiktok1" placeholder="https://..." value="{{ old('link_tiktok1', $data->link_tiktok1) }}">
                                        </div>
                                    </div>

                                    {{-- Link Tiktok 2 --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link_tiktok2">Link Tiktok 2 (Optional)</label>
                                            <input type="url" class="form-control" id="link_tiktok2" name="link_tiktok2" placeholder="https://..." value="{{ old('link_tiktok2', $data->link_tiktok2) }}">
                                        </div>
                                    </div>

                                    {{-- Link Youtube 1 --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link_youtube1">Link Youtube 1</label>
                                            <input type="url" class="form-control" id="link_youtube1" name="link_youtube1" placeholder="https://..." value="{{ old('link_youtube1', $data->link_youtube1) }}">
                                        </div>
                                    </div>

                                    {{-- Link Youtube 2 --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link_youtube2">Link Youtube 2 (Optional)</label>
                                            <input type="url" class="form-control" id="link_youtube2" name="link_youtube2" placeholder="https://..." value="{{ old('link_youtube2', $data->link_youtube2) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-action text-end">
                                <a href="{{ route('streamer-profile.index') }}" class="btn btn-dark me-2">
                                    <i class="fas fa-arrow-left"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-b2f">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection