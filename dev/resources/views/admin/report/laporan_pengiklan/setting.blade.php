<div class="row">
  <div class="col-md-12" style="border-right: 1px solid #eee; font-size: 0.9em; color: #3a3f51;">
  	<form method="get" action="{{ route('laporan_pengiklan.submit') }}" target="_blank">
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
	        <td width="30%" class="title">Status</td>
	        <td colspan="2" style="padding: 0px 0px 0px 10px;">
	            <select class="form-control" name="status">
	            	<option value="verified">Verified</option>
	            	<option value="unverified">Unverified</option>
	            	<option value="inactive">blocked</option>
	            </select>
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