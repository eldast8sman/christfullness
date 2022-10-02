<form class="video_form" data-id="{{ $data_id }}">
    @component('admin.components.forms.input')
        @slot('input_label')
            Video Title
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            title
        @endslot
        @slot('input_id')
            video_title
        @endslot
        @slot('input_placeholder')
            Video Title
        @endslot
        @slot('input_value')
            {{ $title_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.select')
        @slot('select_label')
            Platform
        @endslot
        @slot('select_name')
            platform
        @endslot
        @slot('select_id')
            video_platform
        @endslot
        @slot('select_options')
            <option value="">--Platform--</option>
            {{ $platform_options }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
        Video Link
        @endslot
        @slot('input_type')
            url
        @endslot
        @slot('input_name')
            link
        @endslot
        @slot('input_id')
            video_link
        @endslot
        @slot('input_placeholder')
            Video Link
        @endslot
        @slot('input_value')
            {{ $link_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.textarea')
        @slot('textarea_label')
            Details
        @endslot
        @slot('textarea_id')
            video_details
        @endslot
        @slot('textarea_name')
            details
        @endslot
        @slot('textarea_placeholder')
            Short Description of the Video
        @endslot
        @slot('textarea_rows')
            5
        @endslot
        @slot('textarea_value')
            {{ $video_details_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.submit')
        @slot('submit_id')
            video_submit
        @endslot
        @slot('submit_value')
            Submit
        @endslot
    @endcomponent
</form>