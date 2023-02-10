$(() => {
    function init() {
        // Datatables
        $("#tabla_tareas").DataTable({
            ordering: false,
            serverSide: true,
            processing: true,
            dom: 'rB<"H"><t><"row botom-datatable"<"col-12 col-md-6"i><"col-12 col-md-6"p>>',
            order: [[1, "asc"]],
            ajax: {
                url: route("tareas.datatables"),
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: "des_tarea",
                    name: "tareas.descripcion",
                },
                {
                    data: "est_tarea",
                    name: "tareas.estado",
                    render: function (data, type, row) {
                        if (row.est_tarea == 0) {
                            return "No Realizado";
                        } else {
                            return "Realizado";
                        }
                    },
                },
                {
                    data: "acciones",
                    orderable: false,
                    searchable: false,
                },
            ],

            language: {
                url: "js/datatable-es.json",
            },
        });
        crud();
        events();
        alerts();
    }

    function crud() {
        // Abrir Modal
        $("#agregarTarea").on("click", function () {
            $("#formTarea")[0].reset();
            $("#des_tarea-error").addClass("d-none");
            $("#des_tarea").removeClass("is-invalid");
            $(".modal-title").text("Nueva Tarea");
            $(".action_button").text("Agregar");
            $(".action_button").removeClass("btn-info");
            $(".action_button").addClass("btn-primary");
            $("#action").val("Agregar");
            $("#modalTarea").modal("show");
        });

        // Cerrar Modal
        $("#cerrarModalBtn").on("click", function () {
            $("#des_tarea-error").addClass("d-none");
            $("#des_tarea").removeClass("is-invalid");
            $("#modalTarea").modal("hide");
        });

        // Cargar Datos al Modal
        $(document).on("click", ".editarTareaBtn", function () {
            var editar_id = $(this).attr("id");
            $("#des_tarea-error").addClass("d-none");
            $("#des_tarea").removeClass("is-invalid");

            $.ajax({
                url: "/tareas/" + editar_id + "/edit",
                dataType: "json",
                success: function (data) {
                    $("#des_tarea").val(data.tarea.descripcion);
                    $("#tarea_id").val(data.tarea.id);

                    $(".modal-title").text("Actualiza Tarea");
                    $(".action_button").text("Actualizar");
                    $(".action_button").removeClass("btn-primary");
                    $(".action_button").addClass("btn-info");
                    $("#action").val("Editar");
                    $("#modalTarea").modal("show");
                },
            });
        });

        // Token
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        // Crear/Editar Tareas con Ajax
        $("#formTarea").on("submit", function (e) {
            e.preventDefault();
            var action_url = "";

            // Accione para agregar
            if ($("#action").val() == "Agregar") {
                action_url = route("tareas.store");
            }

            // Accione para editar
            if ($("#action").val() == "Editar") {
                action_url = route("tareas.update");
            }

            $.ajax({
                type: "POST",
                url: action_url,
                data: $("#formTarea").serialize(),
                dataType: "json",
                success: function (data) {
                    // Si hay errores
                    if (data.errors) {
                        if (data.errors.des_tarea) {
                            $("#des_tarea-error").removeClass("d-none");
                            $("#des_tarea").addClass("is-invalid");
                            $("#des_tarea-error").html(
                                data.errors.des_tarea[0]
                            );
                        }
                    }

                    // Si esta todo ok
                    if (data.success) {
                        if ($("#action").val() == "Editar") {
                            $("#tabla_tareas").DataTable().ajax.reload();
                            toastr.info("Registro actualizado correctamente");
                            $("#formTarea")[0].reset();
                            $("#des_tarea-error").addClass("d-none");
                            $("#des_tarea").removeClass("is-invalid");
                            $("#modalTarea").modal("hide");
                        } else {
                            $("#tabla_tareas").DataTable().ajax.reload();
                            toastr.success("Registro agregado correctamente");
                            $("#formTarea")[0].reset();
                            $("#des_tarea-error").addClass("d-none");
                            $("#des_tarea").removeClass("is-invalid");
                            $("#modalTarea").modal("hide");
                        }
                    }
                },
            });
        });

        // ************* ELIMINAR TAREA DESDE AJAX *************
        var eliminar_id;
        $(document).on("click", ".eliminarTareaBtn", function () {
            eliminar_id = $(this).attr("id");
            $("#modalEliminarTarea").modal("show");
            $("#eliminaTareaBtn").text("Si, Eliminar");
        });

        $("#eliminaTareaBtn").on("click", function () {
            $.ajax({
                url: "/tareas/destroy/" + eliminar_id,
                beforeSend: function () {
                    $("#eliminaTareaBtn").text("Eliminando...");
                    toastr.success("Registro eliminado correctamente");
                },
                success: function (data) {
                    $("#tabla_tareas").DataTable().ajax.reload();
                    $("#modalEliminarTarea").modal("hide");
                },
            });
        });
    }

    function events() {
        $(".modal").on("shown.bs.modal", function () {
            $(this).find("[autofocus]").focus();
        });
    }

    function alerts() {
        $("#des_tarea").on("keyup", function () {
            if ($("#des_tarea-error").text() != "") {
                if ($(this).val().length) {
                    $("#des_tarea-error").addClass("d-none");
                    $("#des_tarea").removeClass("is-invalid");
                } else {
                    $("#des_tarea-error").removeClass("d-none");
                    $("#des_tarea").addClass("is-invalid");
                }
            }
        });
    }

    init();
});
