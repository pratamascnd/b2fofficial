@extends("layout.dashboard.main")

@section("title", "Contact - B2F Official")
@section("namepage", "Contact")
@section("content")
    <div class="container">
        <div class="page-inner">
            <div
                class="d-md-flex align-items-center justify-content-between mb-4 mt-1"
            >
                <div>
                    <ul class="breadcrumbs p-0 m-0 d-flex align-items-center list-unstyled" >
                        <li class="nav-home">
                            <a href="{{ route("dashboard.index") }}" class="text-secondary" >
                                <i class="icon-home"></i>
                            </a>
                        </li>
                        <li class="separator px-2">
                            <i class="icon-arrow-right" style="font-size: 12px"></i>
                        </li>
                        <li class="nav-item">
                            <a class="text-dark font-weight-bold">
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="mt-3 mt-md-0">
                    <a href="{{ route("contact.create") }}" class="btn btn-b2f d-flex align-items-center shadow-sm">
                        <i class="fas fa-plus me-2"></i>
                        <span>Add Contact</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Contact</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Whatsapp</th>
                                            <th>Email</th>
                                            <th>Instagram</th>
                                            <th>Tiktok</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contact as $data)                                            
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->no_whatsapp }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>
                                                @if($data->link_instagram)
                                                    <a href="{{ $data->link_instagram }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                                        <i class="fas fa-link"></i> View
                                                    </a>
                                                @else
                                                    <button class="btn btn-sm btn-outline-secondary" disabled>
                                                        <i class="fas fa-ban"></i> Empty
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                @if($data->link_tiktok)
                                                    <a href="{{ $data->link_tiktok }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                                        <i class="fas fa-link"></i> View
                                                    </a>
                                                @else
                                                    <button class="btn btn-sm btn-outline-secondary" disabled>
                                                        <i class="fas fa-ban"></i> Empty
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('contact.edit', $data->id) }}"
                                                        data-toggle="tooltip" title="Edit Data"
                                                        class="btn btn-link btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <form action="{{ route('contact.destroy', $data->id) }}" method="POST" style="display:inline;">
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
