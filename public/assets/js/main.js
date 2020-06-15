/**
 * -------------------------------------------
 * All Page Custom Main JS File
 * --------------------------------------------
 */

$(document).ready(function() {
    $(".numeric").keypress(function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });

});

function isNumberKey(txt, evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode == 46) {
      //Check if the text already contains the . character
      if (txt.value.indexOf('.') === -1) {
        return true;
      } else {
        return false;
      }
    } else {
      if (charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;
    }
    return true;
  }
// $(".numeric").keydown(function(event) {
//     console.log(event.keyCode);

//     if (event.which != 8 && event.which != 0 && (event.which < 48 || event.which > 57)) {
//         return false;
//     }
//     // // Allow only backspace and delete
//     // if ( event.keyCode == 46 || event.keyCode == 8 ) {
//     //     // let it happen, don't do anything
//     // }
//     // else {
//     //     // Ensure that it is a number and stop the keypress
//     //     if (event.keyCode < 48 || event.keyCode > 57 ) {
//     //         event.preventDefault();
//     //     }
//     // }
// });
