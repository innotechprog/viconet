 $(function(){
       $('#summernote').summernote({
    height: ($(window).height() - 300),
    callbacks: {
        onImageUpload: function(image) {
            uploadImage(image[0]);
        }
    }
});

function uploadImage(image) {
    var data = new FormData();
    data.append("file", image);
    $.ajax({
        url: 'upload-ck-img.php',
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "post",
        success: function(url) {
            var image = $('<img>').attr('src', url);
            $('#summernote').summernote("insertNode", image[0]);
        },
        error: function(data) {
            console.log(data);
        }
    });
}
    });