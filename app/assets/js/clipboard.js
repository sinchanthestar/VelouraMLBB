function copy_to_clipboard(element) {
        /* Get the text field */
        var copyText = document.getElementById(element);
        
        /* Select the text field */
        copyText.select();
       
        /* Copy the text inside the text field */
        document.execCommand("copy");
        
        /* Alert the copied text */
        Swal.fire("Yeay!", "Berhasil disalin.", "success");
      }
      