@extends("layout.dashboard.main")

@section("title", "Create Account - B2F Official")
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
                            <a class="text-dark font-weight-bold">
                                Create Account
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Create Account</div>
                        </div>
                        <form action="{{ route("admin-account.store") }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="name"
                                                name="name"
                                                placeholder="Enter Name"
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
                                                required
                                            />
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
                                                <option value="" selected disabled>
                                                    Select Role
                                                </option>
                                                <option value="Super Admin">
                                                    Super Admin
                                                </option>
                                                <option value="Admin">
                                                    Admin
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action text-end">
                                <a href="{{ route("admin-account.index") }}"
                                    class="btn btn-dark ms-md-auto mt-md-0 me-2">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                                <button
                                    type="reset"
                                    class="btn btn-danger me-2"
                                >
                                    <i class="fas fa-sync"></i> Reset
                                </button>
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
