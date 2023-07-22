// // check for ready function
// function docReady(fn) {
//     // see if DOM is already available
//     if (document.readyState === "complete" || document.readyState === "interactive") {
//         // call on next available tick
//         setTimeout(fn, 1);
//     } else {
//         document.addEventListener("DOMContentLoaded", fn);
//     }
// }    

// // check for ready
// docReady(function() {
//     getElementById('sc-sc_plugin_setting_color_picker-picker').wpColorPicker();
// });

// check for ready
// document.addEventListener("DOMContentLoaded", function(event) {
//     document.getElementById('sc_plugin_setting_color_picker').wpColorPicker();
// });


// initiate color pickers
jQuery(document).ready(function($){
    $('.color-pickers').wpColorPicker();
});

// format currency
// const formatter = new Intl.NumberFormat('en-US', {
//     style: 'currency',
//     currency: 'USD',
//     maximumFractionDigits: 0,
//     roundingIncrement: 100,
// });

// const fields = document.querySelectorAll('.settings_page_sc-plugin form input[type="number"]');
// console.log(fields);

// fields.forEach((field) => {
//     // field.value = formatter.format(field.value);
//     const newValue = formatter.format(field.value);
//     field.value = newValue.replace('$', '');
// })