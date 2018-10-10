<div class="row">
  <div class="col-md-12" style="border-right: 1px solid #eee; font-size: 0.9em; color: #3a3f51;">
  	<form method="get" action="{{ route('laporan_iklan.submit') }}" target="_blank">
  		<input type="hidden" name="_token" value="{{ csrf_token() }}" readonly>
	    <table id="form-table" border="0" width="100%">
	      <tr>
	        <td width="30%" class="title">Pilih Provinsi</td>
	        <td colspan="2" style="padding: 0px 0px 0px 10px;">
	            <select class="form-control" name="province">
	            	<option value="all">Semua Provinsi</option>
	            	@foreach($province as $key => $data)
	            		<option value="{{ $data->id }}">{{ $data->name }}</option>
	            	@endforeach
	            </select>
	        </td>
	      </tr>

	      <tr>
	        <td width="30%" class="title" style="padding: 20px 0px;">Pilih Kategori</td>
	        <td colspan="2" style="padding: 0px 0px 0px 10px;">
	            <select class="form-control" name="kategori">
	            	@foreach($kategori as $key => $kategory)
	            		<option value="all">Semua Kategori</option>
	            		<optgroup label="{{ $kategory->name }}">
						    @foreach($kategory->children as $child)
						    	<option value="{{ $child->id }}">{{ $child->name }}</option>
						    @endforeach
						 </optgroup>
	            	@endforeach
	            </select>
	        </td>
	      </tr>

	      <tr>
	        <td width="30%" class="title">Status Iklan</td>
	        <td colspan="2" style="padding: 0px 0px 0px 10px;">
	            <select class="form-control" name="status">
	            	<option value="approved">Approved</option>
	            	<option value="blocked">Blocked</option>
	            	<option value="pending">Pending</option>
	            </select>
	        </td>
	      </tr>

	      <tr>
	        <td width="30%" class="title" style="padding: 20px 0px;">Bulan</td>
	        <td colspan="2" style="padding: 0px 0px 0px 10px;">
	            <input type="text" class="form-control datePick" placeholder="Pilih Tanggal" style="cursor: pointer;" readonly name="bulan">
	        </td>
	      </tr>

	      

	      <tr>
	        <td width="30%" class="title"></td>
	        <td colspan="2" class="text-right" style="padding: 20px 10px;">
	            <button class="btn btn-primary btn-xs" type="submit"> Proses </button>
	        </td>
	      </tr>
	    </table>
    </form>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.datePick').datepicker( {
	        format: "mm-yyyy",
          	viewMode: "months", 
          	minViewMode: "months"
	    })
	})
</script>