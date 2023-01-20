<form class="home_banner_form">
    @component('admin.components.forms.input')
        @slot('input_label')
            Heading
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            title
        @endslot
        @slot('input_id')
            banner_title
        @endslot
        @slot('input_placeholder')
            Heading
        @endslot
        @slot('input_value')
            {{ $title_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.textarea')
        @slot('textarea_label')
            Content
        @endslot
        @slot('textarea_id')
            banner_content
        @endslot
        @slot('textarea_name')
            content
        @endslot
        @slot('textarea_placeholder')
            Banner Content
        @endslot
        @slot('textarea_rows')
            5
        @endslot
        @slot('textarea_value')
            {{ $content_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Call to Action
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            call_to_action
        @endslot
        @slot('input_id')
            call_to_action
        @endslot
        @slot('input_placeholder')
            Call to Action
        @endslot
        @slot('input_value')
            {{ $action_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Call to Action Link
        @endslot
        @slot('input_type')
            url
        @endslot
        @slot('input_name')
            link
        @endslot
        @slot('input_id')
            banner_link
        @endslot
        @slot('input_placeholder')
            https://www.link.extension
        @endslot
        @slot('input_value')
            {{ $link_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.submit')
        @slot('submit_id')
            home_banner_submit
        @endslot
        @slot('submit_value')
            Submit
        @endslot
    @endcomponent
</form>