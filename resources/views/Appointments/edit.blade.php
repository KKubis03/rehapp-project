@extends ("main")
@section ("content")
    <div class="container">
        <h2 class="mb-2 text-primary">Edit Appointment</h2>
        <form method="POST" action="/appointments/edit/{{$model->Id}}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Patient</label>
                <select class="form-select" name="Patient">
                    @foreach ($patients as $patient)
                        <option value="{{ $patient->Id }}" {{ (old('Patient') == $patient->Id || (isset($model) && $model->Patient->Id == $patient->Id)) ? 'selected' : '' }}>
                            {{ $patient->FirstName }} {{ $patient->LastName }}
                        </option>
                    @endforeach
                </select>
                @error('Patient')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Service</label>
                <select class="form-select" name="Service">
                    @foreach ($services as $service)
                        <option value="{{$service->Id}}" {{ (old('Service') == $service->Id || (isset($model) && $model->Service->Id == $service->Id)) ? 'selected' : '' }}>
                            {{$service->ServiceName}} {{$service->formattedDuration}}
                        </option>
                    @endforeach
                </select>
                @error('Service')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Physiotherapist</label>
                <select class="form-select" name="Physiotherapist" id="physiotherapist_id">
                    @foreach ($physiotherapists as $physiotherapist)
                        <option value="{{$physiotherapist->Id}}" {{ (old('Physiotherapist') == $physiotherapist->Id || (isset($model) && $model->Physiotherapist->Id == $physiotherapist->Id)) ? 'selected' : '' }}>
                            {{$physiotherapist->FirstName}} {{$physiotherapist->LastName}}
                        </option>
                    @endforeach
                </select>
                @error('Physiotherapist')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Date</label>
                <input type="text" class="form-control w-25" name="Date" value="{{$model->AppointmentDate}}"
                    placeholder="-- Select Date --" id="datepicker">
                @error('Date')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Time</label>
                <select class="form-select" name="Time">
                    <option value="{{$selectedTime}}" selected>{{$selectedTime}}</option>
                    @foreach ($availablehours as $hour)
                        <option value="{{$hour}}">
                            {{$hour}}
                        </option>
                    @endforeach
                </select>
                @error('Time')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <a type="button" class="btn btn-secondary" href="/appointments">Cancel</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <form method="POST" action="/appointments/delete/{{$model->Id}}">
            @csrf
            <button type="submit" class="btn btn-outline-danger">
                <i class="bi bi-trash me-2"></i>Delete
            </button>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            var holidays = [];
            var year = new Date().getFullYear();
            // function to set datepicker from jquery UI library
            function initDatepicker() {
                $("#datepicker").datepicker({
                    dateFormat: "yy-mm-dd",
                    minDate: 0,
                    beforeShowDay: function (date) {
                        var day = date.getDay();
                        var y = date.getFullYear();
                        var m = ("0" + (date.getMonth() + 1)).slice(-2);
                        var d = ("0" + date.getDate()).slice(-2);
                        var formattedDate = y + "-" + m + "-" + d;
                        // Disable weekends
                        if (day === 0 || day === 6) {
                            return [false, "", "Weekend - niedostępne"];
                        }
                        // Disable holidays
                        if (holidays.indexOf(formattedDate) !== -1) {
                            return [false, "", "Święto - niedostępne"];
                        }
                        return [true, ""];
                    },
                    onSelect: function () {
                        fetchAvailableHours();
                    }
                });
            }

            // Download Polish holidays from public API
            $.ajax({
                url: `https://date.nager.at/api/v3/PublicHolidays/${year}/PL`,
                method: 'GET',
                success: function (data) {
                    holidays = data.map(function (holiday) {
                        return holiday.date; // format 'yyyy-mm-dd'
                    });
                    initDatepicker();
                },
                error: function () {
                    alert('Nie udało się pobrać świąt.');
                    holidays = [];
                    initDatepicker();
                }
            });

            const selectedTime = @json($selectedTime);
            // Function to download available hours
            function fetchAvailableHours() {
                const physioSelect = document.getElementById('physiotherapist_id');
                const dateInput = document.querySelector('input[name="Date"]');
                const timeSelect = document.querySelector('select[name="Time"]');

                const physioId = physioSelect.value;
                const date = dateInput.value;

                if (!physioId || !date) {
                    timeSelect.innerHTML = '<option value="">-- Select time --</option>';
                    return;
                }

                fetch(`/appointments/availableHours?Physiotherapist=${physioId}&AppointmentDate=${date}`)
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not OK');
                        return response.json();
                    })
                    .then(hours => {
                        timeSelect.innerHTML = '';

                        if (selectedTime && !hours.includes(selectedTime)) {
                            hours.push(selectedTime);
                        }

                        hours.sort((a, b) => {
                            const [aH, aM] = a.split(':').map(Number);
                            const [bH, bM] = b.split(':').map(Number);
                            return aH !== bH ? aH - bH : aM - bM;
                        });

                        hours.forEach(hour => {
                            const option = document.createElement('option');
                            option.value = hour;
                            option.textContent = hour;

                            if (hour === selectedTime) {
                                option.selected = true;
                                option.classList.add('text-primary');
                            }

                            timeSelect.appendChild(option);
                        });

                        if (hours.length === 0) {
                            timeSelect.innerHTML = '<option value="">No available hours</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching available hours:', error);
                        timeSelect.innerHTML = '<option value="">Error loading hours</option>';
                    });
            }
            // listening to change of selected physiotherapist
            $('#physiotherapist_id').on('change', fetchAvailableHours);
            if ($('#physiotherapist_id').val() && $('#datepicker').val()) {
                fetchAvailableHours();
            }
        });
    </script>
@endsection