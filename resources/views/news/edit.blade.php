@extends("layout.dashboard.main")

@section("title", "Edit News - B2F Official")
@section("namepage", "News")
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
                        <li class="separator px-2"><i class="icon-arrow-right" style="font-size: 12px"></i></li>
                        <li class="nav-item">
                            <a href="{{ route('news.index') }}" class="text-b2f font-weight-bold">News</a>
                        </li>
                        <li class="separator px-2"><i class="icon-arrow-right" style="font-size: 12px"></i></li>
                        <li class="nav-item">
                            <a class="text-dark font-weight-bold">Edit News</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Edit News</div>
                        </div>
                        <form action="{{ route('news.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') 
                            
                            <div class="card-body">
                                <div class="row">
                                    {{-- Kolom Kiri: Preview & Upload Gambar --}}
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="d-block">Image</label>
                                            <div class="mb-3">
                                                <img src="{{ asset('storage/' . $data->image) }}"  style="width: 100%; max-height: 250px; object-fit: cover; border-radius: 8px;" class="img-thumbnail shadow-sm">
                                            </div>
                                            <label for="image">Change Image</label>
                                            <input type="file" class="form-control"  id="image" name="image">
                                            <small class="text-muted">Recommended: 1000x600px (Max 2MB). Biarkan kosong jika tidak ingin mengganti.</small>
                                        </div>
                                    </div>

                                    {{-- Kolom Kanan: Input Teks --}}
                                    <div class="col-md-7">
                                        {{-- Title --}}
                                        <div class="form-group mb-3">
                                            <label for="title">News Title</label>
                                            <input type="text" class="form-control"  id="title" name="title" value="{{ old('title', $data->title) }}" placeholder="Enter news title">
                                        </div>

                                        <div class="row">
                                            {{-- Status --}}
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="status">Pin Status</label>
                                                    <select name="status" class="form-select">
                                                        <option value="" selected disabled> Select Status </option>
                                                        <option value="unpinned" {{ old('status', $data->status) == 'unpinned' ? 'selected' : '' }}>Unpinned (Standard)</option>
                                                        <option value="pinned" {{ old('status', $data->status) == 'pinned' ? 'selected' : '' }}>Pinned (Top Priority)</option>
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- Link --}}
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="link">Link (Optional)</label>
                                                    <input type="url" class="form-control" id="link" name="link" value="{{ old('link', $data->link) }}" placeholder="https://...">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Description --}}
                                        <div class="form-group mb-0">
                                            <label for="description">Content Description</label>
                                            <textarea name="description" id="description" rows="7" class="form-control" placeholder="Write news content here...">{{ old('description', $data->description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-action text-end">
                                <hr>
                                <a href="{{ route('news.index') }}" class="btn btn-dark me-2">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-b2f">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection