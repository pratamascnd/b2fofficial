@extends("layout.dashboard.main")

@section("title", "Edit Contact - B2F Official")
@section("namepage", "Contact")
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
                            <a href="{{ route('contact.index') }}" class="text-b2f font-weight-bold">Contact</a>
                        </li>
                        <li class="separator px-2">
                            <i class="icon-arrow-right" style="font-size: 12px"></i>
                        </li>
                        <li class="nav-item">
                            <a class="text-dark font-weight-bold">Edit Contact</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Edit Contact</div>
                        </div>
                        <form action="{{ route('contact.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') {{-- PENTING: Untuk Update --}}
                            
                            <div class="card-body">
                                <div class="row">
                                    {{-- No Whatsapp --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_whatsapp">No Whatsapp</label>
                                            <input type="text" class="form-control" id="no_whatsapp" name="no_whatsapp" value="{{ old('no_whatsapp', $data->no_whatsapp) }}">
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $data->email) }}">
                                        </div>
                                    </div>

                                    {{-- Link Instagram --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link_instagram">Link Instagram</label>
                                            <input type="text" class="form-control" id="link_instagram" name="link_instagram" value="{{ old('link_instagram', $data->link_instagram) }}">
                                            <small class="form-text text-muted">Kosongkan jika tidak ada</small>
                                        </div>
                                    </div>

                                    {{-- Link Tiktok --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link_tiktok">Link Tiktok</label>
                                            <input type="text" class="form-control" id="link_tiktok" name="link_tiktok" value="{{ old('link_tiktok', $data->link_tiktok) }}">
                                            <small class="form-text text-muted">Kosongkan jika tidak ada</small>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-action text-end">
                                <a href="{{ route('contact.index') }}" class="btn btn-dark me-2">
                                    <i class="fas fa-arrow-left"></i> Back
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