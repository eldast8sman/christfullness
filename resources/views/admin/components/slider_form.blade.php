<form class="slider_form" data-id="{{ $data_id }}">
    @component('admin.components.forms.select')
        @slot('select_label')
            Position
        @endslot
        @slot('select_name')
            position
        @endslot
        @slot('select_id')
            slider_position
        @endslot
        @slot('select_options')
            <option value="">--App. Position--</option>
            {{ $select_options }}
        @endslot
    @endcomponent
    @component('admin.components.forms.file_input')
        @slot('input_label')
            Slider Image
        @endslot
        @slot('input_id')
            image_upload
        @endslot
        @slot('input_name')
            filename
        @endslot
        @slot('input_accept')
            image/jpeg, image/jpg, image/png
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Slider Caption
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            caption
        @endslot
        @slot('input_id')
            slider_caption
        @endslot
        @slot('input_placeholder')
            Slider Caption
        @endslot
        @slot('input_value')
            {{ $caption_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Call To Action
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            call_to_action
        @endslot
        @slot('input_id')
            slider_call_to_action
        @endslot
        @slot('input_placeholder')
            Call To Action
        @endslot
        @slot('input_value')
            {{ $call_to_action_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Action Link
        @endslot
        @slot('input_type')
            url
        @endslot
        @slot('input_name')
            link
        @endslot
        @slot('input_id')
            slider_link
        @endslot
        @slot('input_placeholder')
            https://domain.extension
        @endslot
        @slot('input_value')
            {{ $link_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.submit')
        @slot('submit_id')
            slider_submit
        @endslot
        @slot('submit_value')
            Submit
        @endslot
    @endcomponent
</form>