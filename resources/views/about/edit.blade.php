@extends("layout.dashboard.main")

@section("title", "Edit About - B2F Official")
@section("namepage", "About")
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
                            <a href="{{ route('about.index') }}" class="text-b2f font-weight-bold">About</a>
                        </li>
                        <li class="separator px-2">
                            <i class="icon-arrow-right" style="font-size: 12px"></i>
                        </li>
                        <li class="nav-item">
                            <a class="text-dark font-weight-bold">Edit About</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Edit About</div>
                        </div>
                        <form action="{{ route('about.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') 
                            
                            <div class="card-body">
                                <div class="row">
                                    {{-- Baris 1: Judul dan Link --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $data->title) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="video_link">YouTube Video Link</label>
                                            <input type="url" class="form-control" id="video_link" name="video_link" value="{{ old('video_link', $data->video_link) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- Baris 2: Gambar-gambar --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="front_pic">Front Picture (Hero Section)</label>
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $data->front_pic) }}" alt="Current Front Pic" style="height: 100px; object-fit: cover;" class="img-thumbnail d-block">
                                            </div>
                                            <input type="file" class="form-control" id="front_pic" name="front_pic">
                                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="about_pic">About Picture (Description Section)</label>
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $data->about_pic) }}" alt="Current About Pic" style="height: 100px; object-fit: cover;" class="img-thumbnail d-block">
                                            </div>
                                            <input type="file" class="form-control" id="about_pic" name="about_pic">
                                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- Baris 3: Deskripsi --}}
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $data->description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-action text-end">
                                <a href="{{ route('about.index') }}" class="btn btn-dark me-2">
                                    <i class="fas fa-arrow-left"></i> Back
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