<script>
  $(document).ready(function(){
    $('.go-to').click(function () {
        var goTo = $(this).data('goTo');
        $('html , body').animate({scrollTop: $('#' + goTo).offset().top - 0}, 500);
        return true;
    });
  });
</script>