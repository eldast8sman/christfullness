<form class="photo_form" data-id="{{ $data_id }}" enctype="multipart/form-data">
    @component('admin.components.forms.file_input')
        @slot('input_label')
            Photo
        @endslot
        @slot('input_id')
            image_upload
        @endslot
        @slot('input_name')
            filepath
        @endslot
        @slot('input_accept')
            image/jpg, image/jpeg, image/png
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Caption
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            caption
        @endslot
        @slot('input_id')
            photo_caption
        @endslot
        @slot('input_placeholder')
            Photo Caption
        @endslot
        @slot('input_value')
            {{ $caption_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.textarea')
        @slot('textarea_label')
            Short Details
        @endslot
        @slot('textarea_id')
            photo_details
        @endslot
        @slot('textarea_name')
            details
        @endslot
        @slot('textarea_placeholder')
            Short Photo Details
        @endslot
        @slot('textarea_rows')
            5
        @endslot
        @slot('textarea_value')
            {{ $details_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.submit')
        @slot('submit_id')
            article_submit
        @endslot
        @slot('submit_value')
            Submit
        @endslot
    @endcomponent
</form>