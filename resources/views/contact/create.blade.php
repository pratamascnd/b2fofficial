@extends("layout.dashboard.main")

@section("title", "Create Contact - B2F Official")
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
                            <a class="text-dark font-weight-bold">Create Contact</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @if($isMax)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i> Perhatian!</strong> 
                        Data contact sudah tersedia. Anda tidak dapat menambah data lagi. 
                        Silahkan <strong>Edit</strong> data yang sudah ada atau hapus data lama untuk menambah ulang.
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Create Contact</div>
                        </div>
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    {{-- No Whatsapp --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_whatsapp">No Whatsapp</label>
                                            <input type="text" class="form-control" id="no_whatsapp" name="no_whatsapp" placeholder="Enter No Whatsapp" value="{{ old('no_whatsapp') }}">
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ old('email') }}">
                                        </div>
                                    </div>

                                    {{-- Link Instagram --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link_instagram">Link Instagram</label>
                                            <input type="text" class="form-control" id="link_instagram" name="link_instagram" placeholder="Enter Link Instagram" value="{{ old('link_instagram') }}">
                                            <small class="form-text text-muted">Kosongkan jika tidak ada</small>
                                        </div>
                                    </div>

                                    {{-- Link Tiktok --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link_tiktok">Link Tiktok</label>
                                            <input type="text" class="form-control" id="link_tiktok" name="link_tiktok" placeholder="Enter Link Tiktok" value="{{ old('link_tiktok') }}">
                                            <small class="form-text text-muted">Kosongkan jika tidak ada</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-action text-end">
                                <a href="{{ route('contact.index') }}" class="btn btn-dark me-2">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                                <button type="reset" class="btn btn-danger me-2"><i class="fas fa-sync"></i> Reset</button>
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