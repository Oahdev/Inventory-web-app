$("#menuBtn").on("click",function(){
    $("#navAccountDrop").slideToggle(300);
});
$("#logout_button").on("click",function(){
    $("#logout_button").toggleClass("active");
    $("#logout_option").toggle(300);
});
$("#logout_option button:last").on("click",function(){
    $("#logout_button").toggleClass("active");
    $("#logout_option").hide();
});