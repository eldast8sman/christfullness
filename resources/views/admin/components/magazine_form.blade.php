<form class="magazine_form" data-id="{{ $data_id }}" enctype="multipart/form-data">
    @component('admin.components.forms.input')
        @slot('input_label')
            Magazine Title
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            title
        @endslot
        @slot('input_id')
            magazine_title
        @endslot
        @slot('input_placeholder')
            Title
        @endslot
        @slot('input_value')
            {{ $title_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Publication Date
        @endslot
        @slot('input_type')
            date
        @endslot
        @slot('input_name')
            publication_date
        @endslot
        @slot('input_id')
            publication_date
        @endslot
        @slot('input_placeholder')
            Publication Date
        @endslot
        @slot('input_value')
            {{ $publication_date }}
        @endslot
    @endcomponent
    @component('admin.components.forms.textarea')
        @slot('textarea_label')
            Short Summary
        @endslot
        @slot('textarea_id')
            magazine_summary
        @endslot
        @slot('textarea_name')
            summary
        @endslot
        @slot('textarea_placeholder')
            Short Summary of the Magazine
        @endslot
        @slot('textarea_rows')
            5
        @endslot
        @slot('textarea_value')
            {{ $summary_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.file_input')
        @slot('input_label')
            Magazine PDF file
        @endslot
        @slot('input_name')
            pdf_file
        @endslot
        @slot('input_id')
            pdf_upload
        @endslot
        @slot('input_accept')
            application/pdf
        @endslot
    @endcomponent
    @component('admin.components.forms.file_input')
        @slot('input_label')
            COver Photo
        @endslot
        @slot('input_id')
            image_upload
        @endslot
        @slot('input_name')
            image_file
        @endslot
        @slot('input_accept')
            image/jpg, image/jpeg, image/png
        @endslot
    @endcomponent
    @component('admin.components.forms.submit')
        @slot('submit_id')
            magazine_submit
        @endslot
        @slot('submit_value')
            Submit
        @endslot
    @endcomponent
</form>