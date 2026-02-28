@extends("layout.dashboard.main")

@section("title", "About - B2F Official")
@section("namepage", "About")

@section("content")
<style>
    .img-thumbnail-table {
        width: 70px;
        height: 50px;
        object-fit: cover;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid #f1f1f1;
    }
    .img-thumbnail-table:hover {
        transform: scale(1.1);
        border-color: #feb801;
    }
</style>

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
                        <a class="text-dark font-weight-bold">About</a>
                    </li>
                </ul>
            </div>

            <div class="mt-3 mt-md-0">
                <a href="{{ route('about.create') }}" class="btn btn-b2f d-flex align-items-center shadow-sm">
                    <i class="fas fa-plus me-2"></i>
                    <span>Add About</span>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data About Content</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th class="text-center">Front Image</th>
                                        <th class="text-center">About Image</th>
                                        <th>Video</th>
                                        <th>Description</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($about as $data)                                     
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->title }}</td>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/' . $data->front_pic) }}" 
                                                 class="img-thumbnail-table" 
                                                 data-bs-toggle="modal" 
                                                 data-bs-target="#previewImg{{ $data->id }}Front">
                                        </td>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/' . $data->about_pic) }}" 
                                                 class="img-thumbnail-table"
                                                 data-bs-toggle="modal" 
                                                 data-bs-target="#previewImg{{ $data->id }}About">
                                        </td>
                                        <td>
                                            <a href="{{ $data->video_link }}" target="_blank" class="btn btn-sm btn-danger rounded-pill px-3">
                                                <i class="fab fa-youtube"></i> Watch
                                            </a>
                                        </td>
                                        <td><small class="text-muted">{{ Str::limit($data->description, 60) }}</small></td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('about.edit', $data->id) }}" class="btn btn-link btn-primary p-1" data-toggle="tooltip" title="Edit Data">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <form action="{{ route('about.destroy', $data->id) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-link btn-danger p-1" id="delete" title="Delete Data">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="previewImg{{ $data->id }}Front" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Front Picture Preview</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center bg-dark p-2">
                                                    <img src="{{ asset('storage/' . $data->front_pic) }}" class="img-fluid rounded">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="previewImg{{ $data->id }}About" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">About Picture Preview</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center bg-dark p-2">
                                                    <img src="{{ asset('storage/' . $data->about_pic) }}" class="img-fluid rounded">
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