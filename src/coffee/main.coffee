

#=include ./lib/jquery.form.coffee


# $.fancybox.open $('#login-register')
# $.fancybox.open $('#register-success')
# $.fancybox.open $('#email-confirm-success')


delay = (ms = 0, cb = ->) ->
    setTimeout cb, ms


$('#form-login').on 'ajax-done', (e, data) ->
    window.location.reload()
    on


$('#form-registr').on 'ajax-done', (e, data) ->
    $.fancybox.close yes
    $.fancybox.open
        src: '#register-success'
        type: 'inline'


$('#form-contrib').on 'ajax-done', (e, data) ->
    $(this).trigger 'reset'
    $.fancybox.close yes
    $.fancybox.open
        src: '#contrib-success'
        type: 'inline'


$('.js-form').form()

# $formAddToCart = $ '#js-form-add-to-cart'

# $formAddToCart.form
#     action: $formAddToCart.attr 'data-action'
#     validate: off
# .on 'ajax-done', (e, data) ->
#     console.log data
#     on



$('*[data-tab]').on 'click', (e) ->
    e.preventDefault()
    $this = $ this
    $this.siblings().each (i, tabBtn) ->
        $tabBtn = $ tabBtn
        $tabBtn.removeClass 'active'
        $("#{$tabBtn.attr 'data-tab'}").addClass 'd-none'
    $this.addClass 'active'
    $("#{$this.attr 'data-tab'}").removeClass 'd-none'
    off


$('*[data-mask]').each (i, input) ->
    $input = $ input
    $input.inputmask "#{$input.attr 'data-mask'}"
    on


$('.js-slider').slick
    # useTransform: yes
    # waitForAnimate: no
    autoplay: on
    speed: 300
    arrows: off
    dots: off
    centerMode: on
    focusOnSelect: yes
    slidesToShow: 3
    slidesToScroll: 1
    centerPadding: '0'
    mobileFirst: yes
    infinite: on
    responsive: [
        {
            breakpoint: 991
            settings:
                centerPadding: '170px'
        }
        {
            breakpoint: 1499
            settings:
                centerPadding: '199px'
        }
    ]



$('.js-slider-view').each (i, sliderView) ->
    $sliderView = $ sliderView
    idNav = $sliderView.attr 'data-nav'
    $sliderView.slick
        autoplay: off
        dots: off
        speed: 300
        lazyLoad: 'ondemand'
        # lazyLoad: 'progressive'
        slidesToShow: 1
        slidesToScroll: 1
        arrows: off
        fade: on
        asNavFor: idNav
        infinite: on
    on


$('.js-slider-nav').each (i, sliderNav) ->
    $sliderNav = $ sliderNav
    idView = $sliderNav.attr 'data-view'
    $sliderNav.slick
        # lazyLoad: 'ondemand'
        # lazyLoad: 'progressive'
        infinite: on
        autoplay: off
        speed: 300
        slidesToShow: 3
        slidesToScroll: 1
        asNavFor: idView
        dots: off
        arrows: off
        centerMode: true
        focusOnSelect: true
    on


$('*[data-toggle]').on 'click', (e) ->
    e.preventDefault()
    $this = $ this
    $("#{$this.attr 'data-parent'}").toggleClass 'toggle-active'
    $this.toggleClass 'active'
    $("#{$this.attr 'data-toggle'}").toggleClass 'active'
    off


$header = $ '#header-1'
$navbar = $ '#navbar-1'


$(window).on 'scroll', (e) ->
    offset = 15
    scrollTopNum = $(this).scrollTop()
    if scrollTopNum > offset
        $header.addClass 'onscroll' 
        $navbar.addClass 'onscroll' 
        return on
    if scrollTopNum < offset
        $header.removeClass 'onscroll'
        $navbar.removeClass 'onscroll'
    on

