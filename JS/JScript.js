$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.yukari-buton').fadeIn();
        } else {
            $('.yukari-buton').fadeOut();
        }
    });

    $('.yukari-buton').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
});

/*
  <table border="0" cellSpacing="0" cellPadding="0" width="100%" id="">

   <tr>
    <td valign="top" width="98%"><center>
      <table border="0" id="table2">
       <tr>
        <td><b>Otopark Yorumları:</b>
        </td>
      </tr>
    </table>
<div id="ts1"></div>

    <center><br>
      &nbsp;<form onsubmit="" method="post" name="" action="">
       <table id="">
        <tr>
          <td colSpan="20" align="left"><b>Bu otopark hakkında yorum
          ekle:</b>
        </td>
      </tr>

     <tr>
       <td align="left">Yorum Başlığı:
       </td>
       <td align="left">
         <input style="border-radius: 5px" size="25" name="topic" autocomplete="off">
       </td>
     </tr>

     <tr>
       <td>Yorum:</td>
       <td>
        <textarea style="width: 250px; height: 100px; max-width: 210px; max-height: 100px; border-radius: 5px;" name="message" rows="1" cols="20"></textarea></td>
      </tr>
    </table>

<input style="margin-left: 6.5%" value="Yorum ekle" type="submit">

  </form>
</tr>

</table>



<script>
   document.getElementById("ts1").innerHTML = Date();
</script>

*/