
var functions = {
    /**
     * @param elem
     * @param _params
     */
    copyText: function(elem) {
        let text = elem.attr('data-value');
        let copiedText = text.trim();
        navigator.clipboard.writeText(copiedText)
            .then(() => {
                elem.addClass('copied_active');
                setTimeout(function() {
                    elem.removeClass('copied_active')
                }, 1000)
            })
            .catch(() => {
                elem.addClass('copied_error');
                setTimeout(function() {
                    elem.removeClass('copied_error')
                }, 1000)
            });
    },
    displaySuccessMessage: function(elem) {
        toastr.success(elem)
    }
};
