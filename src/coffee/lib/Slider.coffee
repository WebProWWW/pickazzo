
# class Slider
#     config:
#         items: 1
#         responsive:
#             sm:
#                 items: 1
#             md:
#                 items: 1
#             lg:
#                 items: 1
#             xl:
#                 items: 1

#     constructor: (el, options) ->
#         @$ = $ el
#         @$window = $ window
#         $.extend @config, options
#         @render()
#         @$window.on 'resize', @render

#     render: (e) =>
#         windowW = @$window.width()
#         config = switch yes
#             when 576  >= windowW then $.extend {}, @config, @config.responsive.sm
#             when 768  >= windowW then $.extend {}, @config, @config.responsive.md
#             when 992  >= windowW then $.extend {}, @config, @config.responsive.lg
#             when 1200 >= windowW then $.extend {}, @config, @config.responsive.xl
#             else @config
#         width = @$.width()
#         imgW = width / config.items
#         @$.find('img').width imgW
#         on


