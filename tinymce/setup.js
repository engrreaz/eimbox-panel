tinymce.init({
    selector: 'textarea#default',
    width: 1000,
    height: 500,
    resize: 'height',
    toolbar: 'language',
    browser_spellcheck: true,
    allow_html_in_named_anchor: true,
    content_langs: [
        { title: 'Bengali', code: 'bn' }, { title: 'English', code: 'en' }

    ],
    plugins: [
        'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
        'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
        'table', 'emoticons', 'template', 'codesample'
    ],
    typography_ignore: ["blockquote", "PLUS", "singlequote"],
    toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify |' +
        'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
        'forecolor backcolor emoticons',
    menu: {
        favs: { title: 'menu', items: 'code visualaid | searchreplace | emoticons' }
    },
    menubar: 'favs file edit view insert format tools table',
    content_style: 'body{font-family:Helvetica,Arial,sans-serif; font-size:14px}'
});