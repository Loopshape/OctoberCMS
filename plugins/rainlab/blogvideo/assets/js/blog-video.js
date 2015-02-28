+function ($) { "use strict";
    var VideoTagProcessor = function() {
        this.initHandlers()
    }

    VideoTagProcessor.prototype.initHandlers = function() {
        var self = this

        $(document).on('click', '#blog-post-preview span.video-placeholder', function() {
            var $this = $(this)

            /* 
             * This is an unusual way to display a popup.
             * We use it because the popup contents
             * is loaded from the hidden script element
             */
            $this.popup()

            var popup = $this.data('oc.popup')

            popup.setContent($('script[type="text/template"]', this).html())
            var $textarea = $('textarea', popup.$target),
                placeholderIndex = $this.data('index')


            setTimeout(function(){ 
                popup.setLoading(false)
                $textarea.focus()
            }, 500)

            $('button[type=submit]', popup.$target).click(function() {
                self.embedVideo($textarea, placeholderIndex, $this, popup)
            })
        })
    }

    VideoTagProcessor.prototype.embedVideo = function($textarea, placeholderIndex, $placeholder, popup) {
        var text = $.trim($textarea.val())

        if (!text.length) {
            alert('Please paste the video code to embed.')
            $textarea.focus()
            return
        }

        /* 
         * Calculate the aspect ratio from the iframe width and height
         */

        var widthRegex = /width\s*=\s*"([0-9]+)"/g,
            heightRegex = /height\s*=\s*"([0-9]+)"/g,
            widthMatch = widthRegex.exec(text),
            heightMatch = heightRegex.exec(text),
            ratioClass = null,
            padding = null;

        if (widthMatch && heightMatch && widthMatch.length >= 1 && heightMatch.length >= 1) {
            var ratio = heightMatch[1] / widthMatch[1] * 100

            ratioClass = this.getRatioClass(ratio)

            padding = ratio + '%'
        }

        var $wrapper = $('<div class="video-wrapper"></div>')
        if (ratioClass)
            $wrapper.addClass(ratioClass)
        else
            $wrapper.css('padding-bottom', padding)

        $wrapper.html(text)

        var wrapperText = $('<div>').append($wrapper.clone()).html()

        $.oc.blogPostForm.replacePlaceholder(
            $placeholder,
            wrapperText,
            '!['+placeholderIndex+'](video)',
            wrapperText
        );

        popup.hide()

        return false
    }

    VideoTagProcessor.prototype.getRatioClass = function(ratio) {
        if (Math.abs(ratio-80) < 1)
            return 'ratio-5-4'

        if (Math.abs(ratio-70) < 1)
            return 'ratio-4-3'

        if (Math.abs(ratio-62.5) < 1)
            return 'ratio-16-10'

        if (Math.abs(ratio-56.25) < 1)
            return 'ratio-16-9'

        return false
    }

    $(document).ready(function(){
        new VideoTagProcessor()
    })
}(window.jQuery);