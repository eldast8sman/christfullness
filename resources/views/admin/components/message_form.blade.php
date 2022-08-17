<form class="message_form" data-id="{{ $data_id }}" enctype="multipart/form-data">
    @component('admin.components.forms.input')
        @slot('input_label')
            Message Title
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            title
        @endslot
        @slot('input_id')
            message_title
        @endslot
        @slot('input_placeholder')
            Message Title
        @endslot
        @slot('input_value')
            {{ $title_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.textarea')
        @slot('textarea_label')
            Short Summary
        @endslot
        @slot('textarea_id')
            message_description
        @endslot
        @slot('textarea_name')
            description
        @endslot
        @slot('textarea_placeholder')
            Short Summary of the Message
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
            Date Preached
        @endslot
        @slot('input_type')
            date
        @endslot
        @slot('input_name')
            date_preached
        @endslot
        @slot('input_id')
            message_date_preached
        @endslot
        @slot('input_placeholder')
            Date the Message was Preached
        @endslot
        @slot('input_value')
            {{ $date_preached_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.select')
        @slot('select_label')
            Series
        @endslot
        @slot('select_name')
            series_id
        @endslot
        @slot('select_id')
            message_series
        @endslot
        @slot('select_options')
            <option value="">--Series--</option>
            {{ $series_options }}
        @endslot
    @endcomponent
    @component('admin.components.forms.select')
        @slot('select_label')
            Minister
        @endslot
        @slot('select_name')
            minister_id
        @endslot
        @slot('select_id')
            message_minister
        @endslot
        @slot('select_options')
            <option value="">--Minister--</option>
            {{ $minister_options }}
        @endslot
    @endcomponent
    @component('admin.components.forms.file_input')
        @slot('input_label')
            Audio File
        @endslot
        @slot('input_id')
            audio_upload
        @endslot
        @slot('input_name')
            audio_path
        @endslot
        @slot('input_accept')
            audio/mp3, audio/mpeg3
        @endslot
    @endcomponent
    @component('admin.components.forms.file_input')
        @slot('input_label')
            Album Art
        @endslot
        @slot('input_id')
            image_upload
        @endslot
        @slot('input_name')
            image_path
        @endslot
        @slot('input_accept')
            image/jpg, image/jpeg, image/png
        @endslot
    @endcomponent
    @component('admin.components.forms.submit')
        @slot('submit_id')
            message_submit
        @endslot
        @slot('submit_value')
            Submit
        @endslot
    @endcomponent
</form>