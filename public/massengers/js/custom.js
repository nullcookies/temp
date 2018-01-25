// Scroll To Top //

$(document).ready(function(){
  
  //Check to see if the window is top if not then display button
  $(window).scroll(function(){
    if ($(this).scrollTop() > 200) {
      $('.scrollToTop').fadeIn(1000);
    } else {
      $('.scrollToTop').fadeOut(500);
    }
  });
  
  //Click event to scroll to top
  $('.scrollToTop').click(function(){
    $('html, body').animate({scrollTop : 0},800);
    return false;
  });
  
});

// Scroll to Top Ends //

// Owl Carousel //

$('.homepage-slider').owlCarousel({
    loop:true,
    nav:true,
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})

$('.slider-carousel').owlCarousel({
    loop:true,
    margin:25,
    nav:true,
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})

$(document).ready(function() {
  $('.owl-carousel').owlCarousel({
	loop: true,
	margin: 10,
	responsiveClass: true,
	responsive: {
	  0: {
		items: 2,
		nav: true
	  },
	  600: {
		items: 3,
		nav: false
	  },
	  1000: {
		items: 5,
		nav: true,
		loop: false,
		margin: 20
	  }
	}
  })
});

$('.owl-2').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
})
$('.blog-carousel').owlCarousel({
    loop:true,
    margin:50,
    nav:true,
    autoplay:true,
    autoplayTimeout:10000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
})

$('.client-carousel').owlCarousel({
    loop:true,
    margin:25,
    nav:true,
    autoplay:true,
    autoplayTimeout:2000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:4
        },
        1000:{
            items:4
        }
    }
})



// Side Navigation //


function openNav() {
    document.getElementById("mySidenav").style.width = "180px";
    document.getElementById("main").style.marginLeft = "180px";
    document.body.style.backgroundColor = "rgba(255,255,255,1)";
    $('#mobile-services-toggle').attr('onclick','closeNav()');
    $('.hidelcb').find('span').toggle();
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    document.body.style.backgroundColor = "white";
    $('#mobile-services-toggle').attr('onclick','openNav()');
    $('.hidelcb').find('span').toggle();
}




/*

$(document).ready(function() {
    $('#formnewsletter').delay(5000).fadeIn(400);
});

*/


// Scroll Fix Top //

var fixmeTop = $('.fixme').offset().top;
$(window).scroll(function() {
    var currentScroll = $(window).scrollTop();
    if (currentScroll >= fixmeTop) {
        $('.fixme').css({
            position: 'fixed',
            top: '0',
            left: '0',
			right: '0',
			padding: '1px'
        });
    } else {
        $('.fixme').css({
            position: 'static'
        });
    }
	if (currentScroll >= fixmeTop) {
        $('.fixme2').css({
            position: 'fixed',
            top: '65',
            left: '0',
			right: '0',
        });
    } else {
        $('.fixme2').css({
            position: 'static'
        });
    }
});


// Scroll Section //

			$(document).ready(function(){ 
			
			$(window).scroll(function(){
				if ($(this).scrollTop() > 300) {
					$('.scrollup').fadeIn();
				} else {
					$('.scrollup').fadeOut();
				}
			}); 
			
			$('.scrollup').click(function(){
				$("html, body").animate({ scrollTop: 0 }, 1500);
				return false;
			});
 
		});
		
		
// Accordian  //

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        var panel2 = this.nextElementSibling;
        if (panel2.style.display === "block") {
            panel2.style.display = "none";
        } else {
            panel2.style.display = "block";
        }
    }
}		


$( ".forgot-pass" ).click(function() {
  $( ".signup" ).fadeOut( "slow", "linear" );
});

$(document).ready(function(){
    $(".view-details").click(function(){
        $("#viewd").fadeToggle(1000);
    });
});


$(document).ready(function(){
    $("#cart").click(function(){
        $(".minicartview").fadeToggle(1000);
    });
});

/*$( "#confess-reply" ).click(function() {
  $( ".confess-reply-form" ).fadeIn( "slow", "linear" );
});*/

/*$(document).ready(function () {

    $('#mobile-services-toggle').click(function () {
        $('.hidelcb').find('span').slideToggle();
    });

});*/

$('#navigation').slimmenu(
{
    resizeWidth: '800',
    collapserTitle: 'Main Menu',
    animSpeed: 'medium',
    easingEffect: null,
    indentChildren: false,
    childrenIndenter: '&nbsp;'
});


/* For Hover */

$(document).ready(function(){
 $("#hoverimage").zoom();
});


if ($(window).width() < 990) {
   	$('#hoverimage').removeAttr('id');
}

/* For Hover Ends */
