@extends("layout.dashboard.main")

@section("title", "Create News - B2F Official")
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
                        <li class="separator px-2">
                            <i class="icon-arrow-right" style="font-size: 12px"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('news.index') }}" class="text-b2f font-weight-bold">News</a>
                        </li>
                        <li class="separator px-2">
                            <i class="icon-arrow-right" style="font-size: 12px"></i>
                        </li>
                        <li class="nav-item">
                            <a class="text-dark font-weight-bold">Create News</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Create News</div>
                        </div>
                        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    {{-- Front Pic --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                            <small class="text-muted">Recommended: 1000x600px (Max 2MB)</small>
                                        </div>
                                    </div>

                                     {{-- Title --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">News Title</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="{{ old('title') }}">
                                        </div>
                                    </div>

                                    {{-- Description --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Content Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description">{{ old('description') }}</textarea>
                                        </div>
                                    </div>

                                    {{-- Link --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link">Link (Optional)</label>
                                            <input type="url" class="form-control" id="link" name="link" placeholder="https://..." value="{{ old('link') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Pin Status</label>
                                            <select class="form-select" id="status" name="status" required >
                                                <option value="" selected disabled> Select Status </option>
                                                <option value="unpinned"> Unpinned (Standard)</option>
                                                <option value="pinned"> Pinned (Top Priority)</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-action text-end">
                                <a href="{{ route('news.index') }}" class="btn btn-dark me-2">
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