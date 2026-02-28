@extends("layout.dashboard.main")

@section("title", "Edit Schedule - B2F Official")
@section("namepage", "Streamer Schedule")
@section("content")
<div class="container">
    <div class="page-inner">
         <div class="d-md-flex align-items-center justify-content-between mb-4 mt-1">
            <div>
                <ul class="breadcrumbs p-0 m-0 d-flex align-items-center list-unstyled">
                    <li class="nav-home"><a href="{{ route('dashboard.index') }}" class="text-secondary"><i class="icon-home"></i></a></li>
                    <li class="separator px-2"><i class="icon-arrow-right" style="font-size: 12px"></i></li>
                    <li class="nav-item"><a href="{{ route('streamer-schedule.index') }}" class="text-b2f font-weight-bold">Schedule</a></li>
                    <li class="separator px-2"><i class="icon-arrow-right" style="font-size: 12px"></i></li>
                    <li class="nav-item"><a class="text-dark font-weight-bold">Edit Schedule</a></li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><div class="card-title">Form Edit Schedule</div></div>
            <form action="{{ route('streamer-schedule.update', $schedule->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label class="fw-bold">Streamer</label>
                        <select name="streamer_id" class="form-control" required>
                            @foreach($streamers as $s)
                                <option value="{{ $s->id }}" {{ $s->id == $schedules->first()->streamer_id ? 'selected' : '' }}>
                                    {{ $s->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Agenda</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $index => $item)
                                <tr>
                                    <td class="align-middle fw-bold">
                                        {{ \Carbon\Carbon::parse($item->date)->locale('id')->translatedFormat('l') }}
                                        <input type="hidden" name="schedules[{{ $index }}][id]" value="{{ $item->id }}">
                                    </td>
                                    <td>
                                        <input type="date" name="schedules[{{ $index }}][date]" id="date_{{ $index }}" class="form-control" value="{{ $item->date }}" {{ $index > 0 ? 'readonly' : '' }} required>
                                    </td>
                                    <td>
                                        <input type="time" name="schedules[{{ $index }}][start_time]" id="time_{{ $index }}" class="form-control" value="{{ $item->start_time ? \Carbon\Carbon::parse($item->start_time)->format('H:i') : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" name="schedules[{{ $index }}][agenda]" id="agenda_{{ $index }}" class="form-control" value="{{ $item->agenda }}">
                                    </td>
                                    <td>
                                        <select name="schedules[{{ $index }}][status]" id="status_{{ $index }}" class="form-control"  onchange="toggleReadonly({{ $index }})">
                                            <option value="streaming" {{ $item->status == 'streaming' ? 'selected' : '' }}>Streaming</option>
                                            <option value="off_day" {{ $item->status == 'off_day' ? 'selected' : '' }}>Off Day</option>
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-action text-end">
                    <a href="{{ route('streamer-schedule.index') }}" class="btn btn-dark me-2">
                        <i class="fas fa-arrow-left me-1"></i>Back
                    </a>
                    <button type="submit" class="btn btn-b2f"><i class="fas fa-save me-1"></i>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('date_0').addEventListener('change', function() {
        let startDate = new Date(this.value);
        for(let i = 1; i <= 6; i++) {
            let nextDate = new Date(startDate);
            nextDate.setDate(startDate.getDate() + i);
            document.getElementById('date_' + i).value = nextDate.toISOString().split('T')[0];
        }
    });
</script>
<script>
    function toggleReadonly(index) {
        const statusSelect = document.getElementById('status_' + index);
        const timeInput = document.getElementById('time_' + index);
        const agendaInput = document.getElementById('agenda_' + index);

        if (statusSelect.value === 'off_day') {
            timeInput.value = ''; 
            agendaInput.value = 'LIBUR / OFF DAY';
            timeInput.readOnly = true;
            agendaInput.readOnly = true;
            timeInput.style.backgroundColor = '#e9ecef';
            agendaInput.style.backgroundColor = '#e9ecef';
        } else {
            timeInput.readOnly = false;
            agendaInput.readOnly = false;
            if (agendaInput.value === 'LIBUR / OFF DAY') agendaInput.value = '';
            timeInput.style.backgroundColor = '#fff';
            agendaInput.style.backgroundColor = '#fff';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        @foreach($schedules as $index => $item)
            toggleReadonly({{ $index }});
        @endforeach
    });
</script>
<script>
    document.getElementById('date_0').addEventListener('change', function() {
        let selectedDate = new Date(this.value);
        let dayOfWeek = selectedDate.getDay(); 

        if (dayOfWeek !== 1) {
            Swal.fire({
                icon: 'error',
                title: 'Tanggal Tidak Valid',
                text: 'Jadwal mingguan harus dimulai dari hari SENIN. Silakan pilih kembali.',
                confirmButtonColor: '#feb801',
            });
            
            this.value = "{{ $schedules[0]->date }}"; 
            return;
        }

        for(let i = 1; i <= 6; i++) {
            let nextDate = new Date(selectedDate);
            nextDate.setDate(selectedDate.getDate() + i);
            document.getElementById('date_' + i).value = nextDate.toISOString().split('T')[0];
        }
    });

    function toggleReadonly(index) {
        const statusSelect = document.getElementById('status_' + index);
        const timeInput = document.getElementById('time_' + index);
        const agendaInput = document.getElementById('agenda_' + index);

        if (statusSelect.value === 'off_day') {
            timeInput.value = ''; 
            agendaInput.value = 'LIBUR / OFF DAY';
            timeInput.readOnly = true;
            agendaInput.readOnly = true;
            timeInput.style.backgroundColor = '#e9ecef';
            agendaInput.style.backgroundColor = '#e9ecef';
        } else {
            timeInput.readOnly = false;
            agendaInput.readOnly = false;
            if (agendaInput.value === 'LIBUR / OFF DAY') agendaInput.value = '';
            timeInput.style.backgroundColor = '#fff';
            agendaInput.style.backgroundColor = '#fff';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        @foreach($schedules as $index => $item)
            toggleReadonly({{ $index }});
        @endforeach
    });
</script>
@endsection