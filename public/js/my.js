
// -----------------------side bar js -------------------------


function openNav() {

    var side_width = document.getElementById("mySidenav").style.width;
    if (side_width == "250px" ) {
      document.getElementById("mySidenav").style.width = "0px";

    }else{
      document.getElementById("mySidenav").style.width = "250px";
    }

    document.getElementById("btn_container").classList.toggle("change");
    document.getElementById("body").classList.toggle("fix");
    document.getElementById("whiteboard").classList.toggle("whiteboard");

}

$(document).ready(function(){
            $('#lightgallery').lightGallery();
});

function phoneSrch() {
  var side_width = document.getElementById("mySidenav").style.width;
  if (side_width == "250px" ) {
      document.getElementById("mySidenav").style.width = "0px";
      document.getElementById("btn_container").classList.toggle("change");
      document.getElementById("body").classList.toggle("fix");
    document.getElementById("whiteboard").classList.toggle("whiteboard");

  }
  document.getElementById("searching").classList.toggle("show");
   console.log($('#searching'));
  $('#searching').css("opacity","1" );
  document.getElementById("body").classList.toggle("fix");
    document.getElementById("search_result").classList.toggle("whiteboard");
  // $('#searching').css("border-color","rgb(212, 95, 226)" );



  setTimeout(function() {
  document.getElementById("back_btn").classList.toggle("be_arrow");
  }, 1);

}



/* Set the width of the side navigation to 0 */



// ---------------------------end of side bar js -----------------------


//---------------------------- swipper js -----------------------------

swiperShow();

function swiperShow() {
  // console.log("hi");

 var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
 var sinitialSlide ;


if(width > 1300){sinitialSlide = 4}else
if(width > 900){sinitialSlide = 3}else
if(width > 700){sinitialSlide = 2}else
if(width > 400){sinitialSlide = 1}else
if(width < 400){sinitialSlide = 0}


 var swiper2 = new Swiper('.swiper2', {
       // pagination: '.swiper-pagination2',
       scrollbar: '.swiper-pagination2',
       scrollbarHide: false,
       slidesPerView: 'auto',
       centeredSlides: true,
       spaceBetween: 30,
       initialSlide: sinitialSlide,
       grabCursor: true
   });

 var swiper3 = new Swiper('.swiper3', {
       grabCursor: true,
       autoplay: 4000,
       speed: 600,
       loop: true,
       pagination: '.swiper-pagination3',
       paginationClickable: true,
       nextButton: '.swiper-button-next',
       prevButton: '.swiper-button-prev',
       spaceBetween: 30
   });

    var swiper005 = new Swiper('.swiper005', {
        // pagination: '.swiper-pagination005',
        pagination: '.swiper-pagination005',
        slidesPerView: 'auto',
        autoplay: 4000,
        speed: 600,
        loop: true,
        paginationClickable: true,
        centeredSlides: true,
        spaceBetween: 30,
        initialSlide: 0,
        grabCursor: true
    });
     var swiper006 = new Swiper('.swiper006', {
        // pagination: '.swiper-pagination006',
        pagination: '.swiper-pagination006',
        paginationClickable: true,
        // scrollbarHide: false,
        autoplay: 4000,
        speed: 600,
        loop: true,
        slidesPerView: 'auto',
        centeredSlides: true,
        spaceBetween: 30,
        initialSlide: 0,
        grabCursor: true,
    });




}


 //----------------------------end of swipper js -----------------------------


//----------------------------- brand search ------------------------------------

function brand_search() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName('li');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        a = li[i];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
//----------------------------- end of brand search ------------------------------------

//----------------------------- brand search ------------------------------------

function category_search() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById('myCategory');
    filter = input.value.toUpperCase();
    ul = document.getElementById("myLink");
    li = ul.getElementsByTagName('li');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        a = li[i];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
//----------------------------- end of brand search ------------------------------------


$(document).ready(function() {
    // $(".dropdown-toggle").dropdown();

      if ($(window).width() > 992) {


       $(".collapse").addClass("in");

  } else {

      $(".collapse").removeClass("in");

  }

});





// ------------------------------

function sortBtn() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

// ------------------ modal product ------------------------

// Get the modal
var modal = document.getElementById('product-modal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementsByClassName('product-big-img');
var modalImg = document.getElementById("img01");


function modalShow(){
    modal.style.display = "block";
    modalImg.src = img[0].src;
    // captionText.innerHTML = this.alt;

    $('html, body').css({
        overflow: 'hidden',
        height: '100%'
    });
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("modal")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
  $('html, body').css({
        overflow: 'auto',
        height: 'auto'
    });
}


// ------------------end of modal product ------------------------


// --------------------Magnifier-------------------


function detectmob() {
 if( navigator.userAgent.match(/Android/i)
 || navigator.userAgent.match(/webOS/i)
 || navigator.userAgent.match(/iPhone/i)
 || navigator.userAgent.match(/iPad/i)
 || navigator.userAgent.match(/iPod/i)
 || navigator.userAgent.match(/BlackBerry/i)
 || navigator.userAgent.match(/Windows Phone/i)
 ){
    return false;
  }
 else {
    return true;
  }
}

if (detectmob()) {
var obj = [];
// console.log(colors);
var evt = new Event();
obj[0] = new Magnifier(evt);
// console.log('cream'+i);
obj[0].attach({
    thumb: '#product-img',
    large: $("#product-img").attr("data-large-img-url"),
    zoom: 1.5
});
}










// ------------------------changeColor-----------------------------


function changeColor(source) {
  var img = document.getElementsByClassName('product-big-img');
  var larger = document.getElementById("product-img-large");
  img[0].src = source;
  larger.src = source;
  // console.log(larger);



}

// ------------------------changeColor-----------------------------

//-----------------------add adress--------------
