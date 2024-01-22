(function (window, undefined) {
    'use strict';

    ////DATA TABLE
    $('.data-table').dataTable({
		dom:
            '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
            '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
            '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>B>>' +
            '>t' +
            '<"d-flex justify-content-between mx-2 row mb-1"' +
            '<"col-sm-12 col-md-6"i>' +
            '<"col-sm-12 col-md-6"p>' +
            '>',
        displayLength: 10,
        lengthMenu: [10, 25, 50, 75, 100],
        stateSave: true,
    	language : {"url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"},
        columnDefs: [{
            targets: 'no-sort',
            orderable: false,
        }],
        drawCallback : function(settings) {
            feather.replace();
        },
        buttons: [
        {
            extend: 'collection',
            className: 'btn btn-outline-secondary dropdown-toggle me-2',
            text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Exportar',
            buttons: [
                {
                    extend: 'print',
                    text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Imprimir',
                    className: 'dropdown-item'
                },
                {
                    extend: 'csv',
                    text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                    className: 'dropdown-item'
                },
                {
                    extend: 'excel',
                    text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                    className: 'dropdown-item'
                },
                {
                    extend: 'pdf',
                    text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                    className: 'dropdown-item'
                },
                {
                    extend: 'copy',
                    text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copiar',
                    className: 'dropdown-item'
                }
            ], init: function (api, node, config) {
                $(node).removeClass('btn-secondary');
                $(node).parent().removeClass('btn-group');
                setTimeout(function () {
                    $(".dt-buttons").append($('.create-new').detach());
                    $(".create-new").removeClass('create-new');
                    $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                }, 50);
            }
        }]
    });

    ////DELETE MODAL
    $(".deleteComp").click(function(e){
    	e.preventDefault();
    	$("#deleteComponentModal .modal-body p").empty().append($(this).data("txt"));
    	$("#deleteComponentModal form").attr("action", $(this).data("href"));
    	$("#deleteComponentModal").modal("show");
    });

    ////VALIDATE FORM
    let forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
      }, false)
    })
})(window);
