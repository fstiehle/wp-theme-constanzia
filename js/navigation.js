/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
(function() {
    var container, button, menu;

    container = document.getElementById('site-navigation');
    if (!container)
        return;

    button = container.getElementsByTagName('a')[0];
    if ('undefined' === typeof button)
        return;

    menu = container.getElementsByTagName('ul')[0];

    // Hide menu toggle button if menu is empty and return early.
    if ('undefined' === typeof menu) {
        button.style.display = 'none';
        return;
    }

    if (-1 === menu.className.indexOf('nav-menu'))
        menu.className += ' nav-menu';

    button.onclick = function() {
        if (-1 !== container.className.indexOf('toggled')) {
            jQuery('.fa-times').removeClass().addClass('fa fa-bars');
            container.className = container.className.replace(' toggled', '');
        } else {
            container.className += ' toggled';
            jQuery('.fa-bars').removeClass().addClass('fa fa-times');
        }
    };
})();