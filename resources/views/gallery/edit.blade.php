@extends("layout.dashboard.main")

@section("title", "Edit Gallery - B2F Official")
@section("namepage", "Gallery")
@section("content")
    <div class="container">
        <div class="page-inner">
            <div class="d-md-flex align-items-center justify-content-between mb-4 mt-1">
                <div>
                    <ul class="breadcrumbs p-0 m-0 d-flex align-items-center list-unstyled">
                        <li class="nav-home"><a href="{{ route('dashboard.index') }}" class="text-secondary"><i class="icon-home"></i></a></li>
                        <li class="separator px-2"><i class="icon-arrow-right" style="font-size: 12px"></i></li>
                        <li class="nav-item"><a href="{{ route('gallery.index') }}" class="text-b2f font-weight-bold">Gallery</a></li>
                        <li class="separator px-2"><i class="icon-arrow-right" style="font-size: 12px"></i></li>
                        <li class="nav-item"><a class="text-dark font-weight-bold">Edit Gallery</a></li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Edit Gallery</div>
                        </div>
                        
                        {{-- FORM UPDATE UTAMA HANYA MEMBUNGKUS INPUT TEKS & UPLOAD BARU --}}
                        <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" name="title" value="{{ old('title', $gallery->title) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Project Date</label>
                                            <input type="date" class="form-control" name="project_date" value="{{ $gallery->project_date }}">
                                        </div>
                                    </div>
                                    <input type="hidden" name="year" id="year" value="{{ $gallery->year }}">

                                    <div class="col-md-12 mt-4">
                                        <div class="form-group">
                                            <label>Add More Images (Sisa Slot: {{ 10 - $gallery->details->count() }})</label>
                                            <input type="file" class="form-control" name="images[]" multiple {{ $gallery->details->count() >= 10 ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-action text-end border-bottom pb-3 mb-3">
                                    <a href="{{ route('gallery.index') }}" class="btn btn-dark me-2"><i class="fas fa-arrow-left"></i> Back</a>
                                    <button type="submit" class="btn btn-b2f"><i class="fas fa-save"></i> Save</button>
                                </div>
                            </div>

                        </form> {{-- PENUTUP FORM UPDATE PINDAH KE SINI --}}

                        <div class="card-body pt-0">
                            {{-- MANAJEMEN GAMBAR SEKARANG BERDIRI SENDIRI DI LUAR FORM UPDATE --}}
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label class="font-weight-bold">Current Images ({{ $gallery->details->count() }}/10)</label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered mt-2">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th width="10%">No</th>
                                                    <th width="30%">Preview</th>
                                                    <th>Path</th>
                                                    <th width="15%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($gallery->details as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/' . $data->image) }}" class="rounded shadow-sm" style="height: 60px; width: 80px; object-fit: cover;">
                                                    </td>
                                                    <td><small class="text-muted">{{ $data->image }}</small></td>
                                                    <td>
                                                        {{-- Form delete sekarang aman karena tidak lagi 'tertelan' form lain --}}
                                                        <form action="{{ route('gallery.image.destroy', $data->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('project_date').addEventListener('change', function() {
            const date = new Date(this.value);
            if(!isNaN(date.getFullYear())) {
                document.getElementById('year').value = date.getFullYear();
            }
        });
    </script>
@endsection