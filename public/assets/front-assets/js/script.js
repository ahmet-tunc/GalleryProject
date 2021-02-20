
$(document).ready(function(){
    var currentSlide = 0;
    var slides = [];
    slides[0] = 'Slide1';
    slides[1] = 'Slide2';
    slides[2] = 'Slide3';
    slides[3] = 'Slide4';
    slides[4] = 'Slide5';

    function changeSlide() {
        currentSlide++;
        if(currentSlide > 4) currentSlide = 0;

        $('#'+slides[currentSlide]).prop('checked', true);
        setTimeout(changeSlide, 5000);
    }

    $(document).ready(function() {
        setTimeout(changeSlide, 5000);
    });


});