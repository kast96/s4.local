
function initSelectField() {
    $('.js-selectField').each(function() {
        var $element = $(this),
            $select = $element.find('.js-selectField-select'),
            $field = $element.find('.js-selectField-field');

        function _selectFieldReset() {
            $field.prop("disabled", true);
            initFieldDisabled();
            $field.filter('.js-select').selectric('refresh');
        }

        function _selectFieldStart() {
            var data = $select.find(":selected").data('selectfield'),
                $fieldNew = $field.filter('[data-selectfield="' + data + '"]');

            _selectFieldReset();

            if ($fieldNew.is(':disabled')) {
                $fieldNew.prop("disabled", false);
                initFieldDisabled();

                $($fieldNew).filter('.js-select').selectric('refresh');
            }
        }

        _selectFieldStart();

        $select.on('change',function(e) {
            _selectFieldStart();
        });
    });
}

$(document).ready(function () {
    initSelectField();
});
