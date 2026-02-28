@extends("layout.dashboard.main")

@section("title", "Streamer Schedule - B2F Official")
@section("namepage", "Streamer Schedule")
@section("content")

<div class="container">
    <div class="page-inner">
        <div class="d-md-flex align-items-center justify-content-between mb-4 mt-1">
            <div>
                <ul class="breadcrumbs p-0 m-0 d-flex align-items-center list-unstyled">
                    <li class="nav-home"><a href="{{ route('dashboard.index') }}" class="text-secondary"><i class="icon-home"></i></a></li>
                    <li class="separator px-2"><i class="icon-arrow-right" style="font-size: 12px"></i></li>
                    <li class="nav-item"><a class="text-dark font-weight-bold">Schedule</a></li>
                </ul>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('streamer-schedule.create') }}" class="btn btn-b2f d-flex align-items-center shadow-sm">
                    <i class="fas fa-plus me-2"></i>
                    <span>Add Schedule</span>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4 class="card-title">Data Schedule</h4></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Streamer Name</th>
                                        <th>Weekly Range</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedules as $groupKey => $items)
                                    @php 
                                        $firstItem = $items->first();
                                        $startDate = \Carbon\Carbon::parse($items->min('date'))->format('d M');
                                        $endDate = \Carbon\Carbon::parse($items->max('date'))->format('d M Y');
                                        // Buat ID unik yang aman untuk selector CSS (tanpa titik atau spasi)
                                        $safeId = $firstItem->id; 
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $firstItem->streamer->image) }}" 
                                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                        </td>
                                        <td>
                                            <span class="fw-bold">{{ $firstItem->streamer->name }}</span><br>
                                            <small class="text-muted">{{ $firstItem->streamer->full_name }}</small>
                                        </td>
                                        <td>
                                           {{ $startDate }} - {{ $endDate }}
                                        </td>
                                        <td class="text-center">
                                            <div class="form-button-action">
                                                <button class="btn btn-link btn-info p-1 me-3" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#detailSchedule{{ $safeId }}" 
                                                        title="View Full Schedule">
                                                    <i class="fa fa-eye"></i>
                                                </button>

                                                <a href="{{ route('streamer-schedule.edit', $firstItem->id) }}" class="btn btn-link btn-primary p-1 me-3" title="Edit Paket">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                
                                                <form action="{{ route('streamer-schedule.destroy', $firstItem->id) }}" method="POST" class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-link btn-danger p-1" id="delete">
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

{{-- MODAL SECTION: Dipindah ke luar tabel namun tetap di dalam loop utama --}}
@foreach ($schedules as $groupKey => $items)
    @php $firstItem = $items->first(); @endphp
    <div class="modal fade" id="detailSchedule{{ $firstItem->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 bg-b2f text-white">
                    <h5 class="modal-title fw-bold">Schedule: {{ $firstItem->streamer->name }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Hari</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Agenda</th>
                                    <th class="pe-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $detail)
                                <tr>
                                    <td class="ps-4 fw-bold">{{ \Carbon\Carbon::parse($detail->date)->locale('id')->translatedFormat('l') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($detail->date)->format('d M Y') }}</td>
                                    <td>{{ $detail->start_time ? \Carbon\Carbon::parse($detail->start_time)->format('H:i') : '-' }}</td>
                                    <td>{{ $detail->agenda }}</td>
                                    <td class="pe-4">
                                        @if($detail->status == 'streaming')
                                            <span class="badge badge-success">Streaming</span>
                                        @else
                                            <span class="badge badge-danger">Off Day</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection