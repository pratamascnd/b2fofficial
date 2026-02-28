@extends("layout.dashboard.main")

@section("title", "Streamer - B2F Official")
@section("namepage", "Streamer")
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
                <ul class="breadcrumbs p-0 m-0 d-flex align-items-center list-unstyled" >
                    <li class="nav-home">
                        <a href="{{ route('dashboard.index') }}" class="text-secondary" >
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator px-2">
                        <i class="icon-arrow-right" style="font-size: 12px" ></i>
                    </li>
                    <li class="nav-item">
                        <a class="text-dark font-weight-bold">
                            Streamer
                        </a>
                    </li>
                </ul>
            </div>

            <div class="mt-3 mt-md-0">
                <a href="{{ route('streamer-profile.create') }}" class="btn btn-b2f d-flex align-items-center shadow-sm" >
                    <i class="fas fa-plus me-2"></i>
                    <span>Add Streamer</span>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Streamer</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="text-center">Image</th> 
                                        <th>Name / Full Name</th>
                                        <th class="text-center">Social Media</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($streamer_profile as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            {{-- Thumbnail Image dengan Modal Trigger --}}
                                            <img src="{{ asset('storage/' . $data->image) }}" 
                                                 class="img-thumbnail-table shadow-sm" 
                                                 data-bs-toggle="modal" 
                                                 data-bs-target="#previewStreamer{{ $data->id }}">
                                        </td>
                                        <td class="fw-bold">{{ $data->name }} / <span class="text-muted fw-normal">{{ $data->full_name }}</span></td>
                                        <td class="text-center">
                                            {{-- Grouping Instagram --}}
                                            @if($data->link_instagram1 || $data->link_instagram2)
                                                <div class="btn-group mb-1 shadow-sm">
                                                    <button class="btn btn-sm btn-outline-danger dropdown-toggle" data-bs-toggle="dropdown"><i class="fas fa-link me-1"></i>Instagram</button>
                                                    <ul class="dropdown-menu">
                                                        @if($data->link_instagram1) <li><a class="dropdown-item" href="{{ $data->link_instagram1 }}" target="_blank">Instagram 1</a></li> @endif
                                                        @if($data->link_instagram2) <li><a class="dropdown-item" href="{{ $data->link_instagram2 }}" target="_blank">Instagram 2</a></li> @endif
                                                    </ul>
                                                </div>
                                            @endif

                                            {{-- Grouping Tiktok --}}
                                            @if($data->link_tiktok1 || $data->link_tiktok2)
                                                <div class="btn-group mb-1 shadow-sm">
                                                    <button class="btn btn-sm btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown"><i class="fas fa-link me-1"></i>Tiktok</button>
                                                    <ul class="dropdown-menu">
                                                        @if($data->link_tiktok1) <li><a class="dropdown-item" href="{{ $data->link_tiktok1 }}" target="_blank">Tiktok 1</a></li> @endif
                                                        @if($data->link_tiktok2) <li><a class="dropdown-item" href="{{ $data->link_tiktok2 }}" target="_blank">Tiktok 2</a></li> @endif
                                                    </ul>
                                                </div>
                                            @endif

                                            {{-- Grouping Youtube --}}
                                            @if($data->link_youtube1 || $data->link_youtube2)
                                                <div class="btn-group mb-1 shadow-sm">
                                                    <button class="btn btn-sm btn-outline-danger dropdown-toggle" data-bs-toggle="dropdown"><i class="fas fa-link me-1"></i>Youtube</button>
                                                    <ul class="dropdown-menu">
                                                        @if($data->link_youtube1) <li><a class="dropdown-item" href="{{ $data->link_youtube1 }}" target="_blank">Youtube 1</a></li> @endif
                                                        @if($data->link_youtube2) <li><a class="dropdown-item" href="{{ $data->link_youtube2 }}" target="_blank">Youtube 2</a></li> @endif
                                                    </ul>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('streamer-profile.edit', $data->id) }}" class="btn btn-link btn-primary p-1 me-3" data-toggle="tooltip" title="Edit Data">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('streamer-profile.destroy', $data->id) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link btn-danger p-1" id="delete" data-toggle="tooltip" title="Delete Data">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Modal Preview Streamer --}}
                                    <div class="modal fade" id="previewStreamer{{ $data->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title fw-bold">Profile: {{ $data->name }}</h5>
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