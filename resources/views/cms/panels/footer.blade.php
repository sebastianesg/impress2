
<div class="modal fade" id="deleteComponentModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <form method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"><p></p></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-float waves-light">Eliminar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- BEGIN: Footer-->
<footer class="footer footer-light {{ $configData['footerType'] === 'footer-hidden' ? 'd-none' : '' }} {{ $configData['footerType'] }}">
    <p class="text-end mb-0">
        <b>Made by: </b> <a href="https://codingco.io/" class="mx-1" target="_blank"><img src="https://codingco.io/coding-copyright.svg" alt="Coding & Company Logo" width="45"></a>
    </p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->
