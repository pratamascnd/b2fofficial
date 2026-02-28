@extends("layout.dashboard.main")

@section("title", "Create Gallery - B2F Official")
@section("namepage", "Gallery")
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
                            <a href="{{ route('gallery.index') }}" class="text-b2f font-weight-bold">Gallery</a>
                        </li>
                        <li class="separator px-2">
                            <i class="icon-arrow-right" style="font-size: 12px"></i>
                        </li>
                        <li class="nav-item">
                            <a class="text-dark font-weight-bold">Create Gallery</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i> Perhatian!</strong> 
                        Maximal <strong>10</strong> image per title. Anda tidak dapat menambah data lagi. 
                        Silahkan <strong>Edit</strong> data yang sudah ada atau hapus data lama untuk menambah ulang.
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Create Gallery</div>
                        </div>
                        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
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
                                    
                                    {{-- Project Date --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="project_date">Project Date</label>
                                            <input type="date" class="form-control" id="project_date" name="project_date" value="{{ old('project_date') }}">
                                        </div>
                                    </div>

                                    {{-- Year (untuk value 'Y'/year nya menyesuaikan dengan project date) --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="year" name="year">
                                        </div>
                                    </div>

                                    {{-- Images --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="images">Upload Images (Max 10)</label>
                                            <input type="file" class="form-control" name="images[]" multiple accept="image/*" required>
                                            <small class="text-muted">Recommended size: 1080x1350px (Feed Potrait Instagram). Anda bisa memilih hingga 10 foto sekaligus.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-action text-end">
                                <a href="{{ route('gallery.index') }}" class="btn btn-dark me-2">
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
    <script>
        // Automatis isi input hidden 'year' dari 'project_date'
        document.getElementById('project_date').addEventListener('change', function() {
            const date = new Date(this.value);
            if(!isNaN(date.getFullYear())) {
                document.getElementById('year').value = date.getFullYear();
            }
        });
    </script>
@endsection