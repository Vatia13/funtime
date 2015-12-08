function loadImages(url,external){
   if(url != ""){
       console.log(external);
       var imageDir = $('#image_dirs', window_parent.document);
       imageDir.text(url).trigger('change');
   }
}