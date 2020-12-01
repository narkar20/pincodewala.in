// JavaScript source code
 // fix navbar
        $(window).scroll(function () {
            var scroll = $(window).scrollTop();

            if (scroll >= 70) {
                $("#mainNav").addClass("navbar-shrink");
            } else {
                $("#mainNav").removeClass("navbar-shrink");
            }
        });


// add sroll 
$('.example').DataTable({
"scrollY": "50px",
"scrollCollapse": true,
});