<form class="series_form" enctype="multipart/form-data">
    <input type="hidden" id="action" value="{{ $action }}" />
    @component('admin.components.forms.input')
        @slot('input_label')
            Title
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            title
        @endslot
        @slot('input_id')
            series_title
        @endslot
        @slot('input_placeholder')
            Series Title
        @endslot
        @slot('input_value')
            {{ $title_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.textarea')
        @slot('textarea_label')
            Description
        @endslot
        @slot('textarea_id')
            series_description
        @endslot
        @slot('textarea_name')
            description
        @endslot
        @slot('textarea_placeholder')
            Short Description
        @endslot
        @slot('textarea_rows')
            5
        @endslot
        @slot('textarea_value')
            {{ $description_value }}
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
            series_start_date
        @endslot
        @slot('input_placeholder')
            
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
            series_end_date
        @endslot
        @slot('input_placeholder')
            
        @endslot
        @slot('input_value')
            {{ $end_date_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.file_input')
        @slot('input_label')
            Album Art
        @endslot
        @slot('input_id')
            series_file
        @endslot
        @slot('input_name')
            filepath
        @endslot
        @slot('input_accept')
            image/jpg, image/jpeg, image/png
        @endslot
    @endcomponent
    @component('admin.components.forms.submit')
        @slot('submit_id')
            series_submit
        @endslot
        @slot('submit_value')
            Submit
        @endslot
    @endcomponent
</form>