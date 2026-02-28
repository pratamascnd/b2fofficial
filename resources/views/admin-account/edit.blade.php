@extends("layout.dashboard.main")

@section("title", "Edit Account - B2F Official")
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
                            <a
                                href="{{ route("admin-account.index") }}"
                                class="text-b2f font-weight-bold"
                            >
                                Admin Account
                            </a>
                        </li>
                        <li class="separator px-2">
                            <i
                                class="icon-arrow-right"
                                style="font-size: 12px"
                            ></i>
                        </li>
                        <li class="nav-item">
                            <a
                                class="text-dark font-weight-bold"
                            >
                                Edit Account
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Edit Account - {{ $data->name }}</div>
                        </div>
                        <form action="{{ route("admin-account.update", $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Full Name</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="name"
                                                name="name"
                                                value="{{ $data->name }}"
                                                placeholder="Enter Full Name"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">
                                                Email Address
                                            </label>
                                            <input
                                                type="email"
                                                class="form-control"
                                                id="email"
                                                name="email"
                                                value="{{ $data->email }}"
                                                placeholder="Enter Email"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">
                                                Password
                                            </label>
                                            <input
                                                type="password"
                                                class="form-control"
                                                id="password"
                                                name="password"
                                                placeholder="Password"
                                            />
                                            <small class="form-text text-danger">
                                                Kosongkan jika tidak ingin
                                                mengubah password.
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select
                                                class="form-select"
                                                id="role"
                                                name="role"
                                                required
                                            >
                                                <option disabled>
                                                    = Select Role = 
                                                </option>
                                               <option value="Super Admin" {{ (isset($data) && $data->role == 'Super Admin') ? 'selected' : '' }}>Super Admin</option>
                                                <option value="Admin" {{ (isset($data) && $data->role == 'Admin') ? 'selected' : '' }}>Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action text-end">
                                <a href="{{ route("admin-account.index") }}"
                                    class="btn btn-danger me-2" >
                                    <i class="fas fa-arrow-left"></i> Cancel
                                </a>
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
