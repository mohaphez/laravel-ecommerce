////------------can not back admin------------------------------
var back = window.location.href;
if (back.split('/')[3] === "admin" && back.split('/')[4] === undefined) {
    window.history.pushState('', null, back);
}
// -------------- can not back admin ------------------------------
function viewchange(url, element) {
    $("#loading").show();
    $("#loading-admin").show();
    $.ajax({

        type: "GET",
        url: url,
        success: function(html) {
            $(element).html(html);
            $("#loading").fadeOut();
            $("#loading-admin").fadeOut();
            $('html, body').animate({
                scrollTop: $(element).offset().top - 100
            }, 1000);
            var href = url.split('#')[0];
            window.history.pushState(html, 'Title', href + element);
        },
        error: function(xhr) {
            alert("error");

        }
    }, "json");

}
//------------end viewchange-------------------------------

// -------------- pagechange-with <a> ------------------------------
$(document).on("click", "a[data-element]", function(e) {
    e.preventDefault();
    var url = $(this).attr("href");
    var element = $(this).attr("data-element");
    viewchange(url, element);
});
//------------end pagechange with <a>-------------------------------
////------------back state-------------------------------
$(window).on('popstate', function() {
    var url = window.location.href;
    if (url.split('/')[3] === "admin" && url.split('/')[4] === undefined) {
        window.history.pushState('', null, url);
        location.reload(true);
    } else {
        var element = url.split('#')[1];
        if ($("#" + element).length == 0) {
            window.history.go(-1);
        } else {
            viewchange(url, "#" + element);
        }
    }
});
//------------backstate-------------------------------
//------------ user-ticket-------------------------------
$(document).on("click", "#user-ticket", function(e) {
    e.preventDefault();
    var url = '/user/ticket';
    var element = "#profile-content";
    viewchange(url, element);
    $("#tab>div.on").removeClass("on");
    $("#user-ticket").addClass("on");
});
//------------end user-ticket-------------------------------


//------------ user-info-------------------------------
$(document).on("click", "#user-info", function(e) {
    e.preventDefault();
    var url = '/user/user-info';
    var element = "#profile-content";
    viewchange(url, element);
    $("#tab>div.on").removeClass("on");
    $("#user-info").addClass("on");
});
//------------end user-info-------------------------------

//------------ user-discount-code-------------------------------
$(document).on("click", "#user-discount-code", function(e) {
    e.preventDefault();
    var url = '/user/discount-code';
    var element = "#profile-content";
    viewchange(url, element);
    $("#tab>div.on").removeClass("on");
    $("#user-discount-code").addClass("on");
});
//------------end user-discount-code-------------------------------

//------------ user-discount-code-------------------------------
$(document).on("click", "#user-address", function(e) {
    e.preventDefault();
    var url = '/user/addresses';
    var element = "#profile-content";
    viewchange(url, element);
    $("#tab>div.on").removeClass("on");
    $("#user-address").addClass("on");
});
//------------end user-discount-code-------------------------------

//------------ user-orders-------------------------------
$(document).on("click", "#user-orders", function(e) {
    e.preventDefault();
    var url = '/user/orders/list';
    var element = "#profile-content";
    viewchange(url, element);
    $("#tab>div.on").removeClass("on");
    $("#user-orders").addClass("on");
});
//------------end user-orders-------------------------------

//------------ user-orders-------------------------------
$(document).on("click", ".user-order-show", function(e) {
    e.preventDefault();
    var url = $(this).attr("href");
    var element = "#profile-content";
    viewchange(url, element);
});
//------------end user-orders-------------------------------

//------------ user-discount-code-------------------------------
// $(document).on("click", ".sort-filter", function(e) {
//     e.preventDefault();
//     $("#loading").show();
//     url = window.location.href;
//     url = url.split("sort=");
//     url = url[0]+"?sort="+$(this).attr("data-sort");
//     location = url;

// });
//------------end user-discount-code-------------------------------
