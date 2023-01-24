<form class="about_us_form" data-id="{{ $data_id }}">
    @component('admin.components.forms.select')
        @slot('select_label')
            Position
        @endslot
        @slot('select_name')
            position
        @endslot
        @slot('select_id')
            about_position
        @endslot
        @slot('select_options')
            <option value="">--App. Position--</option>
            {{ $select_options }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Section Heading
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            heading
        @endslot
        @slot('input_id')
            about_heading
        @endslot
        @slot('input_placeholder')
            Heading
        @endslot
        @slot('input_value')
            {{ $heading_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.textarea')
        @slot('textarea_label')
            Section Content
        @endslot
        @slot('textarea_id')
            about_content
        @endslot
        @slot('textarea_name')
            content
        @endslot
        @slot('textarea_placeholder')
            Section Content
        @endslot
        @slot('textarea_rows')
            10
        @endslot
        @slot('textarea_value')
            {{ $content_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.file_input')
        @slot('input_label')
            Section Photo
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
            about_submit
        @endslot
        @slot('submit_value')
            Submit
        @endslot
    @endcomponent
</form>