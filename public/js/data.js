    $('#product-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'products/get',
        columns: [
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'category.name', name: 'category.name', orderable: false},
            {data: 'price', name: 'price'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            paginate: {
              "first": "صفحه اول",
              "last": "صفحه آخر",
              "next": "صفحه بعدی",
              "previous": "صفحه قبلی"
            },
            "search": "جستجو:",
            "emptyTable": "جدول خالی می باشد.",
            "info":           "نمایش _START_ تا _END_ از _TOTAL_ مورد",
            "infoEmpty":      "نمایش 0 تا 0 از 0 مورد",
            "infoFiltered":   "(فیلتر شده ازبین _MAX_ مورد کل)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "نمایش _MENU_ مورد",
            "loadingRecords": "در حال بارگذاری...",
            "processing":     "در حل پردازش...",
            "zeroRecords":    "هیچ تطابقی یافت نشد.",
          }
    });

    $('#sell-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'sell/list',
        columns: [
            {data: 'rownum', name: 'rownum'},
            {data: 'name', name: 'name'},
            {data: 'pay_method', name: 'pay_method'},
            {data: 'pay_status', name: 'pay_status'},
            {data: 'price', name: 'price'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            paginate: {
              "first": "صفحه اول",
              "last": "صفحه آخر",
              "next": "صفحه بعدی",
              "previous": "صفحه قبلی"
            },
            "search": "جستجو:",
            "emptyTable": "جدول خالی می باشد.",
            "info":           "نمایش _START_ تا _END_ از _TOTAL_ مورد",
            "infoEmpty":      "نمایش 0 تا 0 از 0 مورد",
            "infoFiltered":   "(فیلتر شده ازبین _MAX_ مورد کل)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "نمایش _MENU_ مورد",
            "loadingRecords": "در حال بارگذاری...",
            "processing":     "در حل پردازش...",
            "zeroRecords":    "هیچ تطابقی یافت نشد.",
          }
    });

    $('#sellByLink-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'sell-by-link/list',
        columns: [
            {data: 'rownum', name: 'rownum'},
            {data: 'trackingCode', name: 'trackingCode'},
            {data: 'user_id', name: 'user_id'},
            {data: 'status', name: 'status'},
            {data: 'payStatus', name: 'payStatus'},
            {data: 'optionType', name: 'optionType'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            paginate: {
              "first": "صفحه اول",  
              "last": "صفحه آخر",
              "next": "صفحه بعدی",
              "previous": "صفحه قبلی"
            },
            "search": "جستجو:",
            "emptyTable": "جدول خالی می باشد.",
            "info":           "نمایش _START_ تا _END_ از _TOTAL_ مورد",
            "infoEmpty":      "نمایش 0 تا 0 از 0 مورد",
            "infoFiltered":   "(فیلتر شده ازبین _MAX_ مورد کل)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "نمایش _MENU_ مورد",
            "loadingRecords": "در حال بارگذاری...",
            "processing":     "در حل پردازش...",
            "zeroRecords":    "هیچ تطابقی یافت نشد.",
          }
    });

    $('#apps-sell-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'sell/list',
        columns: [
            {data: 'rownum', name: 'rownum'},
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'pay_method', name: 'pay_method'},
            {data: 'pay_status', name: 'pay_status'},
            {data: 'price', name: 'price'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            paginate: {
              "first": "صفحه اول",
              "last": "صفحه آخر",
              "next": "صفحه بعدی",
              "previous": "صفحه قبلی"
            },
            "search": "جستجو:",
            "emptyTable": "جدول خالی می باشد.",
            "info":           "نمایش _START_ تا _END_ از _TOTAL_ مورد",
            "infoEmpty":      "نمایش 0 تا 0 از 0 مورد",
            "infoFiltered":   "(فیلتر شده ازبین _MAX_ مورد کل)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "نمایش _MENU_ مورد",
            "loadingRecords": "در حال بارگذاری...",
            "processing":     "در حل پردازش...",
            "zeroRecords":    "هیچ تطابقی یافت نشد.",
          }
    });

    $('#sell-user-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.location.href+'/order',
        columns: [
            {data: 'rownum', name: 'rownum'},
            {data: 'name', name: 'name'},
            {data: 'pay_method', name: 'pay_method'},
            {data: 'pay_status', name: 'pay_status'},
            {data: 'price', name: 'price'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            paginate: {
              "first": "صفحه اول",
              "last": "صفحه آخر",
              "next": "صفحه بعدی",
              "previous": "صفحه قبلی"
            },
            "search": "جستجو:",
            "emptyTable": "جدول خالی می باشد.",
            "info":           "نمایش _START_ تا _END_ از _TOTAL_ مورد",
            "infoEmpty":      "نمایش 0 تا 0 از 0 مورد",
            "infoFiltered":   "(فیلتر شده ازبین _MAX_ مورد کل)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "نمایش _MENU_ مورد",
            "loadingRecords": "در حال بارگذاری...",
            "processing":     "در حل پردازش...",
            "zeroRecords":    "هیچ تطابقی یافت نشد.",
          }
    });

    $('#ticket-list').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'tickets/get',
        columns: [
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'title', name: 'title'},
            {data: 'date', name: 'date'},
            {data: 'time', name: 'time'},
            {data: 'message', name: 'message'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        order: [[ 3, 'desc' ],[ 5, 'desc' ]],
        language: {
            paginate: {
              "first": "صفحه اول",
              "last": "صفحه آخر",
              "next": "صفحه بعدی",
              "previous": "صفحه قبلی"
            },
            "search": "جستجو:",
            "emptyTable": "جدول خالی می باشد.",
            "info":           "نمایش _START_ تا _END_ از _TOTAL_ مورد",
            "infoEmpty":      "نمایش 0 تا 0 از 0 مورد",
            "infoFiltered":   "(فیلتر شده ازبین _MAX_ مورد کل)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "نمایش _MENU_ مورد",
            "loadingRecords": "در حال بارگذاری...",
            "processing":     "در حل پردازش...",
            "zeroRecords":    "هیچ تطابقی یافت نشد.",
          }
    });

    $('#chat-list').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'chat/list',
        columns: [
            {data: 'name', name: 'name'},
            {data: 'mobile', name: 'mobile'},
            {data: 'created_at', name: 'created_at'},
            {data: 'count', name: 'count'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            paginate: {
              "first": "صفحه اول",
              "last": "صفحه آخر",
              "next": "صفحه بعدی",
              "previous": "صفحه قبلی"
            },
            "search": "جستجو:",
            "emptyTable": "جدول خالی می باشد.",
            "info":           "نمایش _START_ تا _END_ از _TOTAL_ مورد",
            "infoEmpty":      "نمایش 0 تا 0 از 0 مورد",
            "infoFiltered":   "(فیلتر شده ازبین _MAX_ مورد کل)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "نمایش _MENU_ مورد",
            "loadingRecords": "در حال بارگذاری...",
            "processing":     "در حل پردازش...",
            "zeroRecords":    "هیچ تطابقی یافت نشد.",
          }
    });

    $('#comment-list').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'comments/get',
        columns: [
            {data: 'product', name: 'product'},
            {data: 'title', name: 'title'},
            {data: 'email', name: 'email'},
            {data: 'date', name: 'date'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            paginate: {
              "first": "صفحه اول",
              "last": "صفحه آخر",
              "next": "صفحه بعدی",
              "previous": "صفحه قبلی"
            },
            "search": "جستجو:",
            "emptyTable": "جدول خالی می باشد.",
            "info":           "نمایش _START_ تا _END_ از _TOTAL_ مورد",
            "infoEmpty":      "نمایش 0 تا 0 از 0 مورد",
            "infoFiltered":   "(فیلتر شده ازبین _MAX_ مورد کل)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "نمایش _MENU_ مورد",
            "loadingRecords": "در حال بارگذاری...",
            "processing":     "در حل پردازش...",
            "zeroRecords":    "هیچ تطابقی یافت نشد.",
          }
    });


    $('#user-list').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'users/list',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'family', name: 'family'},
            {data: 'email', name: 'email'},
            {data: 'mobile', name: 'mobile'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            paginate: {
              "first": "صفحه اول",
              "last": "صفحه آخر",
              "next": "صفحه بعدی",
              "previous": "صفحه قبلی"
            },
            "search": "جستجو:",
            "emptyTable": "جدول خالی می باشد.",
            "info":           "نمایش _START_ تا _END_ از _TOTAL_ مورد",
            "infoEmpty":      "نمایش 0 تا 0 از 0 مورد",
            "infoFiltered":   "(فیلتر شده ازبین _MAX_ مورد کل)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "نمایش _MENU_ مورد",
            "loadingRecords": "در حال بارگذاری...",
            "processing":     "در حل پردازش...",
            "zeroRecords":    "هیچ تطابقی یافت نشد.",
          }
    });


    $('#role-list').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'role/list',
        columns: [
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            paginate: {
              "first": "صفحه اول",
              "last": "صفحه آخر",
              "next": "صفحه بعدی",
              "previous": "صفحه قبلی"
            },
            "search": "جستجو:",
            "emptyTable": "جدول خالی می باشد.",
            "info":           "نمایش _START_ تا _END_ از _TOTAL_ مورد",
            "infoEmpty":      "نمایش 0 تا 0 از 0 مورد",
            "infoFiltered":   "(فیلتر شده ازبین _MAX_ مورد کل)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "نمایش _MENU_ مورد",
            "loadingRecords": "در حال بارگذاری...",
            "processing":     "در حل پردازش...",
            "zeroRecords":    "هیچ تطابقی یافت نشد.",
          }
    });
