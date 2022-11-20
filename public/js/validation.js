// -------------- validation data ------------------------------
function validation(url, data, form, massage, backurl, flag, method) {
  var status;
  var type = method != "" ? method : "POST";
  $.ajax(
    {
      type: type,
      url: url,
      async: false,
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      data: data,
      success: function () {
        $(form).trigger("reset");
        toastr.success(
          massage,
          {
            timeOut: 6000,
          },
          {
            positionClass: "toast-bottom-left",
          }
        );
        if (flag) {
          setTimeout(function () {
            location = backurl;
          }, 3000);
        }
        status = true;
      },
      error: function (xhr) {
        var errors = xhr.responseJSON;
        $.each(errors, function (key, value) {
          toastr.error(
            value[0],
            { timeOut: 5000 },
            { positionClass: "toast-bottom-left" }
          );
        });
        status = false;
      },
    },
    "json"
  );
  return status;
}
//------------end validation data -------------------------------
//---------------------confirm-message----------------------
// -------------- validation data ------------------------------
function confirmMessage(message) {
  if (confirm(message)) {
    return true;
  } else {
    return false;
  }
}
//----------------------------confirm-message---------------
//------------delete-items-------------------------------

$(document).on("click", ".delete", function (e) {
  e.preventDefault();
  var url = $(this).attr("href");
  var data = "";
  var form = "";
  var message = $(this).attr("data-msg");
  var backurl = "/";
  var method = "DELETE";
  if (validation(url, data, form, message, backurl, false, method)) {
    var click = $(this).attr("data-click");
    $(click).trigger("click");
  }
});

//------------end delete-items-------------------------------

//------------ login validation ---------------------------------

$(document).on("click", "#login-click", function (e) {
  e.preventDefault();
  var url = "/login";
  var data = {
    email: $("#email").val(),
    password: $("#password").val(),
    _token: $("#csrf").val(),
  };
  var form = "#login";
  var message = "خوش آمدید";
  if (document.referrer) {
    var backurl = document.referrer;
  } else {
    var backurl = "/";
  }

  var flag = true;
  var method = "";
  validation(url, data, form, message, backurl, flag, method);
});

//------------ end login validation -----------------------------

//------------ register validation ---------------------------------

$(document).on("click", "#register-click", function (e) {
  e.preventDefault();
  var url = "/register";
  var data = {
    email: $("#register-email").val(),
    password: $("#register-password").val(),
    _token: $("#register-csrf").val(),
  };
  var form = "#register";
  var message = "با موفقیت ثبت نام شدید";
  if (document.referrer) {
    var backurl = document.referrer;
  } else {
    var backurl = "/";
  }
  var method = "";
  validation(url, data, form, message, backurl, true, method);
});

//------------ end register validation -----------------------------

//------------edit-profile-------------------------------

$(document).on("click", "#edit-profile-button", function (e) {
  e.preventDefault();
  var url = "/user/edit-profile";
  var data = {
    name: $("#name").val(),
    family: $("#family").val(),
    mobile: $("#mobile").val(),
    email: $("#email").val(),
    _token: $("#csrf").val(),
  };
  var form = "";
  var message = "اطلاعات با موفقیت ویرایش شد !";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    $("#user-info").trigger("click");
  }
});

//------------end edit-profile-------------------------------

//------------send-ticket-------------------------------

$(document).on("click", "#send-ticket", function (e) {
  e.preventDefault();
  var url = "/user/ticket";
  var data = { title: $("#title").val(), body: $("#ticket-body").val() };
  var form = "#address-form";
  var message = "پیام شما با موفقیت ارسال شد !";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    $("#user-ticket").trigger("click");
  }
});

//------------end send-ticket-------------------------------

//------------create-address-------------------------------

$(document).on("click", "#create-address", function (e) {
  e.preventDefault();
  var url = "/user/addresses";
  var data = {
    name: $("#name").val(),
    address: $("#address").val(),
    codeposti: $("#codeposti").val(),
  };
  var form = "#address-form";
  var message = "آدرس با موفقیت ثبت شد !";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    $("#user-address").trigger("click");
  }
});

//------------end create-address-------------------------------

//------------edit-address-------------------------------

$(document).on("click", "#edit-address", function (e) {
  e.preventDefault();
  var url = $("#address-form").attr("action");
  var data = {
    name: $("#name").val(),
    address: $("#address").val(),
    codeposti: $("#codeposti").val(),
  };
  var form = "#address-form";
  var message = "آدرس با موفقیت ویرایش شد !";
  var backurl = "/";
  var method = "PUT";
  if (validation(url, data, form, message, backurl, false, method)) {
    $("#user-address").trigger("click");
  }
});

//------------end edit-address-------------------------------
//---------------------insert-image-product----------------
$(document).on("click", ".insert-comment", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = $(this).closest("form").attr("action");
  var data = form;
  var form = "";
  var message = "نظر شما با موفقیت ثبت شد ";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    location = window.location.href;
  }
});
//---------------------insert-image-product----------------
//---------------------news-letter----------------
$(document).on("click", ".newsletter-submit", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  $.ajax(
    {
      type: "POST",
      url: "/newsletter",
      async: false,
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      data: form,
      success: function (html) {
        $(".form").trigger("reset");
        toastr.success(
          html,
          {
            timeOut: 6000,
          },
          {
            positionClass: "toast-bottom-left",
          }
        );
      },
      error: function (xhr) {
        $(':input[type="submit"]').prop("disabled", false);
        var errors = xhr.responseJSON;
        $.each(errors, function (key, value) {
          toastr.error(
            value[0],
            { timeOut: 5000 },
            { positionClass: "toast-bottom-left" }
          );
        });
        status = false;
      },
    },
    "json"
  );
});
//---------------------news-letter----------------
//---------------------set-color-product----------------
$(document).on("click", ".select-color", function (e) {
  e.preventDefault();
  var color = $(this).attr("data-color");
  $(".color-input").val(color);
});
//---------------------set-color-product----------------
//------------add-card-------------------------------

$(document).on("click", ".add-card", function (e) {
  e.preventDefault();
  var url = $(this).attr("href");
  var data = {
    color: $(".color-input").val(),
    option: $(".option").val() != undefined ? $(".option").val() : null,
  };
  var form = "";
  var message = "محصول به سبد خرید اضافه شد !";
  var backurl = "/";
  var method = "POST";
  if (validation(url, data, form, message, backurl, false, method)) {
    location = window.location.href;
  }
});

//------------end add-card-------------------------------
//-------------filter-products---------------------------
$(document).on("click", "#filter-button", function (e) {
  e.preventDefault();
  $("#loading").show();
  var form = $(this).closest("form").serializeArray();
  var url = $(this).closest("form").attr("action");
  console.log(form, url);
  var data = form;
  $.ajax(
    {
      type: "GET",
      url: url,
      async: false,
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      data: data,
      success: function (html) {
        $("#list").html(html);
        $("#loading").hide();
      },
      error: function (xhr) {
        var errors = xhr.responseJSON;
        $.each(errors, function (key, value) {
          toastr.error(
            value[0],
            { timeOut: 5000 },
            { positionClass: "toast-bottom-left" }
          );
        });
        status = false;
      },
    },
    "json"
  );
});
//-------------filter-products-------------------------
//-------------filter-products---------------------------
$(document).on("click", ".sort-filter", function (e) {
  e.preventDefault();
  var value = $(this).children().attr("data-sort");
  var element = $(this);
  $(".sort").val(value);
  $("#loading").show();
  var form = $("#filter-button").closest("form").serializeArray();
  var url = $("#filter-button").closest("form").attr("action");
  var data = form;
  $.ajax(
    {
      type: "GET",
      url: url,
      async: false,
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      data: data,
      success: function (html) {
        $("#list").html(html);
        $("#loading").hide();
      },
      error: function (xhr) {
        var errors = xhr.responseJSON;
        $.each(errors, function (key, value) {
          toastr.error(
            value[0],
            { timeOut: 5000 },
            { positionClass: "toast-bottom-left" }
          );
        });
        status = false;
      },
    },
    "json"
  );
  $(".sort-filter").removeClass("on");
  $("[data-sort=" + value + "]")
    .parent()
    .addClass("on");
});
//-------------filter-products------------------------------------
//----------------------order submit------------------
$(document).on("click", ".order-submit", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  $(':input[type="submit"]').prop("disabled", true);
  var url = "/order";
  var data = form;
  var form = "";
  $.ajax(
    {
      type: "POST",
      url: "/order",
      async: false,
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      data: data,
      success: function (html) {
        toastr.success(
          html["massage"],
          {
            timeOut: 8000,
          },
          {
            positionClass: "toast-bottom-left",
          }
        );
        if (html["method"] == "checkout") {
          setTimeout(function () {
            location = html["url"];
          }, 6000);
        } else {
          setTimeout(function () {
            location = "/user/panel#main-content";
          }, 6000);
        }
      },
      error: function (xhr) {
        $(':input[type="submit"]').prop("disabled", false);
        var errors = xhr.responseJSON;
        $.each(errors, function (key, value) {
          toastr.error(
            value[0],
            { timeOut: 5000 },
            { positionClass: "toast-bottom-left" }
          );
        });
      },
    },
    "json"
  );
});
//----------------------dicount check------------------
$(document).on("click", ".discount-submit", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = "/discount-check";
  var data = form;
  var message = "کد با موفقیت اعمال شد !";
  var backurl = "/";
  var method = "";
  $.ajax(
    {
      type: "POST",
      url: "/discount-check",
      async: false,
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      data: data,
      success: function (html) {
        $(form).trigger("reset");
        $(".massage").html(
          '<div class="alert alert-success"><strong>تبریک! </strong>' +
            html["massage"] +
            "</div>"
        );
      },
      error: function (xhr) {
        var errors = xhr.responseJSON;
        $.each(errors, function (key, value) {
          toastr.error(
            value[0],
            { timeOut: 5000 },
            { positionClass: "toast-bottom-left" }
          );
        });
        status = false;
      },
    },
    "json"
  );
});

//----------------------contact-send------------------
$(document).on("click", ".contact-button", function (e) {
  e.preventDefault();
  $(':input[type="submit"]').prop("disabled", true);
  var form = $(this).closest("form").serializeArray();
  var url = "/contact";
  var data = form;
  var message = "پیام شما با موفقیت برای مدیریت ارسال شد !";
  var backurl = "/";
  var method = "";
  $.ajax(
    {
      type: "POST",
      url: "/contact",
      async: false,
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      data: data,
      success: function () {
        $(".contact-button").closest("form").trigger("reset");
        toastr.success(
          message,
          {
            timeOut: 6000,
          },
          {
            positionClass: "toast-bottom-left",
          }
        );
      },
      error: function (xhr) {
        $(':input[type="submit"]').prop("disabled", false);
        var errors = xhr.responseJSON;
        $.each(errors, function (key, value) {
          toastr.error(
            value[0],
            { timeOut: 5000 },
            { positionClass: "toast-bottom-left" }
          );
        });
        status = false;
      },
    },
    "json"
  );
});
