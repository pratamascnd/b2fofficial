@extends("layout.dashboard.main")

@section("title", "Edit Service - B2F Official")
@section("namepage", "Service")
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
                            <a href="{{ route('service.index') }}" class="text-b2f font-weight-bold">Service</a>
                        </li>
                        <li class="separator px-2">
                            <i class="icon-arrow-right" style="font-size: 12px"></i>
                        </li>
                        <li class="nav-item">
                            <a class="text-dark font-weight-bold">Edit Service</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Edit Service</div>
                        </div>
                        <form action="{{ route('service.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') {{-- PENTING: Untuk Update --}}
                            
                            <div class="card-body">
                                <div class="row">
                                    {{-- Category --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $data->category) }}">
                                        </div>
                                    </div>

                                    {{-- Title --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $data->title) }}">
                                        </div>
                                    </div>

                                    {{-- Description --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $data->description) }}</textarea>
                                        </div>
                                    </div>

                                    {{-- Image --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $data->image) }}" alt="Current Image" style="height: 100px;" class="img-thumbnail">
                                            </div>
                                            <input type="file" class="form-control" id="image" name="image">
                                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-action text-end">
                                <a href="{{ route('service.index') }}" class="btn btn-dark me-2">
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