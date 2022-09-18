<form class="book_form" data-id="{{ $data_id }}" enctype="multipart/form-data">
    @component('admin.components.forms.input')
        @slot('input_label')
            Book Title
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            title
        @endslot
        @slot('input_id')
            book_title
        @endslot
        @slot('input_placeholder')
            Book Title
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
            book_summary
        @endslot
        @slot('textarea_name')
            summary
        @endslot
        @slot('textarea_placeholder')
            Short Summary of the Book
        @endslot
        @slot('textarea_rows')
            5
        @endslot
        @slot('textarea_value')
            {{ $summary_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.select')
        @slot('select_label')
            Author
        @endslot
        @slot('select_name')
            minister_id
        @endslot
        @slot('select_id')
            book_author
        @endslot
        @slot('select_options')
            <option value="">--Author--</option>
            {{ $author_options }}
        @endslot
    @endcomponent
    @component('admin.components.forms.file_input')
        @slot('input_label')
            Book PDF file
        @endslot
        @slot('input_name')
            book_path
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
            Book Cover
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
            book_submit
        @endslot
        @slot('submit_value')
            Submit
        @endslot
    @endcomponent
</form>