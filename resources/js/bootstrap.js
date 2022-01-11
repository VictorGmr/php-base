window._ = require('lodash');

import cash from "cash-dom";
import Alpine from 'alpinejs'
import IMask from 'imask';
import TomSelect from "tom-select";
import Toastify from "toastify-js";

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    // Set plugins globally
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    window.cash = cash;
    window.Alpine = Alpine
    window.IMask = IMask;
    window.TomSelect = TomSelect;
    window.Toastify = Toastify;
    Alpine.start()

    require('bootstrap');
} catch (e) {
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
