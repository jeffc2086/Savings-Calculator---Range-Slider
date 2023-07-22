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
document.addEventListener("DOMContentLoaded", function(event) {
    // alert('test');

    
});


// initiate color pickers
// jQuery(document).ready(function($){
//     $('.color-pickers').wpColorPicker();
// });