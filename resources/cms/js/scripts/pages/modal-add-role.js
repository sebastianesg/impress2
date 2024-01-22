// Add new role Modal JS
//------------------------------------------------------------------
(function () {
    // reset form on modal hidden
    $('.modal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
    });

    $('.role-edit-modal').click(function () {
        var dataRoleId = $(this).data('id');
        $('#rolId').val(dataRoleId);
        var dataRoleName = $(this).data('name');
        $('#modalRoleName').val(dataRoleName);

        //traer los checkbox de los permisos
        var dataRolePermissions = $(this).data('perms');
        var dataRolePermissionsArray = dataRolePermissions.split(',');
        var dataRolePermissionsArrayLength = dataRolePermissionsArray.length;
        for (var i = 0; i < dataRolePermissionsArrayLength; i++) {
            var item = dataRolePermissionsArray[i];
            $('#rol_'+ item).prop('checked', true);
        }
    });

    $('.role-feather-modal').click(function () {
        var dataRoleName = $(this).data('name');
        $('#modalRoleName').val(dataRoleName);
        var dataRoleId = $(this).data('id');
        $('#rolId').val(dataRoleId);
        //bloquear el campo de nombre
        $('#modalRoleName').prop('disabled', true);
        //ocultar los campos de permisos
        $('#permisos').hide();
        //cambiar el texto del boton de guardar
        $('#guardarRol').text('Eliminar');
    });


    // Select All checkbox click
    const selectAll = document.querySelector('#S'),
        checkboxList = document.querySelectorAll('[type="checkbox"]');
    selectAll.addEventListener('change', t => {
        checkboxList.forEach(e => {
            e.checked = t.target.checked;
        });
    });
})();
