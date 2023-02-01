
$(document).on("click", "#delete", function(e) {
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
        title: "আপনি কি নিশ্চিত?",
        text: "আপনি আর এই ডাটা ফিরে পাবেন না!!",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'হ্যা, ডিলিট!',
    }).then(function(t) {
        t.value ? window.location.href = link : t.dismiss === Swal.DismissReason.cancel &&
        Swal.fire({
            title: "না",
            text: "আপনার ডাটা নিরাপদ আছে :)"
        })
    })
});
