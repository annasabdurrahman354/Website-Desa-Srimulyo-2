<div wire:ignore>
    <div class="flatpickr flatpickr-{{ $attributes['id'] }} relative">
        @if(!isset($attributes['required']))
            <div class="absolute inset-y-0 left-0 flex items-center">
                <button id="clear-{{ $attributes['id'] }}" type="button" class="text-rose-600 w-10 h-full" data-clear>
                    <i class="far fa-times-circle"></i>
                </button>
            </div>
        @endif
        <div class="relative max-w-sm">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
            </div>
            <input data-input datepicker required type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pilih tanggal">
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener("livewire:load", () => {
    function update(value) {
        let el = document.getElementById('clear-{{ $attributes['id'] }}')

        if (value === '') {
            value = null

            if (el !== null) {
                el.classList.add('invisible')
            }
        } else if (el !== null) {
            el.classList.remove('invisible')
        }

@this.set('{{ $attributes['wire:model'] }}', value)
    }

@if($attributes['picker'] === 'date')
        let el = flatpickr('.flatpickr-{{ $attributes['id'] }}', {
            dateFormat: "{{ config('project.flatpickr_date_format') }}",
            wrap: true,
            onChange: (SelectedDates, DateStr, instance) => {
                update(DateStr)
            },
            onReady: (SelectedDates, DateStr, instance) => {
                update(DateStr)
            }
        })
@elseif($attributes['picker'] === 'time')
        let el = flatpickr('.flatpickr-{{ $attributes['id'] }}', {
            enableTime: true,
            // enableSeconds: true,
            noCalendar: true,
            time_24hr: true,
            wrap: true,
            dateFormat: "{{ config('project.flatpickr_time_format') }}",
            onChange: (SelectedDates, DateStr, instance) => {
                update(DateStr)
            },
            onReady: (SelectedDates, DateStr, instance) => {
                update(DateStr)
            }
        })
@else
        let el = flatpickr('.flatpickr-{{ $attributes['id'] }}', {
            enableTime: true,
            time_24hr: true,
            wrap: true,
            // enableSeconds: true,
            dateFormat: "{{ config('project.flatpickr_datetime_format') }}",
            onChange: (SelectedDates, DateStr, instance) => {
                update(DateStr)
            },
            onReady: (SelectedDates, DateStr, instance) => {
                update(DateStr)
            }
        })
@endif
});
    </script>
@endpush