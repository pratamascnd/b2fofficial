@extends("layout.dashboard.main")

@section("title", "Create Schedule - B2F Official")
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
                    <li class="nav-item"><a class="text-dark font-weight-bold">Create Schedule</a></li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><div class="card-title">Form Create Schedule</div></div>
            <form action="{{ route('streamer-schedule.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    {{-- Select Streamer --}}
                    <div class="form-group mb-4">
                        <label for="streamer_id" class="fw-bold">Pilih Streamer</label>
                        <select name="streamer_id" id="streamer_id" class="form-control @error('streamer_id') is-invalid @enderror">
                            <option value="">-- Pilih Streamer --</option>
                            @foreach($streamers as $s)
                                <option value="{{ $s->id }}" {{ old('streamer_id') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                            @endforeach
                        </select>
                        @error('streamer_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Table Input --}}
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 15%">Hari</th>
                                    <th style="width: 20%">Tanggal</th>
                                    <th style="width: 15%">Waktu (WIB)</th>
                                    <th>Agenda / Game</th>
                                    <th style="width: 15%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']; @endphp
                                @foreach($days as $index => $day)
                                <tr>
                                    <td class="align-middle fw-bold">{{ $day }}</td>
                                    <td>
                                        <input type="date" name="schedules[{{ $index }}][date]" id="date_{{ $index }}" class="form-control" value="{{ old('schedules.'.$index.'.date') }}" @if($index > 0) readonly @endif required>
                                    </td>
                                    <td>
                                        <input type="time" name="schedules[{{ $index }}][start_time]" id="time_{{ $index }}" class="form-control" value="{{ old('schedules.'.$index.'.start_time') ? \Carbon\Carbon::parse(old('schedules.'.$index.'.start_time'))->format('H:i') : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" name="schedules[{{ $index }}][agenda]" id="agenda_{{ $index }}" class="form-control" placeholder="Contoh: Mobile Legends" value="{{ old('schedules.'.$index.'.agenda') }}">
                                    </td>
                                    <td>
                                        <select name="schedules[{{ $index }}][status]" id="status_{{ $index }}" class="form-control" onchange="toggleReadonly({{ $index }})">
                                            <option value="streaming" {{ old('schedules.'.$index.'.status') == 'streaming' ? 'selected' : '' }}>Streaming</option>
                                            <option value="off_day" {{ old('schedules.'.$index.'.status') == 'off_day' ? 'selected' : '' }}>Off Day</option>
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-action text-end">
                    <a href="{{ route('streamer-schedule.index') }}" class="btn btn-dark me-2"><i class="fas fa-arrow-left"></i> Back</a>
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
            
            if (agendaInput.value === 'LIBUR / OFF DAY') {
                agendaInput.value = '';
            }

            timeInput.style.backgroundColor = '#fff';
            agendaInput.style.backgroundColor = '#fff';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        @foreach($days as $index => $day)
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
                title: 'Tanggal Tidak Sesuai',
                text: 'Baris pertama harus dimulai dari hari SENIN. Silakan pilih tanggal yang tepat.',
                confirmButtonColor: '#feb801', 
            });
            
            this.value = '';
            
            for(let i = 1; i <= 6; i++) {
                document.getElementById('date_' + i).value = '';
            }
            return;
        }

        for(let i = 1; i <= 6; i++) {
            let nextDate = new Date(selectedDate);
            nextDate.setDate(selectedDate.getDate() + i);
            document.getElementById('date_' + i).value = nextDate.toISOString().split('T')[0];
        }
    });
</script>
@endsection