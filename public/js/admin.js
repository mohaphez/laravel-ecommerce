//------------------------tooltip------------------
$(document).ready(function () {
  $('[data-tool="tooltip"]').tooltip();
});
//-------------------------------------------------

$(document).on("click", "#add-sub-category", function (e) {
  e.preventDefault();
  var element = $(this).closest(".row");
  var input =
    '<div class="row"><div class="col-md-9"><input name="subcategory[]" class="form-control " type="text" placeholder="نام زیر دسته"><input class="form-control " type="hidden" value="no" name="id[]"></div><div class="col-md-3"><a href="" class="btn btn-block btn-danger delete-sub-category">حذف</a></div></div>';
  $(input).insertBefore(element);
});
//-----------------------delete-sub-category--------------
$(document).on("click", ".delete-sub-category", function (e) {
  e.preventDefault();
  $(this).closest(".row").remove();
});

//-----------------------add-submit-categories--------------
$(document).on("click", ".submit-category", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = "/super/admin/entry/categories";
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    var url = "/super/admin/entry/categories";
    location = window.location.href;
  }
});
//------------delete-category-------------------------------

$(document).on("click", ".delete-category", function (e) {
  e.preventDefault();
  var url = $(this).attr("data-id");
  var data = "";
  var form = "";
  var message = "آیتم مورد نظر با موفقیت حذف شد ";
  var backurl = "/";
  var method = "DELETE";
  if (validation(url, data, form, message, backurl, false, method)) {
    var url = "/super/admin/entry/categories";
    var element = "#page-wrapper";
    viewchange(url, element);
  }
});

//------------end delete-category-------------------------------
//-----------------------add-submit-item for items--------------
$(document).on("click", "#submit-item", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = "/super/admin/entry/items/item";
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    $(this).closest("form").trigger("reset");
    var url =
      "/super/admin/entry/items/" + $(this).closest("form").attr("data-id");
    var element = "#page-wrapper";
    viewchange(url, element);
  }
});
//---------------------end-add-submit-item for items--------------
//-----------------------add-submit-widget for widgets--------------
$(document).on("click", "#submit-widget", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = "/super/admin/entry/widgets/widget";
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    $(this).closest("form").trigger("reset");
    location = window.location.href;
  }
});
//---------------------end-add-submit-widget for widgets--------------
//-----------------------edit-item-show--------------
$(document).on("click", ".edit-item", function (e) {
  e.preventDefault();
  $(".modal-content").load($(this).find("a:first").attr("href"));
});
//---------------------edit-item-show--------------
//---------------------end-edit-submit-item for items--------------
$(document).on("click", "#edit-item-button", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url =
    "/super/admin/entry/items/item/" + $(this).closest("form").attr("data-id");
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    $(this).closest("form").trigger("reset");
    var url =
      "/super/admin/entry/items/" + $(this).closest("form").attr("data-id");
    var element = "#page-wrapper";
    $(".modal-backdrop").removeClass("in");
    viewchange(url, element);
  }
});
//---------------------end-edit-submit-item for items--------------

//---------------------end-edit-submit-item for items--------------
$(document).on("click", "#edit-widget-button", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url =
    "/super/admin/entry/widgets/widget/" +
    $(this).closest("form").attr("data-id");
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    $(this).closest("form").trigger("reset");
    $(".modal-backdrop").removeClass("in");
    location = window.location.href;
  }
});
//---------------------end-edit-submit-item for items--------------
//---------------------news-letter-send--------------
$(document).on("click", ".newsletter-send", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = "/super/admin/entry/newsletter";
  var data = form;
  var form = "";
  var message = "پیام ها با موفقیت برای اعضاء ارسال شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    $(this).closest("form").trigger("reset");
  }
});
//---------------------news-letter-send--------------

//-----------------------edit-items-show--------------
$(document).on("click", ".edit-items", function (e) {
  e.preventDefault();
  $(".modal-content").load($(this).attr("href"));
  if (validation(url, data, form, message, backurl, false, method)) {
    $(this).closest("form").trigger("reset");
    var url =
      "/super/admin/entry/items/" + $(this).closest("form").attr("data-id");
    var element = "#page-wrapper";
    viewchange(url, element);
  }
});
//---------------------edit-items-show--------------

//---------------------end-edit-submit-item--------------
$(document).on("click", "#edit-items-button", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url =
    "/super/admin/entry/widgets/edit/" +
    $(this).closest("form").attr("data-id");
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    $(this).closest("form").trigger("reset");
    var url = "/super/admin/entry/items/";
    var element = "#page-wrapper";
    $(".modal-backdrop").removeClass("in");
    $("#myModal").modal("toggle");
    viewchange(url, element);
  }
});
//---------------------end-edit-submit-item--------------

//---------------------end-edit-submit-widgets--------------
$(document).on("click", "#edit-widgets-button", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url =
    "/super/admin/entry/widgets/edit/" +
    $(this).closest("form").attr("data-id");
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    $(this).closest("form").trigger("reset");
    $(".modal-backdrop").removeClass("in");
    $("#myModal").modal("toggle");
    location = window.location.href;
  }
});
//---------------------end-edit-submit-item--------------

//-----------------------add-item-to product--------------
$(document).on("click", "#add-item", function (e) {
  e.preventDefault();
  var item = $("#item").val();
  var value = $("#value").val();
  var input =
    '<div class="row"><div class="col-md-5"><input name="items[]" class="form-control " type="text" value="' +
    item +
    '" readonly></div><div class="col-md-5"><input name="values[]" class="form-control " type="text" value="' +
    value +
    '"></div><div class="col-md-2"><a href="#" class="btn btn-primary btn-block delete-item">حذف</a></div></div>';
  $(input).insertAfter("#item-id");
});
//-----------------------add-item-to product--------------
////---------------------delete item in product--------------
$(document).on("click", ".delete-item", function (e) {
  e.preventDefault();
  $(this).closest(".row").remove();
});

//-----------------------delete item in product--------------
//-----------------------add-option-to product--------------
$(document).on("click", "#add-option", function (e) {
  e.preventDefault();
  var optionName = $("#optionName").val().trim();
  var optionValue = $("#optionValue").val().trim();
  var optionPrice = $("#optionPrice").val().trim();
  var input =
    '<div class="row"><div class="col-md-3"><input  class="form-control" name="optionName[]" type="text" value="' +
    optionName +
    '" readonly></div><div class="col-md-3"><input name="optionValue[]" class="form-control" type="text" value="' +
    optionValue +
    '" readonly></div><div class="col-md-3"><input  class="form-control " type="text" name="optionPrice[]" value="' +
    optionPrice +
    '" readonly></div><div class="col-md-2"><a href="#" class="btn btn-primary btn-block delete-option">حذف</a></div></div>';
  $(input).insertAfter("#option-id");
});
//-----------------------add-option-to product--------------
////---------------------delete option in product--------------
$(document).on("click", ".delete-option", function (e) {
  e.preventDefault();
  $(this).closest(".row").remove();
});

//-----------------------delete option in product--------------
//---------------------insert-product--------------
$(document).on("submit", "#insert-product-form", function (e) {
  e.preventDefault();
  $(this).attr("disabled", true);
  var data = new FormData(this);
  console.log(data);
  var message = "اطلاعات با موفقیت ذخیره شد";
  toastr.info(
    "در حال انجام عملیات صبور باشید !",
    { timeOut: 5000 },
    { positionClass: "toast-top-left" }
  );
  $.ajax(
    {
      type: "POST",
      url: window.location.href,
      async: false,
      processData: false,
      contentType: false,
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      data: data,
      success: function (data) {
        $(data).trigger("reset");
        toastr.success(
          message,
          {
            timeOut: 4000,
          },
          {
            positionClass: "toast-bottom-left",
          }
        );
        var href = "/super/admin/entry/product/insert/image/" + data;
        setTimeout(function () {
          location = href;
        }, 2000);
      },
      error: function (xhr) {
        $("#insert-product").removeAttr("disabled");
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
//---------------------insert-product--------------
//-----------------------load subcategory--------------
$(document).on("change", "#category", function (e) {
  e.preventDefault();
  var id = $(this).val();
  url = "/super/admin/entry/category/get/" + id;
  $("#subcategory").empty();
  $.get(url, function (data, status) {
    $.each(data, function (i) {
      $("#subcategory")
        .append(
          '<option value="' + data[i].id + '">' + data[i].name + "</option>"
        )
        .selectpicker("refresh");
    });
  });
});
//---------------------load subcategory--------------
//-----------------------add-submit-item for items--------------
$(document).on("click", "#add-option-button", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = "/super/admin/entry/options";
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    $(this).closest("form").trigger("reset");
    var url = "/super/admin/entry/options/";
    var element = "#page-wrapper";
    viewchange(url, element);
  }
});
//---------------------end-add-submit-item for items--------------
//-----------------------edit-option-show--------------
$(document).on("click", ".edit-option", function (e) {
  e.preventDefault();
  $(".modal-content").load($(this).attr("href"));
});
//---------------------edit-option-show--------------
//---------------------edit-submit-option--------------
$(document).on("click", "#edit-option-button", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = "/super/admin/entry/options/edit";
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    $(this).closest("form").trigger("reset");
    var url = "/super/admin/entry/options";
    var element = "#page-wrapper";
    $(".modal-backdrop").removeClass("in");
    $("#myModal").modal("toggle");
    viewchange(url, element);
  }
});
//---------------------end-edit-submit-option--------------

//---------------------insert-image-product----------------
$(document).on("click", ".insert-image-product", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = window.location.href;
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    location = window.location.href;
  }
});
//---------------------insert-image-product----------------
//
//---------------------edit-image-product----------------
$(document).on("click", ".edit-image-product", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = window.location.href + "/edit";
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    setTimeout(function () {
      location = window.location.href;
    }, 1000);
  }
});
//---------------------edit-image-product----------------

//---------------------remove-image--------------
$(document).on("click", ".remove-image", function (e) {
  e.preventDefault();
  if (confirmMessage("آیا از حذف این تصویر مطمئن هستید !")) {
    location = $(this).attr("href");
  } else {
    return false;
  }
});
//---------------------remove-image--------------
//---------------------remove-product--------------
$(document).on("click", ".remove-product", function (e) {
  e.preventDefault();
  if (confirmMessage("آیا از حذف این محصول مطمئن هستید !")) {
    location = $(this).attr("href");
  } else {
    return false;
  }
});
//---------------------remove-product--------------

////---------------------delete item edit in product--------------
$(document).on("click", ".delete-edit-item", function (e) {
  e.preventDefault();
  url = $(this).attr("href");
  element = $(this);
  $.get(url, function (data, status) {
    $(element).closest(".row").remove();
  });
});

//-----------------------delete item edit in product--------------

////---------------------delete option edit in product--------------
$(document).on("click", ".delete-edit-option", function (e) {
  e.preventDefault();
  url = $(this).attr("href");
  element = $(this);
  $.get(url, function (data, status) {
    $(element).closest(".row").remove();
  });
});

//-----------------------deleteoption edit in product--------------
//---------------------insert-product--------------
$(document).on("submit", "#edit-product-form", function (e) {
  e.preventDefault();
  $("#edit-product").attr("disabled", true);
  var data = new FormData(this);
  var message = "اطلاعات با موفقیت ذخیره شد";
  toastr.info(
    "در حال انجام عملیات صبور باشید !",
    { timeOut: 5000 },
    { positionClass: "toast-top-left" }
  );
  $.ajax(
    {
      type: "POST",
      url: window.location.href,
      async: false,
      processData: false,
      contentType: false,
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      data: data,
      success: function (data) {
        $(data).trigger("reset");
        toastr.success(
          message,
          {
            timeOut: 4000,
          },
          {
            positionClass: "toast-bottom-left",
          }
        );
        var href = "/super/admin/entry/products";
        setTimeout(function () {
          location = href;
        }, 1000);
      },
      error: function (xhr) {
        $("#edit-product").removeAttr("disabled");
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
//---------------------insert-product--------------
//----------------------add-sub-menu--------------
$(document).on("click", "#add-sub-menu", function (e) {
  e.preventDefault();
  var element = $(this).closest(".row");
  var input =
    '<div class="row"><div class="col-md-5"><input class="form-control " type="text"  name="submenu[]"></div><div class="col-md-5"><div class="form-group input-group"><input placeholder="لینک به صفحه :" type="text" class="form-control" name="submenu-link[]"><span class="input-group-btn"><button data-toggle="modal" data-target="#myModal" class="btn btn-default choose-page" type="button"> <i style="padding: 0;" class="fa fa-reply"></i></button></span></div> </div><div class="col-md-2"><a href="" class="btn btn-danger btn-block delete-sub-category">حذف</a></div></div>';
  $(input).insertBefore(element);
});
//-----------------------delete-sub-category--------------
//------------------------submenu submit------------------
$(document).on("click", ".submit-submenu", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = "/super/admin/entry/submenus";
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    location = window.location.href;
  }
});

//------------------------delete-header-menu-----------
$(document).on("click", ".delete-header-menu", function (e) {
  e.preventDefault();
  if (confirmMessage("آیا از حذف این آیتم مطمئن هستید !")) {
    var url = $(this).attr("data-href");
    var data = "";
    var form = "";
    var message = "آیتم مورد نظر با موفقیت حذف شد ";
    var backurl = "/";
    var method = "DELETE";
    if (validation(url, data, form, message, backurl, false, method)) {
      location = window.location.href;
    }
  } else {
    return false;
  }
});
//---------------------delete-header-menu-------------
//-----------------------edit-menu-show--------------
$(document).on("click", ".edit-menu", function (e) {
  e.preventDefault();
  $(".edit-modal").load($(this).attr("href"));
});
//---------------------edit-menu-show--------------
//---------------------edit-menu--------------
$(document).on("click", "#edit-menu", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = $(this).closest("form").attr("action");
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    $(this).closest("form").trigger("reset");
    var url = "/super/admin/entry/menus";
    var element = "#page-wrapper";
    $("#editModal").modal("toggle");
    location = window.location.href;
  }
});
//---------------------edit-menu--------------
//------------------------delete-menu-----------
$(document).on("click", ".delete-menu", function (e) {
  e.preventDefault();
  if (confirmMessage("آیا از حذف این آیتم مطمئن هستید !")) {
    var url = $(this).attr("href");
    var data = "";
    var form = "";
    var message = "آیتم مورد نظر با موفقیت حذف شد ";
    var backurl = "/";
    var method = "DELETE";
    if (validation(url, data, form, message, backurl, false, method)) {
      var url = "/super/admin/entry/menus";
      var element = "#page-wrapper";
      location = window.location.href;
    }
  } else {
    return false;
  }
});
//---------------------delete-menu-------------
//-----------------------load subcategory--------------
$(document).on("change", "#category-page", function (e) {
  e.preventDefault();
  var id = $(this).val();
  url = "/super/admin/entry/category/get/" + id;
  $("#subcategory-page").empty();
  $.get(url, function (data, status) {
    $.each(data, function (i) {
      $("#subcategory-page")
        .append(
          '<option value="' +
            data[i].id +
            '" data-name="' +
            data[i].slug +
            '">' +
            data[i].name +
            "</option>"
        )
        .selectpicker("refresh");
    });
  });
});
//---------------------load subcategory--------------

//---------------------choose-page--------------/
$(document).on("click", ".choose-page", function (e) {
  e.preventDefault();
  pagelink = $(this).parent().prev();
});
//---------------------choose-page--------------
//-----------------------choose-page--------------
$(document).on("click", "#choose-page", function (e) {
  e.preventDefault();
  var category = $("#category-page").find(":selected").attr("data-name");
  var subcategory = $("#subcategory-page").find(":selected").attr("data-name");
  if (category != undefined) {
    subcategory = subcategory == undefined ? "" : subcategory;
    $(pagelink).val("/list/" + category + "/" + subcategory);
  }
  $("#myModal").modal("toggle");
});
//---------------------choose-page--------------
//---------------------insert-slide-image----------------
$(document).on("click", ".insert-slideshow", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = window.location.href;
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    location = window.location.href;
  }
});
//---------------------insert-slide-image----------------

//---------------------insert-brand-image----------------
$(document).on("click", ".insert-brand", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = window.location.href;
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    location = window.location.href;
  }
});
//---------------------insert-brand-image---------------

//---------------------insert-baner-image----------------
$(document).on("click", ".insert-baner", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = "/super/admin/entry/baners";
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    location = window.location.href;
  }
});
//---------------------insert-baner-image----------------
//---------------------insert-ticket-reply----------------
$(document).on("click", ".insert-reply-ticket", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  console.log(form);
  var url = "/super/admin/entry/ticket/reply";
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    location = "/super/admin/entry/tickets";
  }
});
//---------------------insert-ticket-reply----------------
//---------------------insert-role----------------
$(document).on("click", ".insert-role", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = window.location.href;
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    location = window.location.href;
  }
});
//---------------------insert-role----------------
//---------------------remove-role--------------
$(document).on("click", ".remove-role", function (e) {
  e.preventDefault();
  if (confirmMessage("آیا از حذف این نقش مطمئن هستید !")) {
    var url = $(this).attr("href");
    var data = "";
    var form = "";
    var message = "آیتم مورد نظر با موفقیت حذف شد ";
    var backurl = "/";
    var method = "GET";
    if (validation(url, data, form, message, backurl, false, method)) {
      location = window.location.href;
    }
  } else {
    return false;
  }
});
//---------------------remove-role--------------
//-----------------------edit-item-show--------------
$(document).on("click", ".edit-role", function (e) {
  e.preventDefault();
  $(".modal-content").load($(this).attr("href"));
});
//---------------------edit-item-show--------------
//---------------------edit-role----------------
$(document).on("click", "#edit-role-button", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = window.location.href;
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    location = window.location.href;
  }
});
//---------------------edit-role----------------
//---------------------insert-comment-reply----------------
$(document).on("click", ".insert-reply-comment", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  console.log(form);
  var url = "/super/admin/entry/comment/reply";
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    location = "/super/admin/entry/comments";
  }
});
//---------------------insert-comment-reply----------------
//---------------------insert-seeting----------------
$(document).on("click", "#insert-setting", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = window.location.href;
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    setTimeout(function () {
      location = window.location.href;
    }, 1000);
  }
});
//---------------------insert-setting----------------
//---------------------insert-permission----------------
$(document).on("click", "#insert-permission", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = window.location.href;
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    setTimeout(function () {
      location = window.location.href;
    }, 1000);
  }
});
//---------------------insert-permission----------------
//---------------------insert-user-role----------------
$(document).on("click", "#insert-user-role", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = "/super/admin/entry/users/insert-user-role";
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    setTimeout(function () {
      location = window.location.href;
    }, 1000);
  }
});
//---------------------insert-user-role----------------
//---------------------post-edit----------------
$(document).on("click", ".post-edit", function (e) {
  e.preventDefault();
  var url = $(this).attr("href");
  $.get(url, function (data, status) {
    $("#title").val(data["title"]);
    CKEDITOR.instances["body"].setData(data["body"]);
    if (data["news"] == 1) {
      $("#status").attr("checked", true);
    } else {
      $("#status").attr("checked", false);
    }
    $("#add").attr("action", "/super/admin/entry/posts/edit/" + data["id"]);
    $("#add").collapse("show");
    $("#add").scrollTop();
  });
});
//---------------------post-edit----------------
//---------------------code-discount----------------
$(document).on("click", ".discountcode", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = $(this).parents("form").attr("action");
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    location = window.location.href;
  }
});
//---------------------code-discount----------------
//-----------------------show sms--------------
$(document).on("click", ".sms", function (e) {
  e.preventDefault();
  $(".modal-content").load($(this).attr("href"));
  $("#myModal").modal("toggle");
});
//---------------------edit-show-sms--------------
//---------------------send-sms--------------
$(document).on("click", "#send-sms", function (e) {
  e.preventDefault();
  $(this).attr("disabled", true);
  var form = $(this).closest("form").serializeArray();
  var url = $(this).closest("form").attr("action");
  var data = form;
  var form = "";
  var message = "پیامک با موفقیت ارسال شد ";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    $(this).closest("form").trigger("reset");
    $("#myModal").modal("toggle");
    location = window.location.href;
  }
});
//---------------------end-send-sms--------------
//---------------------end-add-group-sms--------------
$(document).on("click", "#add-group-sms", function (e) {
  e.preventDefault();
  $(this).attr("disabled", true);
  var form = $(this).closest("form").serializeArray();
  var url = $(this).closest("form").attr("action");
  var data = form;
  var form = "";
  var message = "فرد مورد نظر  با موفقیت به لیست مشتریان اضافه شد !";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    $(this).closest("form").trigger("reset");
    $("#myModal").modal("toggle");
    location = window.location.href;
  }
});
//---------------------end-add-group-sms--------------
//---------------------send-sms-group--------------
$(document).on("click", "#send-sms-group", function (e) {
  e.preventDefault();
  $(this).attr("disabled", true);
  var form = $(this).closest("form").serializeArray();
  var url = $(this).closest("form").attr("action");
  var data = form;
  var form = "";
  var message = "پیامک با موفقیت ارسال شد ";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    $(this).closest("form").trigger("reset");
    $("#myModal").modal("toggle");
    location = window.location.href;
  }
});
//---------------------end-send-sms-group--------------
//---------------------Validate input for numeric -----
$(".numbersOnly").keyup(function () {
  this.value = this.value.replace(/[^0-9\.]/g, "");
});
//----------------------------------checkoutSave--------
$(document).on("click", "#submit-checkoutCart", function (e) {
  e.preventDefault();
  var form = $(this).closest("form").serializeArray();
  var url = "/super/admin/entry/checkout";
  var data = form;
  var form = "";
  var message = "اطلاعات با موفقیت ذخیره شد";
  var backurl = "/";
  var method = "";
  if (validation(url, data, form, message, backurl, false, method)) {
    $(this).closest("form").trigger("reset");
    $("#myCheckout").modal("toggle");
    location = window.location.href;
  }
});

//---------------------Validate input for url -----
$(".urlOnly").keyup(function () {
  this.value = this.value.replace(
    /[?.,";%$#@!'*&:><  = {} ()\\ \/ \+ \^  \] \[  ]/,
    ""
  );
});
