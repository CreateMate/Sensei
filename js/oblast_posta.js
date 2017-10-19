function ajaxLike(id)
{
   var xhttp;
  
    if (window.XMLHttpRequest) 
    {
     
      xhttp = new XMLHttpRequest();
      } 
      else 
      {
    
      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xhttp.open("POST", base_url+"Sadrzaj/dodajLike/"+id, true);
        xhttp.send();
        xhttp.onreadystatechange = function() 
        {
            if (xhttp.readyState == 4 && xhttp.status == 200) 
            {
                
               $(".senseiLike"+id).children(".unliked").css("display","none");
               $(".senseiLike"+id).html("<img src='"+base_url+"/images/upLiked.png' alt='sensei like' class='liked'/>");
               var broj_lajkova=$(".broj_lajkova").children(".povecaj"+id).text();
               broj_lajkova=parseInt(broj_lajkova);
               broj_lajkova=broj_lajkova+1;
               $(".broj_lajkova").children(".povecaj"+id).text(broj_lajkova);
            }
        }
}
function ajaxDislike(id)
{
    var xhttp;
  
    if (window.XMLHttpRequest) 
    {
     
      xhttp = new XMLHttpRequest();
      } 
      else 
      {
    
      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
        xhttp.open("POST", base_url+"Sadrzaj/oduzmiLike/"+id, true);
        xhttp.send();
        xhttp.onreadystatechange = function() 
        {
            if (xhttp.readyState == 4 && xhttp.status == 200) 
            {
             $("."+id).css("display","none");
               var broj_lajkova=$(".broj_lajkova").children(".povecaj"+id).text();
               broj_lajkova=parseInt(broj_lajkova);
               broj_lajkova=broj_lajkova-1;
               $(".broj_lajkova").children(".povecaj"+id).text(broj_lajkova);
            }
        }
}

function anketaAjax()
{
    var xhttp;
  
    if (window.XMLHttpRequest) 
    {
     
      xhttp = new XMLHttpRequest();
      } 
      else 
      {
    
      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
        xhttp.open("GET", "http://localhost/Sajt/Sadrzaj/anketaAjax", true);
    
        xhttp.send();
        xhttp.onreadystatechange = function() 
        {
            if(xhttp.readyState==1)
            {
                console.log(1);
            }
            if(xhttp.readyState==2)
            {
                console.log(2);
            }
            if(xhttp.readyState==3)
            {
                console.log(3);
            }
            if (xhttp.readyState == 4 && xhttp.status == 200) 
            {
              document.getElementById("footer-part-anketa").innerHTML=xhttp.responseText;
            }
        }
}
function ajaxOnKeyUp()
{
    var naslov=$("#UserName").val();
    var id=$("input[name='idOblast']").val();
     var data="naslov="+naslov;
    if(id!=null)
    {
        data+="&id="+id;
    }
   
    $.ajax({
        type:"GET",
        cache:true,
        data:data,
        url:"http://localhost/Sajt/Sadrzaj/like",
        success:function(html)
        {
            $("#sadrzaj").html(html);
        }
        
    });
}
function ajaxPrikazPostaKomentar(id_post)
{
/*    var data;
    if(id_post!=null)
    {
        alert(id_post)
        
         $.ajax({
            type:"post",
            dataType:"json",
            url: "http://localhost/Sajt/Sadrzaj/comments/"+id_post,
            success: function(response) {
                $("lightbox").html(response);
            }
        });
    }
    */
            
    var xhttp;
  
    if (window.XMLHttpRequest) 
    {
     
      xhttp = new XMLHttpRequest();
      } 
      else 
      {
         xhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
        xhttp.open("GET", base_url+"Sadrzaj/comments/"+id_post, true);
        xhttp.send();
        xhttp.onreadystatechange = function() 
        {
            if (xhttp.readyState == 4 && xhttp.status == 200) 
            {
               
               document.getElementById("lightbox").innerHTML=this.responseText;
               $("#lightbox").css("display","block");
               $("#lightbox").children(".middle-funterest").addClass("image");
            }
        }
}