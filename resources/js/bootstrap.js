
window.Popper = require('popper.js').default;

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');
    
    require('jquery-ui/themes/base/core.css');
    require('jquery-ui/themes/base/datepicker.css');
    require('jquery-ui/themes/base/theme.css');
    var datepicker = require('jquery-ui/ui/widgets/datepicker');
    require('jquery-ui/ui/i18n/datepicker-de');

    require('bootstrap');
} catch (e) {}
