


<div class="container">
  <form>
  <div class="form-group">
    <textarea class="status-box" rows="3" placeholder="Write your message here..."></textarea>
  </div>
  </form>
     
    <div class="control pull-right">
      <p class="counter">120</p>
      <a href="#"class="btn btn-primary">Send</a>
    </div>
</div>


<div class="row">
  <div class="col-md-12">
    <ul class="posts">
    </ul>
  </div>
</div>




var main = function () {
$('.btn').click(function (){
var post = $('.status-box').val();
$('<li>').fadeIn(600).text(post).prependTo('.posts');
$('.status-box').val('');
$('.counter').text('120');
$('.btn').addClass('disabled'); 
 $('.posts li:last').addClass('even');
});


$('.status-box').keyup(function(){
  var longitudTexto = $(this).val().length;
  var letrasC = 120 - longitudTexto;
  $('.counter').text(letrasC);   

if (letrasC <= 0 ) {
 $('.btn').addClass('disabled');
} 
else if (letrasC == 120) {
  $('.btn').addClass('disabled');
  alert("You");
}
else {
  $('.btn').removeClass('disabled');
}

});

$('.btn').addClass('disabled'); 

}

$(document).ready(main);

