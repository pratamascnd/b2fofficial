@extends("layout.dashboard.main")

@section("title", "Admin Account - B2F Official")
@section("namepage", "Admin Account")
@section("content")
    <div class="container">
        <div class="page-inner">
            <div
                class="d-md-flex align-items-center justify-content-between mb-4 mt-1"
            >
                <div>
                    <ul
                        class="breadcrumbs p-0 m-0 d-flex align-items-center list-unstyled"
                    >
                        <li class="nav-home">
                            <a
                                href="{{ route("dashboard.index") }}"
                                class="text-secondary"
                            >
                                <i class="icon-home"></i>
                            </a>
                        </li>
                        <li class="separator px-2">
                            <i
                                class="icon-arrow-right"
                                style="font-size: 12px"
                            ></i>
                        </li>
                        <li class="nav-item">
                            <a class="text-dark font-weight-bold">
                                Admin Account
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="mt-3 mt-md-0">
                    <a
                        href="{{ route("admin-account.create") }}"
                        class="btn btn-b2f d-flex align-items-center shadow-sm"
                    >
                        <i class="fas fa-plus me-2"></i>
                        <span>Add Account</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Admin Account</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table
                                    id="basic-datatables"
                                    class="display table table-striped table-hover"
                                >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($account as $data)                                            
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->role }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a
                                                        href="{{ route('admin-account.edit', $data->id) }}"
                                                        data-toggle="tooltip"
                                                        title="Edit Data"
                                                        class="btn btn-link btn-primary"
                                                        data-original-title="Edit Data"
                                                    >
                                                        <i
                                                            class="fa fa-edit"
                                                        ></i>
                                                    </a>
                                                    <form action="{{ route('admin-account.destroy', $data->id) }}" method="POST" >
                                                        @csrf
                                                        @method('DELETE')
                                                            <a
                                                                id="delete"
                                                                data-toggle="tooltip"
                                                                title="Delete Data"
                                                                class="btn btn-link btn-danger"
                                                                data-original-title="Delete Data"
                                                            >
                                                                <i
                                                                    class="fa fa-trash"
                                                                ></i>
                                                            </a>
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
