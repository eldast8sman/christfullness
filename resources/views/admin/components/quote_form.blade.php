<form class="quote_form" data-id="{{ $data_id }}">
    @component('admin.components.forms.textarea')
        @slot('textarea_label')
            Quote
        @endslot
        @slot('textarea_id')
            quote_quote
        @endslot
        @slot('textarea_name')
            quote
        @endslot
        @slot('textarea_placeholder')
            Quote
        @endslot
        @slot('textarea_rows')
            3
        @endslot
        @slot('textarea_value')
            {{ $quote_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Author
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            author
        @endslot
        @slot('input_id')
            quote_author
        @endslot
        @slot('input_placeholder')
            Quote Author
        @endslot
        @slot('input_value')
            {{ $author_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Author Title
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            author_title
        @endslot
        @slot('input_id')
            author_title
        @endslot
        @slot('input_placeholder')
            Author Title
        @endslot
        @slot('input_value')
            {{ $title_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.file_input')
        @slot('input_label')
            Author Photo
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
            quote_submit
        @endslot
        @slot('submit_value')
            Submit
        @endslot
    @endcomponent
</form>