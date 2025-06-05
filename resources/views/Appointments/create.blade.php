@extends ("main")
@section ("content")
    <div class="container">
        <h2 class="mb-2 text-primary">New Appointment</h2>
        <form method="POST" action="/appointments/create">
            @csrf
            <div class="mb-3">
                <label class="form-label">Patient</label>
                <select class="form-select" name="Patient">
                    @foreach ($patients as $patient)
                        <option value="{{$patient->Id}}" {{ in_array($patient->Id, old('services', [])) ? 'selected' : '' }}>
                            {{$patient->FirstName}} {{$patient->LastName}}
                        </option>
                    @endforeach
                </select>
                @error('Patient')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Physiotherapist</label>
                <select class="form-select" name="Physiotherapist" id="physiotherapist_id">
                    @foreach ($physiotherapists as $physiotherapist)
                        <option value="{{$physiotherapist->Id}}" {{ in_array($physiotherapist->Id, old('services', [])) ? 'selected' : '' }}>{{$physiotherapist->FirstName}} {{$physiotherapist->LastName}}
                        </option>
                    @endforeach
                </select>
                @error('Physiotherapist')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Service</label>
                <select class="form-select" name="Service">
                    @foreach ($services as $service)
                        <option value="{{$service->Id}}" {{ in_array($service->Id, old('services', [])) ? 'selected' : '' }}>
                            {{$service->ServiceName}} {{$service->formattedDuration}}
                        </option>
                    @endforeach
                </select>
                @error('Service')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Date</label>
                <input type="text" class="form-control w-25" name="Date" value="{{ old('Date') }}"
                    placeholder="-- Select Date --" id="datepicker" autocomplete="off">
                @error('Date')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Time</label>
                <select class="form-select" name="Time">
                    @foreach ($availablehours as $hour)
                        <option value="{{$hour}}">{{$hour}}</option>
                    @endforeach
                </select>
                @error('Time')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <a type="button" class="btn btn-secondary" href="/appointments">Cancel</a>
            <button type="submit" class="btn btn-primary">Submit</button>
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
                            return [false, "", "Weekend - non available"];
                        }
                        // Disable holidays
                        if (holidays.indexOf(formattedDate) !== -1) {
                            return [false, "", "Holiday - non available"];
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
                    holidays = [];
                    initDatepicker();
                }
            });

            function fetchPhysiotherapistServices() {
                const physioId = document.getElementById('physiotherapist_id').value;
                const serviceSelect = document.querySelector('select[name="Service"]');

                if (!physioId) {
                    serviceSelect.innerHTML = '<option value="">-- Select physiotherapist first --</option>';
                    return;
                }

                fetch(`/appointments/physiotherapistServices?Physiotherapist=${physioId}`)
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not OK');
                        return response.json();
                    })
                    .then(services => {
                        serviceSelect.innerHTML = '';

                        if (services.length === 0) {
                            serviceSelect.innerHTML = '<option value="">No services available</option>';
                            return;
                        }

                        services.forEach(service => {
                            const option = document.createElement('option');
                            option.value = service.Id;
                            option.textContent = `${service.ServiceName}`;
                            serviceSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching services:', error);
                        serviceSelect.innerHTML = '<option value="">Error loading services</option>';
                    });
            }



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

                        if (hours.length === 0) {
                            timeSelect.innerHTML = '<option value="">No available hours</option>';
                            return;
                        }
                        hours.forEach(hour => {
                            const option = document.createElement('option');
                            option.value = hour;
                            option.textContent = hour;
                            timeSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching available hours:', error);
                        timeSelect.innerHTML = '<option value="">Error loading hours</option>';
                    });
            }
            // listening to change of selected physiotherapist
            $('#physiotherapist_id').on('change', function () {
                fetchAvailableHours();
                fetchPhysiotherapistServices();
            });
            fetchAvailableHours();
            fetchPhysiotherapistServices();
        });
    </script>

@endsection