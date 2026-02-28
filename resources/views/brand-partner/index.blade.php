@extends("layout.dashboard.main")

@section("title", "Brand Partner - B2F Official")
@section("namepage", "Brand Partner")
@section("content")

<style>
    .img-thumbnail-table {
        width: 70px;
        height: 50px;
        object-fit: contain; /* Contain cocok untuk logo brand agar tidak terpotong */
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid #f1f1f1;
        background-color: #fff;
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
                        <a class="text-dark font-weight-bold">Brand Partner</a>
                    </li>
                </ul>
            </div>

            <div class="mt-3 mt-md-0">
                <a href="{{ route('brand-partner.create') }}" class="btn btn-b2f d-flex align-items-center shadow-sm">
                    <i class="fas fa-plus me-2"></i>
                    <span>Add Brand</span>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Brand Partner</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Link</th>
                                        <th class="text-center">Image</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brand_partner as $data)                                     
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>
                                            <a href="{{ $data->link }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                                <i class="fas fa-link me-1"></i> Visit Site
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            {{-- Thumbnail Image --}}
                                            <img src="{{ asset('storage/' . $data->image) }}" 
                                                 class="img-thumbnail-table" 
                                                 data-bs-toggle="modal" 
                                                 data-bs-target="#previewBrand{{ $data->id }}">
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('brand-partner.edit', $data->id) }}"
                                                    data-toggle="tooltip" title="Edit Data"
                                                    class="btn btn-link btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <form action="{{ route('brand-partner.destroy', $data->id) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-link btn-danger" id="delete"
                                                            data-toggle="tooltip" title="Delete Data">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Modal Preview Brand Logo --}}
                                    <div class="modal fade" id="previewBrand{{ $data->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Logo Preview: {{ $data->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center p-4">
                                                    <img src="{{ asset('storage/' . $data->image) }}" class="img-fluid rounded shadow-sm">
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