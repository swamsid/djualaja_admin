<!-- plugins:js -->
<script src="{{ URL::asset('js/app.js') }}"></script>

<script src="{{ url('dev/node_modules/popper.js/dist/umd/popper.min.js') }}" tppabs="http://www.bootstrapdash.com/demo/purple/node_modules/popper.js/dist/umd/popper.min.js"></script>

<script src="{{ url('dev/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js') }}" tppabs="http://www.bootstrapdash.com/demo/purple/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>

<script src=" {{ url('dev/node_modules/datatables.net/js/jquery.dataTables.js') }} " tppabs="http://www.bootstrapdash.com/demo/purple/node_modules/datatables.net/js/jquery.dataTables.js"></script>

<script src=" {{ url('dev/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js') }} " tppabs="http://www.bootstrapdash.com/demo/purple/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<!-- endinject -->

<!-- inject:js -->
<script src="{{ asset('js/off-canvas.js') }}" tppabs="http://www.bootstrapdash.com/demo/purple/js/off-canvas.js"></script>
<script src="{{ asset('js/hoverable-collapse.js') }}" tppabs="http://www.bootstrapdash.com/demo/purple/js/hoverable-collapse.js"></script>
<script src="{{ asset('js/misc.js') }}" tppabs="http://www.bootstrapdash.com/demo/purple/js/misc.js"></script>
<script src="{{ asset('js/settings.js') }}" tppabs="http://www.bootstrapdash.com/demo/purple/js/settings.js"></script>
<script src="{{ asset('js/todolist.js') }}" tppabs="http://www.bootstrapdash.com/demo/purple/js/todolist.js"></script>
<script src="{{ asset('js/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-confirm-master/dist/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

{{-- <script src="{{ asset('js/lodash.js') }}"></script> --}}
<!-- endinject -->

<script>
	baseUrl = '{{ url("/") }}';
	Pof = 'http://localhost/djualaja';

	$(function () {
	  $('[data-toggle="tooltip"]').tooltip();

	  $('.open_additional_modal').click(function(evt){
	  	evt.preventDefault();
	  	$("#modal_additional").modal('show');
	  	$('#modal_additional .modal-title').text($(this).data('title'));
        $('#modal_additional .modal-body').html("<center><small class='text-muted'>Menyiapkan Form Setting..</small></center>")

	  	axios.get(baseUrl + $(this).data('url'))
              .then((response) => {
              	console.log(response);
                $('#modal_additional .modal-body').html(response.data)
              }).catch((error) => {
                console.log(error)
              })
	  })
	})

</script>