
var initEditor = ( function() {
    var wysiwygareaAvailable = isWysiwygareaAvailable(),
        isBBCodeBuiltIn = !!CKEDITOR.plugins.get('bbcode');

    CKEDITOR.config.height = 420;
    CKEDITOR.config.width = 'auto';

    return function () {
        var idElement = $('.js-editor').data('editor-id');

        if (idElement) {
            var editorElement = CKEDITOR.document.getById(idElement);

            if (isBBCodeBuiltIn) {
                editorElement.setHtml(
                    'Hello world!\n\n' +
                    'I\'m an instance of [url=https://ckeditor.com]CKEditor[/url].'
                );
            }

            if (wysiwygareaAvailable) {
                CKEDITOR.replace('editor');
            } else {
                editorElement.setAttribute('contenteditable', 'true');
                CKEDITOR.inline('editor');
            }
        }
    };

    function isWysiwygareaAvailable() {
        if (CKEDITOR.revision == ('%RE' + 'V%')) {
            return true;
        }

        return !!CKEDITOR.plugins.get('wysiwygarea');
    }
} )();

$(document).ready(function () {
    initEditor();
});