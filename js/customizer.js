/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
(function($) {
    // Site title and description.
    wp.customize('blogname', function(value) {
        value.bind(function(to) {
            $('.site-title a').text(to);
        });
    });
    wp.customize('blogdescription', function(value) {
        value.bind(function(to) {
            $('.site-description').text(to);
        });
    });
    // Header text color.
    wp.customize('header_textcolor', function(value) {
        value.bind(function(to) {
            if ('blank' === to) {
                $('.site-title a, .site-description').css({
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                });
            } else {
                $('.site-title a, .site-description').css({
                    'clip': 'auto',
                    'color': to,
                    'position': 'relative'
                });
            }
        });
    });
    
    // Header text color.
    wp.customize('header_textcolor', function(value) {
        value.bind(function(to) {
            if ('blank' === to) {
                $('.site-title a, .site-description').css({
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                });
            } else {
                $('.site-title a, .site-description').css({
                    'clip': 'auto',
                    'color': to,
                    'position': 'relative'
                });
            }
        });
    });

    wp.customize('menu_textcolor', function(value) {
        value.bind(function(to) {
            $('.main-navigation ul a, .main-navigation ul a:hover, .menu-toggle').css({
                'background-color': to
            });
        });
    });   

    wp.customize('main_avatar', function(value) {
        value.bind(function(to) {
            if (to == '') {
                $('.avatar').remove();
            }
            if ($('img').hasClass('.avatar') == true) {
                $('.avatar').attr("src", to);
            } else if (to != '') {
                $('.site-title').before('<img width="190" class="avatar" src="">')
                $('.avatar').attr("src", to);
            }
        });
    });    

    wp.customize('pagetitle_backgroundcolor', function(value) {
        value.bind(function(to) {

            $('.page-title').css({
                'background-color': to
            });

        });
    });

    wp.customize('sidebar_alignment', function(value) {
        value.bind(function(to) {
            if ('right' === to) {
                $('#primary').css({
                    'float': 'left'
                });
                $('#secondary').css({
                    'float': 'right'
                });
            } else {
                $('#primary').css({
                    'float': 'right'
                });
                $('#secondary').css({
                    'float': 'left'
                });
            }
        });
    });

})(jQuery);