/**
 * Notify
 */
window.addEventListener('notify',({detail:{type,title,message}})=>{
    document.querySelector('#notification-content-title-'+type).innerHTML = title;
    document.querySelector('#notification-content-message-'+type).innerHTML = message;
    Toastify({
        node:cash('#notification-content-rnt-'+type).clone().removeClass('hidden')[0],
        duration: 3000,
        newWindow: true,
        close: true,gravity: 'top',
        position: 'right',
        stopOnFocus: true
    }).showToast();
});
