@extends("layout.dashboard.main")

@section("title", "Edit Brand Partner - B2F Official")
@section("namepage", "Brand Partner")
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
                            <a href="{{ route('brand-partner.index') }}" class="text-b2f font-weight-bold">Brand Partner</a>
                        </li>
                        <li class="separator px-2">
                            <i class="icon-arrow-right" style="font-size: 12px"></i>
                        </li>
                        <li class="nav-item">
                            <a class="text-dark font-weight-bold">Edit Brand Partner</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Edit Brand Partner</div>
                        </div>
                        <form action="{{ route('brand-partner.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') {{-- PENTING: Untuk Update --}}
                            
                            <div class="card-body">
                                <div class="row">
                                    {{-- Name --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $data->name) }}">
                                        </div>
                                    </div>

                                    {{-- Link --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link">Link</label>
                                            <input type="url" class="form-control" id="link" name="link" value="{{ old('link', $data->link) }}">
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
                                <a href="{{ route('brand-partner.index') }}" class="btn btn-dark me-2">
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