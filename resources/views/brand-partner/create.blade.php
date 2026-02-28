@extends("layout.dashboard.main")

@section("title", "Create Brand Partner - B2F Official")
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
                            <a class="text-dark font-weight-bold">Create Brand Partner</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Create Brand Partner</div>
                        </div>
                        <form action="{{ route('brand-partner.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                     {{-- Nama --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control"id="name" name="name" placeholder="Enter name" value="{{ old('name') }}">
                                        </div>
                                    </div>

                                     {{-- Link --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link">Link</label>
                                            <input type="url" class="form-control" id="link" name="link" placeholder="https://..." value="{{ old('link') }}">
                                        </div>
                                    </div>
                                    
                                    {{-- Image --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                            <small class="form-text text-muted">Recommended size: 400x173px</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-action text-end">
                                <a href="{{ route('brand-partner.index') }}" class="btn btn-dark me-2">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                                <button type="reset" class="btn btn-danger me-2"><i class="fas fa-sync"></i> Reset</button>
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