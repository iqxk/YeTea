$(document).ready(function()
{
    // NEWS SLIDESHOW
    var slideIndex = 1;
    showSlides(slideIndex);
    showSlidesTimer(slideIndex);

    // Next/previous controls
    function moveSlide(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("slideshow");
        var dots = document.getElementsByClassName("dot");

        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++)
            slides[i].style.display = "none";
        for (i = 0; i < dots.length; i++)
            dots[i].className = dots[i].className.replace(" active", "");

        if(slideIndex > slides.length) slideIndex = 1;
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
    }

    function showSlidesTimer(n)
    {
        showSlides(n);
        setTimeout(showSlidesTimer, 10000); // Change image every 2 seconds
        slideIndex++;
    }

    $('.prev-slide').click(function()
    {
        moveSlide(-1);
    });
    $('.next-slide').click(function()
    {
        moveSlide(1);
    });

    $('#dot1').click(function()
    {
        currentSlide(1);
    });
    $('#dot2').click(function()
    {
        currentSlide(2);
    });
    $('#dot3').click(function()
    {
        currentSlide(3);
    });
});



