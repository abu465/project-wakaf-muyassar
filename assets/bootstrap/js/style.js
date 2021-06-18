
function showme(count) {
	document.getElementById("inpt").value = count;
}
function showbank(count){
	document.getElementById("bank").value =count;
}
// Select
$(document).ready(function(){
  $('.select-box').materialSelect();
});
// End 

$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > 100) {
		$('#myBtn').fadeIn();
		mybutton.style.display = "block";
    } else {
		$('#myBtn').fadeOut();
		mybutton.style.display = "none";
    }
});
$(document).ready(function() {
    $("#myBtn").click(function(event) {
        event.preventDefault();
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });

});