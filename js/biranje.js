function naKlik(id)
{
    $( "#"+id +" .levo").toggleClass('oblast-opacity');
         if($("."+id).hasClass('oblast-opacity'))
         {
             $("#sakriveno"+id).val(id);
             $("#sakriveno"+id).prop('checked', true); 
             $("."+id+" .oblast-slika").css('height','82%');
             $(".oblast-wrapper").css('margin','2%');
         }
         else
         {
             $("#sakriveno"+id).val(0);
              $("#sakriveno"+id).prop('checked', false);
              $("."+id+" .oblast-slika").css('height','84%');
               $(".oblast-wrapper").css('margin','2% 2%');
         }
}

