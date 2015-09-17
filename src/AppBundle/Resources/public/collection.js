(function ($) {
    
    $('[data-prototype]').each(function () {
        var container = $(this);
        var prototype = $(this).data('prototype');

        $('[data-add=' + $(this).attr('id') + ']').click(function () {
            var index   = container.data('children');
            var content = prototype.replace(/__name__/g, index.toString());

            container.data('children', index + 1);
            var element = $(content);

            container.append(element);
        });

        $(container).on('click', '[data-remove]', function () {
            var target = $(this).data('remove');

            $('#' + target).remove();
        });
    });

})(window.jQuery);
