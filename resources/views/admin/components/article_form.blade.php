<form class="article_form" data-id="{{ $data_id }}" enctype="multipart/form-data">
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
            article_title
        @endslot
        @slot('input_placeholder')
            Article Title
        @endslot
        @slot('input_value')
            {{ $title_value }}
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
            article_author
        @endslot
        @slot('input_placeholder')
            Article Author
        @endslot
        @slot('input_value')
            {{ $author_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.wysiwyg_textarea')
        @slot('textarea_label')
            Article
        @endslot
        @slot('textarea_id')
            article_article
        @endslot
        @slot('textarea_name')
            article
        @endslot
        @slot('textarea_placeholder')
            Article
        @endslot
        @slot('textarea_rows')
            10
        @endslot
        @slot('textarea_value')
            {{ $article_value }}
        @endslot
    @endcomponent
    @component('admin.components.forms.file_input')
        @slot('input_label')
            Article Image
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
    @component('admin.components.forms.input')
        @slot('input_label')
            Publication Date
        @endslot
        @slot('input_type')
            date
        @endslot
        @slot('input_name')
            published
        @endslot
        @slot('input_id')
            article_published
        @endslot
        @slot('input_placeholder')
            Publication Date
        @endslot
        @slot('input_value')
            {{ $published_value }}
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