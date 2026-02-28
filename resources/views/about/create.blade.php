@extends("layout.dashboard.main")

@section("title", "Create About - B2F Official")
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
                            <a class="text-dark font-weight-bold">Create About</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @if($isMax)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i> Perhatian!</strong> 
                        Data About sudah tersedia. Anda tidak dapat menambah data lagi. 
                        Silahkan <strong>Edit</strong> data yang sudah ada atau hapus data lama untuk menambah ulang.
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Create About</div>
                        </div>
                        <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                     {{-- Title --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="{{ old('title') }}">
                                        </div>
                                    </div>

                                    {{-- YouTube Video Link --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="video_link">YouTube Video Link</label>
                                            <input type="url" class="form-control" id="video_link" name="video_link" placeholder="https://youtube.com/..." value="{{ old('video_link') }}">
                                        </div>
                                    </div>

                                    {{-- Front Pic --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="front_pic">Front Picture (Hero Section)</label>
                                            <input type="file" class="form-control" id="front_pic" name="front_pic">
                                            <small class="form-text text-muted">Recommended size: 1920x1080px</small>
                                        </div>
                                    </div>
                                    
                                    {{-- About Pic --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="about_pic">About Picture (Description Section)</label>
                                            <input type="file" class="form-control" id="about_pic" name="about_pic">
                                            <small class="form-text text-muted">Recommended size: 1024x768px</small>
                                        </div>
                                    </div>

                                    {{-- Description --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Write about B2F community...">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-action text-end">
                                <a href="{{ route('about.index') }}" class="btn btn-dark me-2">
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