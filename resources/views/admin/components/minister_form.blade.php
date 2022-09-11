<form class="minister_form" enctype="multipart/form-data">
    <input type="hidden" id="action" value="{{ $action }}" />
    @component('admin.components.forms.select')
        @slot('select_label')
            Appearance Position
        @endslot
        @slot('select_name')
            appearance
        @endslot
        @slot('select_id')
            minister_appearance
        @endslot
        @slot('select_options')
            <option value="">--Appearance Position--</option>
            {{ $appearance_options }}
        @endslot
    @endcomponent
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
            minister_title
        @endslot
        @slot('input_placeholder')
            Title of Minister
        @endslot
        @slot('input_value')
            {{ $title_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Name
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
           name
        @endslot
        @slot('input_id')
            minister_name
        @endslot
        @slot('input_placeholder')
            Name of Minister
        @endslot
        @slot('input_value')
            {{ $name_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Post
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
           position
        @endslot
        @slot('input_id')
            minister_position
        @endslot
        @slot('input_placeholder')
            Post of Minister in Church
        @endslot
        @slot('input_value')
            {{ $position_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Phone
        @endslot
        @slot('input_type')
            tel
        @endslot
        @slot('input_name')
           phone
        @endslot
        @slot('input_id')
            minister_phone
        @endslot
        @slot('input_placeholder')
            Phone Number of Minister
        @endslot
        @slot('input_value')
            {{ $phone_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Email
        @endslot
        @slot('input_type')
            email
        @endslot
        @slot('input_name')
           email
        @endslot
        @slot('input_id')
            minister_email
        @endslot
        @slot('input_placeholder')
            Email of Minister
        @endslot
        @slot('input_value')
            {{ $email_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.textarea')
        @slot('textarea_label')
            About
        @endslot
        @slot('textarea_id')
            minister_about
        @endslot
        @slot('textarea_name')
            about
        @endslot
        @slot('textarea_placeholder')
            Short Description
        @endslot
        @slot('textarea_rows')
            5
        @endslot
        @slot('textarea_value')
            {{ $about_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.select')
        @slot('select_label')
            Status
        @endslot
        @slot('select_name')
            status
        @endslot
        @slot('select_id')
            minister_status
        @endslot
        @slot('select_options')
            <option value="">--Status--</option>
            {{ $status_options }}
        @endslot
    @endcomponent
    @component('admin.components.forms.file_input')
        @slot('input_label')
            Photo
        @endslot
        @slot('input_id')
            minister_file
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
            minister_submit
        @endslot
        @slot('submit_value')
            Submit
        @endslot
    @endcomponent
</form>