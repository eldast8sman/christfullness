<form class="event_form" data-id="{{ $data_id }}">
    @component('admin.components.forms.input')
        @slot('input_label')
            Event
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            event
        @endslot
        @slot('input_id')
            event_event
        @endslot
        @slot('input_placeholder')
            Event
        @endslot
        @slot('input_value')
            {{ $event_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Theme
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            theme
        @endslot
        @slot('input_id')
            event_theme
        @endslot
        @slot('input_placeholder')
            Theme
        @endslot
        @slot('input_value')
            {{ $theme_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Start Date
        @endslot
        @slot('input_type')
            date
        @endslot
        @slot('input_name')
            start_date
        @endslot
        @slot('input_id')
            start_date
        @endslot
        @slot('input_placeholder')
            Start Date
        @endslot
        @slot('input_value')
            {{ $start_date_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            End Date
        @endslot
        @slot('input_type')
            date
        @endslot
        @slot('input_name')
            end_date
        @endslot
        @slot('input_id')
            end_date
        @endslot
        @slot('input_placeholder')
            End Date
        @endslot
        @slot('input_value')
            {{ $end_date_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.textarea')
        @slot('textarea_label')
            Time
        @endslot
        @slot('textarea_id')
            event_time
        @endslot
        @slot('textarea_name')
            timing
        @endslot
        @slot('textarea_placeholder')
            Event Time
        @endslot
        @slot('textarea_rows')
            3
        @endslot
        @slot('textarea_value')
            {{ $time_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.textarea')
        @slot('textarea_label')
            Venue
        @endslot
        @slot('textarea_id')
            event_venue
        @endslot
        @slot('textarea_name')
            venue
        @endslot
        @slot('textarea_placeholder')
            Event Venue
        @endslot
        @slot('textarea_rows')
            5
        @endslot
        @slot('textarea_value')
            {{ $venue_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.textarea')
        @slot('textarea_label')
            Details
        @endslot
        @slot('textarea_id')
            event_details
        @endslot
        @slot('textarea_name')
            details
        @endslot
        @slot('textarea_placeholder')
            Event Details
        @endslot
        @slot('textarea_rows')
            7
        @endslot
        @slot('textarea_value')
            {{ $details_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.file_input')
        @slot('input_label')
            Event Photo
        @endslot
        @slot('input_id')
            image_upload
        @endslot
        @slot('input_name')
            file
        @endslot
        @slot('input_accept')
            image/jpg, image/jpeg, image/png
        @endslot
    @endcomponent
    @component('admin.components.forms.submit')
        @slot('submit_id')
            event_submit
        @endslot
        @slot('submit_value')
            Submit
        @endslot
    @endcomponent
</form>