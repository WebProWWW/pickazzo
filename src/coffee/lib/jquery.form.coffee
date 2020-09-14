
do () ->


    $ = window.jQuery


    config =
        method: 'post'
        loaderImg: '<img class="loader-img" src="/img/loader-white.svg">'
        emailRegex: /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i


    class jQueryForm

        backLoaderHtml: ''

        constructor: (form, @options) ->
            # @csrfParam = $('meta[name="csrf-param"]').attr 'content'
            # @csrfToken = $('meta[name="csrf-token"]').attr 'content'
            @$form = $ form
            @id = @$form.attr 'id'
            @$form.on 'submit', @onFormSubmit

        onFormSubmit: (e) =>
            e.preventDefault()
            @sendForm() if @validateInputs()
            off

        validateInputs: () ->
            $inputs = @$form.find '[data-validate]'
            result = on
            $inputs.each (i, input) =>
                $input = $ input
                validate = $input.attr 'data-validate'
                inputVal = $input.val()
                inputRes = switch validate
                    when 'text' then inputVal.length > 0
                    when 'email' then @options.emailRegex.test inputVal
                    else on
                unless inputRes
                    result = no
                    $input.addClass 'error'
                    $input.one 'focusin', (e) =>
                        $(e.target).removeClass 'error'
                on
            result

        addErrors: (errors) ->
            for key, val of errors
                @$form.find("##{key}-error").html """<span class="input-error">#{val[0]}</span>"""
                @$form.find("##{key}").addClass('error').one 'focusin change', (e) =>
                    $target = $ e.target
                    $target.removeClass 'error'
                    $("##{$target.attr 'id'}-error").html ''
                    on
            on

        sendForm: () ->
            $loader = @$form.find '[data-loader]'
            @backLoaderHtml = $loader.html()
            $loader.html @options.loaderImg
            $.ajax
                method: 'post'
                url: @$form.attr 'data-action'
                data: @$form.serialize()
            .done (data) =>
                if data?.success? and data.success is yes
                    @$form.trigger 'ajax-done', [data]
                if data?.errors? and typeof data.errors is 'object'
                    @addErrors data.errors
                    @$form.trigger 'ajax-error', [data]
                on
            .fail (jqXHR, textStatus) =>
                @$form.trigger 'ajax-fail'
                on
            .always () =>
                $loader.html @backLoaderHtml
                @$form.trigger 'ajax-always'
                on
            off


    $.fn.extend
        form: (options={}) ->
            this.each (i, form) ->
                $form = $ form
                new jQueryForm form, $.extend({}, config, options)
                on
