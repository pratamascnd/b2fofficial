@extends("layout.dashboard.main")

@section("title", "Gallery - B2F Official")
@section("namepage", "Gallery")
@section("content")
    <div class="container">
        <div class="page-inner">
            <div class="d-md-flex align-items-center justify-content-between mb-4 mt-1">
                <div>
                    <ul class="breadcrumbs p-0 m-0 d-flex align-items-center list-unstyled">
                        <li class="nav-home">
                            <a href="{{ route("dashboard.index") }}" class="text-secondary">
                                <i class="icon-home"></i>
                            </a>
                        </li>
                        <li class="separator px-2">
                            <i class="icon-arrow-right" style="font-size: 12px"></i>
                        </li>
                        <li class="nav-item">
                            <a class="text-dark font-weight-bold">Gallery</a>
                        </li>
                    </ul>
                </div>

                <div class="mt-3 mt-md-0">
                    <a href="{{ route("gallery.create") }}" class="btn btn-b2f d-flex align-items-center shadow-sm">
                        <i class="fas fa-plus me-2"></i>
                        <span>Add Image</span>
                    </a>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Image</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>Project Date</th>
                                            <th>Total Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($gallery as $data)                                            
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->title }}</td>
                                            {{-- Format Tanggal d F Y --}}
                                            <td>{{ \Carbon\Carbon::parse($data->project_date)->format('d F Y') }}</td> 
                                            {{-- Menghitung total detail image --}}
                                            <td>
                                                <span class="badge {{ $data->details->count() >= 10 ? 'badge-danger' : 'badge-warning' }}">
                                                    {{ $data->details->count() }} / 10
                                                </span>
                                            </td>

                                            <td>
                                                <div class="form-button-action">
                                                    {{-- Button Trigger Modal --}}
                                                    <button type="button" class="btn btn-link btn-info" data-bs-toggle="modal" data-bs-target="#modalView{{ $data->id }}" title="View Images">
                                                        <i class="fas fa-eye"></i>
                                                    </button>

                                                    <a href="{{ route('gallery.edit', $data->id) }}"
                                                        data-toggle="tooltip" title="Edit Data"
                                                        class="btn btn-link btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <form action="{{ route('gallery.destroy', $data->id) }}" method="POST" style="display:inline;" id="deleteForm{{ $data->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link btn-danger" data-toggle="tooltip" id="delete" title="Delete Data">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modalView{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Images for: {{ $data->title }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row g-3">
                                                            @forelse ($data->details as $img)
                                                                <div class="col-md-4 col-6">
                                                                    <img src="{{ asset('storage/' . $img->image) }}" 
                                                                        class="img-fluid rounded shadow-sm border" 
                                                                        style="height: 400px; width: 100%; object-fit: cover; object-position: center;">
                                                                </div>
                                                            @empty
                                                                <div class="col-12 text-center">
                                                                    <p class="text-muted">No images found.</p>
                                                                </div>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
@endsection