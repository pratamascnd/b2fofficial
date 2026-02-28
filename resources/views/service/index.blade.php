@extends("layout.dashboard.main")

@section("title", "Service - B2F Official")
@section("namepage", "Service")
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
                        <a class="text-dark font-weight-bold">Service</a>
                    </li>
                </ul>
            </div>

            <div class="mt-3 mt-md-0">
                <a href="{{ route('service.create') }}" class="btn btn-b2f d-flex align-items-center shadow-sm">
                    <i class="fas fa-plus me-2"></i>
                    <span>Add Service</span>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Service</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th class="text-center">Image</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($service as $data)                                             
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->category }}</td>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ Str::limit($data->description, 100, '...') }}</td>
                                        <td class="text-center">
                                            {{-- Thumbnail Image dengan Modal Trigger --}}
                                            <img src="{{ asset('storage/' . $data->image) }}" 
                                                 class="img-thumbnail-table shadow-sm" 
                                                 data-bs-toggle="modal" 
                                                 data-bs-target="#previewService{{ $data->id }}">
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('service.edit', $data->id) }}"
                                                    data-toggle="tooltip" title="Edit Data"
                                                    class="btn btn-link btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <form action="{{ route('service.destroy', $data->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" id="delete"
                                                        data-toggle="tooltip" title="Delete Data"
                                                        class="btn btn-link btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Modal Preview Service Image --}}
                                    <div class="modal fade" id="previewService{{ $data->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title fw-bold">{{ $data->title }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center p-2 bg-dark rounded-bottom">
                                                    <img src="{{ asset('storage/' . $data->image) }}" class="img-fluid rounded" style="max-height: 80vh;">
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