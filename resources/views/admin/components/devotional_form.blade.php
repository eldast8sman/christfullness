<form class="devotional_form" data-id="{{ $data_id }}">
    @component('admin.components.forms.input')
        @slot('input_label')
            Devotional Date
        @endslot
        @slot('input_type')
            date
        @endslot
        @slot('input_name')
            devotional_date
        @endslot
        @slot('input_id')
            devotional_date
        @endslot
        @slot('input_placeholder')
            Devotional Date
        @endslot
        @slot('input_value')
            {{ $devotional_date_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.select')
        @slot('select_label')
            Minister
        @endslot
        @slot('select_name')
            minister_id
        @endslot
        @slot('select_id')
            minister_id
        @endslot
        @slot('select_options')
            <option value="">--Minister--</option>
            {{ $minister_options }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Devotional Topic
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            topic
        @endslot
        @slot('input_id')
            topic
        @endslot
        @slot('input_placeholder')
            Devotional Topic
        @endslot
        @slot('input_value')
            {{ $topic_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Bible Text
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            bible_text
        @endslot
        @slot('input_id')
            bible_text
        @endslot
        @slot('input_placeholder')
            Bible Text
        @endslot
        @slot('input_value')
            {{ $bible_text_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.input')
        @slot('input_label')
            Memory Verse Text
        @endslot
        @slot('input_type')
            text
        @endslot
        @slot('input_name')
            memory_verse_text
        @endslot
        @slot('input_id')
            memory_verse_text
        @endslot
        @slot('input_placeholder')
            Memory Verse Text
        @endslot
        @slot('input_value')
            {{ $memory_verse_text_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.textarea')
        @slot('textarea_label')
            Memory Verse
        @endslot
        @slot('textarea_id')
            memory_verse
        @endslot
        @slot('textarea_name')
            memory_verse
        @endslot
        @slot('textarea_placeholder')
            Memory Verse
        @endslot
        @slot('textarea_rows')
            4
        @endslot
        @slot('textarea_value')
            {{ $memory_verse_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.textarea')
        @slot('textarea_label')
            Devotional
        @endslot
        @slot('textarea_id')
            devotional
        @endslot
        @slot('textarea_name')
            devotional
        @endslot
        @slot('textarea_placeholder')
            Devotional
        @endslot
        @slot('textarea_rows')
            10
        @endslot
        @slot('textarea_value')
            {{ $devotional_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.textarea')
        @slot('textarea_label')
            Further Reading
        @endslot
        @slot('textarea_id')
            further_reading
        @endslot
        @slot('textarea_name')
            further_reading
        @endslot
        @slot('textarea_placeholder')
            Further Reading
        @endslot
        @slot('textarea_rows')
            4
        @endslot
        @slot('textarea_value')
            {{ $further_reading_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.textarea')
        @slot('textarea_label')
            Prayers
        @endslot
        @slot('textarea_id')
            prayers
        @endslot
        @slot('textarea_name')
            prayers
        @endslot
        @slot('textarea_placeholder')
            Prayers
        @endslot
        @slot('textarea_rows')
            5
        @endslot
        @slot('textarea_value')
            {{ $prayers_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.submit')
        @slot('submit_id')
            devotional_submit
        @endslot
        @slot('submit_value')
            Submit
        @endslot
    @endcomponent
</form>