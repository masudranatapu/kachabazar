<script src="{{asset('frontend/js/vendor/jquery-1.12.0.min.js')}}"></script>
<script src="{{asset('frontend/js/popper.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/plugins.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script>
    $(document).ready(function () {
        $(".navbar-toggle").click(function () {
            $("#m-nav").css("left", "0");
            $("#m-nav").css("transition", "0.3s");
        });
        $(".close").click(function () {
            $("#m-nav").css("left", "-100%");
            $("#m-nav").css("transition", "0.3s");
        });

        $("ul.nav li.dropdown").hover(
            function () {
                $(this).find(".dropdown-menu").stop(true, true).delay(200).fadeIn(500);
            },
            function () {
                $(this).find(".dropdown-menu").stop(true, true).delay(200).fadeOut(500);
            }
        );
        var maxheight = 295;
        var showText = "More Categories";
        var hideText = "Less";

        $(".textContainer_Truncate").each(function () {
            var text = $(this);
            if (text.height() > maxheight) {
                text.css({ overflow: "hidden", height: maxheight + "px" });

                var link = $('<a href="#" style="padding:5px;text-align:center;display:block;color:#900;text-decoration:none;">' + showText + "</a>");
                var linkDiv = $("<div></div>");
                linkDiv.append(link);
                $(this).after(linkDiv);

                link.click(function (event) {
                    event.preventDefault();
                    if (text.height() > maxheight) {
                        $(this).html(showText);
                        text.css("height", maxheight + "px");
                    } else {
                        $(this).html(hideText);
                        text.css("height", "auto");
                    }
                });
            }
        });
    });
</script>



<script>

  $(".remove-from-cart").click(function (e) {
      e.preventDefault();

      var ele = $(this);

      if(confirm("Are you sure")) {
          $.ajax({
              url: '{{ route('remove_from_cart') }}',
              method: "DELETE",
              data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
              success: function (data) {
                  window.location.reload();
                  // console.log(data);
              }
          });
      }
  });

  // for search
  function get_product_title(title) {
    $("#search").val(title);
    $("#search_form").attr('action','/search');
    $("#search_form").submit();
  }

  jQuery(document).ready(function($) {
        //Scroll to top button JS
        $("#backtotop").click(function () {
          $("body,html").animate({
            scrollTop: 0
          }, 600);
        });

       $("#backtotop").click(function(e){
        var href = $(this).attr("href"),
          offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
        $('html, body').stop().animate({
          scrollTop: offsetTop
        }, 900);
        e.preventDefault();
      });
      $(window).scroll(function () {
        if ($(window).scrollTop() > 150) {
          $("#backtotop").css("display", "block");
          $("#backtotop").css("transition", "all 1s ease");
        } else {
          $("#backtotop").css("display", "none");
        }
      });

    // for main search
    $('#search').keyup(function() {
      var search = $("#search").val();
      $.ajax({
        type:"POST",
        url:"{{ route('ajax_search_to_product') }}",
        data:{
              search: search,
              _token: '{{ csrf_token() }}'
            },
        success:function(data) {
          $("#search_data").html(data);
          console.log(data);
        }


      });
    });


  });


</script>
