<form class="header_form" data-id="{{ $data_id }}">
    @component('admin.components.forms.input')
        @slot('input_label')
            Page
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            page
        @endslot
        @slot('input_id')
            page_page
        @endslot
        @slot('input_placeholder')
            Page Name
        @endslot
        @slot('input_value')
            {{ $page_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Page Title
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            title
        @endslot
        @slot('input_id')
            page_title
        @endslot
        @slot('input_placeholder')
            Page Title
        @endslot
        @slot('input_value')
            {{ $title_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.file_input')
        @slot('input_label')
            Header Image
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
            page_header_submit
        @endslot
        @slot('submit_value')
            Submit
        @endslot
    @endcomponent
</form>