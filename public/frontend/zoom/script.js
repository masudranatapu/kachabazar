
$(document).ready(function () {
    $("#zoom_03").ezPlus({
        gallery: 'gallery_01',
        cursor: 'pointer',
        galleryActiveClass: "active",
        imageCrossfade: true,   
  zoomType: 'inner',
  cursor: 'crosshair',
    });

    $("#zoom_03").bind("click", function (e) {
        var ez = $('#zoom_03').data('ezPlus');
        ez.closeAll(); //NEW: This function force hides the lens, tint and window
        $.fancyboxPlus(ez.getGalleryList());
        return false;
    });

});