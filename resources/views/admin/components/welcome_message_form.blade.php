<form class="welcome_message_form" enctype="multipart/form-data">
    @component('admin.components.forms.input')
        @slot('input_label')
            Heading
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            heading
        @endslot
        @slot('input_id')
            welcome_heading
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
            Welcome Message
        @endslot
        @slot('textarea_id')
            welcome_message
        @endslot
        @slot('textarea_name')
            content
        @endslot
        @slot('textarea_placeholder')
            Welcome Message
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
            Photo
        @endslot
        @slot('input_id')
            image_upload
        @endslot
        @slot('input_name')
            filename
        @endslot
        @slot('input_accept')
            image/jpg, image/jpeg, image/png
        @endslot
    @endcomponent
    @component('admin.components.forms.submit')
        @slot('submit_id')
            welcome_submit
        @endslot
        @slot('submit_value')
            Submit
        @endslot
    @endcomponent
</form>