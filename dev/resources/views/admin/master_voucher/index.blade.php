@extends("admin.app")

@section("title", " Master Sub Kategori")


@section("extra_styles")
  
  <link href="{{asset('js/plugins/cropper/dist/cropper.min.css')}}" rel="stylesheet">

  <style>

    .table th{
      background: #545454;
      color: white;
      text-align: center;
    }

    .table td, td{
      padding: 8px;
    }

    .opsi {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #fff;
    }

    .opsi li {
      float: left;
    }

    .opsi li a {
      display: block;
      color: #3a3f51;
      text-align: center;
      padding: 10px 20px;
      text-decoration: none;
    }

    .opsi li.hovered a:hover {
      background-color: #3a3f51;
      color: white;
    }

    #order-listing td, #order-listing th{
      font-size: 0.8em;
      text-align: center;
    }

    #order-listing td{
      color: #37474F;
    }

    #form-table{
      width: 100%;
      background: none;
    }

    #form-table td.title{
      color: #666;
    }

    button:disabled,
    button[disabled]{
      cursor: no-drop;
    }

    .modal-lg{
      width: 60% !important;
    }

  </style>

@endsection


@section("content")
  
  <div class="content-wrapper" id="vue-content">
  
    <div class="col-md-12 col-sm-12 col-xs-12">
      <nav aria-label="breadcrumb" role="navigation">
        <div class="row">
          <div class="col-12">
            <ol class="breadcrumb breadcrumb-custom">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Data Master</a></li>
              <li class="breadcrumb-item active" aria-current="page"><span>Master @{{ contentHeader }}</span></li>
            </ol>
          </div>

          {{-- <div class="col-1" style="padding: 5px 0px; background: none; height: 45px; border: 0px solid #ddd;">
            
            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="text-decoration: none;">
              <button type="button" class="btn btn-dark btn-xs" style="border: 0px solid white; height: 35px;">
                &nbsp; <i class="fa fa-ellipsis-v"></i> OPSI
              </button>
            </a>

          </div> --}}
        </div>
      </nav>

    </div>

    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
      <div class="card">
        <div class="col-md-12" style="padding-left: 5px;">
            <div class="card-body" style="padding: 0px;">
              <ul class="opsi">
                <li class="hovered" @click="add"><a href="#"><i class="fa fa-plus"></i> &nbsp;Tambah Data</a></li>
                <li class="hovered" @click="edit"><a href="#"><i class="fa fa-pencil"></i> &nbsp;Edit Data</a></li>
                <li class="hovered" @click="hapus"><a href="#"><i class="fa fa-eraser"></i> &nbsp;Hapus Data</a></li>

                {{-- <li class="hovered" style="float: right;"><a href="#news"><i class="fa fa-file-pdf-o"></i> &nbsp;Print Pdf</a></li> --}}
                {{-- <li class="hovered" style="float: right;"><a href="#contact"><i class="fa fa-file-excel-o"></i> &nbsp;Print Excel</a></li> --}}
              </ul>
            </div>
        </div>
      </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-12" style="border-bottom: 1px solid #eee; margin-bottom: 20px;">
                <div class="row">
                  <div class="col-md-6">
                    <h4 class="card-title">Data Table @{{ contentHeader }}</h4>
                  </div>

                  <div class="col-md-6" style="padding-right: 35px; color: #aaa; font-size: 0.75em;">
                    <span class="pull-right">Total @{{ dataTable.data.length }} Data (@{{ elapsedTime }} detik)</span>
                  </div>
                </div>
            </div>

            {{-- <div class="col-4 text-right" style="border-bottom: 1px solid #eee; margin-bottom: 20px;">
              <button type="button" class="btn btn-primary btn-xs" style="margin-top: -15px;"><i class="fa fa-plus"></i>Tambah</button>
            </div> --}}
          </div>

          <div class="row">
            <div class="col-12">
              <data-list-category :list-data="dataTable.data" :size="dataTable.size" :columns="dataTable.columns" :data_category="dataTable.single_data" :dataTab="dataTable.data" @get_select_unit="selectedUnit" @view_one="view_one" @edit_one="edit_one" @delete_one="delete_one" :button_helper="dataTable.button_helper"></data-list-category>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="margin-top: 10px;">
        <div class="modal-content" style="border-radius: 1px; font-size: 0.8em;">
          <div class="modal-header" style="padding: 15px;">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #263238;">Tambah Data @{{ contentHeader }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 15px; background: white;">
            <div class="row">
              <div class="col-md-12" style="border-right: 1px solid #eee;">
                <table id="form-table" border="0">

                  <tr>
                    <td width="30%" class="title"> Kode Voucher </td>
                    <td width="65%">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Masukkan Kode Voucher" v-model="dataTable.single_data.voucher_code" maxlength="9">

                          <div class="input-group-append">
                            <button class="btn btn-primary" type="button" style="font-size: 0.9em;" @click="randomMe(9)">Acak Kode</button>
                          </div>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Deskripsi Voucher </td>
                    <td width="65%">
                        <textarea class="form-control" rows="5" placeholder="Masukkan Placeholder" maxlength="300" v-model="dataTable.single_data.voucher_description"></textarea>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Maksimal Digunakan </td>
                    <td width="65%">
                        <div class="input-group">
                          <input type="number" min="0" class="form-control" placeholder="Berapa Kali Voucher Ini Bisa Digunakan" v-model="dataTable.single_data.voucher_uses">
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon3" style="font-size: 0.9em;">Kali</span>
                          </div>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Penggunaan 1 User </td>
                    <td width="65%">
                        <div class="input-group">
                          <input type="number" min="0" class="form-control" placeholder="Maksimal Penggunaan 1 User" v-model="dataTable.single_data.voucher_max_users_uses">
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon3" style="font-size: 0.9em;">Kali</span>
                          </div>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Type Voucher </td>
                    <td width="65%">
                        <select class="form-control" v-model="dataTable.single_data.voucher_type" @change="diskonChange()">
                          <option value="1">Diskon Dalam Persen</option>
                          <option value="2">Diskon Dalam Nilai</option>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Jumlah Diskon </td>
                    <td width="65%">
                        <div class="input-group" v-if="stateDiskon == 1">
                          <input type="number" min="0" max="100" class="form-control" placeholder="Jumlah Diskon Yang Diberikan" v-model="dataTable.single_data.voucher_discount">
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon3" style="font-size: 0.9em;">%</span>
                          </div>
                        </div>

                        <div class="input-group" v-if="stateDiskon == 2">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3" style="font-size: 0.9em;">Rp.</span>
                          </div>
                          <input type="number" min="0" class="form-control" placeholder="Jumlah Diskon Yang Diberikan" v-model="dataTable.single_data.voucher_discount">
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Berlaku Sampai </td>
                    <td width="65%">
                        <input type="text" class="form-control datePick" placeholder="Pilih Tanggal" style="cursor: pointer;" readonly v-model="dataTable.single_data.voucher_ends_at">
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Is Fixed </td>
                    <td width="65%">
                        <select class="form-control" v-model="dataTable.single_data.is_fixed">
                          <option value="1">Ya</option>
                          <option value="0">Tidak</option>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="addSave" :disabled="btn_save_disabled">Simpan</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="margin-top: 10px;">
        <div class="modal-content" style="border-radius: 1px; font-size: 0.8em;">
          <div class="modal-header" style="padding: 15px;">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #263238;">Edit Data @{{ contentHeader }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 15px; background: white;">
            <div class="col-md-12 text-center" v-if="selectedData.length == 0" style="color: #666;">Anda Harus Memilih Data Yang Akan Diedit Terlebih Dahulu.</div>

            <div class="row" v-show="selectedData.length != 0">
              <div class="col-md-12" style="border-right: 1px solid #eee;">
                <table id="form-table" border="0">

                  <tr>
                    <td width="30%" class="title"> Kode Voucher </td>
                    <td width="65%">
                        <select class="form-control" style="width: 70%" v-model="changeState">
                          <option v-for="dat in list_selected" :value="dat.id">@{{ dat.voucher_code }}</option>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Deskripsi Voucher </td>
                    <td width="65%">
                        <textarea class="form-control" rows="5" placeholder="Masukkan Placeholder" maxlength="300" v-model="dataTable.single_data.voucher_description"></textarea>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Maksimal Digunakan </td>
                    <td width="65%">
                        <div class="input-group">
                          <input type="number" min="0" class="form-control" placeholder="Berapa Kali Voucher Ini Bisa Digunakan" v-model="dataTable.single_data.voucher_uses">
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon3" style="font-size: 0.9em;">Kali</span>
                          </div>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Penggunaan 1 User </td>
                    <td width="65%">
                        <div class="input-group">
                          <input type="number" min="0" class="form-control" placeholder="Maksimal Penggunaan 1 User" v-model="dataTable.single_data.voucher_max_users_uses">
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon3" style="font-size: 0.9em;">Kali</span>
                          </div>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Type Voucher </td>
                    <td width="65%">
                        <select class="form-control" v-model="dataTable.single_data.voucher_type" @change="diskonChange()">
                          <option value="1">Diskon Dalam Persen</option>
                          <option value="2">Diskon Dalam Nilai</option>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Jumlah Diskon </td>
                    <td width="65%">
                        <div class="input-group" v-if="stateDiskon == 1">
                          <input type="number" min="0" max="100" class="form-control" placeholder="Jumlah Diskon Yang Diberikan" v-model="dataTable.single_data.voucher_discount">
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon3" style="font-size: 0.9em;">%</span>
                          </div>
                        </div>

                        <div class="input-group" v-if="stateDiskon == 2">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3" style="font-size: 0.9em;">Rp.</span>
                          </div>
                          <input type="number" min="0" class="form-control" placeholder="Jumlah Diskon Yang Diberikan" v-model="dataTable.single_data.voucher_discount">
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Berlaku Sampai </td>
                    <td width="65%">
                        <input type="text" class="form-control datePick" placeholder="Pilih Tanggal" style="cursor: pointer;" readonly v-model="dataTable.single_data.voucher_ends_at">
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Is Fixed </td>
                    <td width="65%">
                        <select class="form-control" v-model="dataTable.single_data.is_fixed">
                          <option value="1">Ya</option>
                          <option value="0">Tidak</option>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                </table>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="editSave" :disabled="btn_update_disabled">Update</button>
          </div>

        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_edit_one" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="margin-top: 10px;">
        <div class="modal-content" style="border-radius: 1px; font-size: 0.8em;">
          <div class="modal-header" style="padding: 15px;">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #263238;">Edit Data @{{ contentHeader }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 15px; background: white;">
            <div class="row">
              <div class="col-md-12" style="border-right: 1px solid #eee;">
                <table id="form-table" border="0">

                  <tr>
                    <td width="30%" class="title"> Deskripsi Voucher </td>
                    <td width="65%">
                        <textarea class="form-control" rows="5" placeholder="Masukkan Placeholder" maxlength="300" v-model="dataTable.single_data.voucher_description"></textarea>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Maksimal Digunakan </td>
                    <td width="65%">
                        <div class="input-group">
                          <input type="number" min="0" class="form-control" placeholder="Berapa Kali Voucher Ini Bisa Digunakan" v-model="dataTable.single_data.voucher_uses">
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon3" style="font-size: 0.9em;">Kali</span>
                          </div>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Penggunaan 1 User </td>
                    <td width="65%">
                        <div class="input-group">
                          <input type="number" min="0" class="form-control" placeholder="Maksimal Penggunaan 1 User" v-model="dataTable.single_data.voucher_max_users_uses">
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon3" style="font-size: 0.9em;">Kali</span>
                          </div>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Type Voucher </td>
                    <td width="65%">
                        <select class="form-control" v-model="dataTable.single_data.voucher_type" @change="diskonChange()">
                          <option value="1">Diskon Dalam Persen</option>
                          <option value="2">Diskon Dalam Nilai</option>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Jumlah Diskon </td>
                    <td width="65%">
                        <div class="input-group" v-if="stateDiskon == 1">
                          <input type="number" min="0" max="100" class="form-control" placeholder="Jumlah Diskon Yang Diberikan" v-model="dataTable.single_data.voucher_discount">
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon3" style="font-size: 0.9em;">%</span>
                          </div>
                        </div>

                        <div class="input-group" v-if="stateDiskon == 2">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3" style="font-size: 0.9em;">Rp.</span>
                          </div>
                          <input type="number" min="0" class="form-control" placeholder="Jumlah Diskon Yang Diberikan" v-model="dataTable.single_data.voucher_discount">
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Berlaku Sampai </td>
                    <td width="65%">
                        <input type="text" class="form-control datePick" placeholder="Pilih Tanggal" style="cursor: pointer;" readonly v-model="dataTable.single_data.voucher_ends_at">
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Is Fixed </td>
                    <td width="65%">
                        <select class="form-control" v-model="dataTable.single_data.is_fixed">
                          <option value="1">Ya</option>
                          <option value="0">Tidak</option>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                </table>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="editSave" :disabled="btn_update_disabled">Update</button>
          </div>

        </div>
      </div>
    </div>

  </div>

@endsection


@section("extra_scripts")
  
  <script src="{{ URL::asset('js/component/vue_datatables.js') }}"></script>
  <script src="{{ asset('js/plugins/cropper/dist/cropper.min.js') }}"></script>

  <script>

    $(document).ready(function(){

      $('.datePick').datepicker( {
          format: "yyyy-mm-dd",
      }).on("changeDate", function(){
        app.dataTable.single_data.voucher_ends_at = $(this).val();
      });

      $('.datePick').datepicker("setStartDate", '{{ date('Y-m-d') }}');
    })

    var app = new Vue({
      el: '#vue-content',
      data: {
        btn_save_disabled   : false,
        btn_update_disabled : false,
        elapsedTime         : 0,
        contentHeader       : 'Voucher',
        dataSave            : [],
        selectedData        : [],
        changeState         : '',
        stateDiskon         : '1',

        dataTable: {
          columns: [
            { text: "Kode Voucher", searchable: true, index: "voucher_code", width:"12%", override: false },
            { text: "Maksimal", searchable: true, index: "voucher_uses", width:"12%", override: function(e){
              return e+' <small>Kali</small>';
            } },
            { text: "Jumlah Diskon", searchable: true, index: "voucher_discount", width:"10%", override: false },
            { text: "Type Voucher", searchable: true, index: "voucher_type", width:"10%", override: function(e){
              if(e == 1)
                return '<span class="badge badge-primary">Diskon Dalam Persen</span>';
              else
                return '<span class="badge badge-info">Diskon Dalam Rupiah</span>';
            } },
            { text: "Berlaku Sampai", searchable: true, index: "voucher_ends_at", width:"10%", override: false },
            
            /* semua object yang ada di column dibutuhkan sehingga tidak boleh ada satupun object yang tertinggal. 
            
                  object :
                      - text        -> hanya boleh String (text, searchable, index, width, override)
                      - searchable  -> hanya boleh Boolean true/false
                      - index       -> hanya boleh String (sesuai object di dalam array data)
                      - width       -> hanya boleh String (harus satuan ukuran px atau %)
                      - override    -> hanya boleh function / Boolean false (jika tidak menggunakan function)

            */ // Semua Harus Wajib Diisi.
          ],

          data: [],

          button_helper: ['D', 'E'],

          single_data: {
          	voucher_code            : '',
            voucher_description     : '',
            voucher_uses            : '',
            voucher_max_users_uses  : '',
            voucher_type            : '1',
            voucher_discount        : '',
            voucher_ends_at         : '',
            is_fixed                : '1',
          },

          size: 10,
        }

      },
      mounted: function(){
        console.log("Vue Ready");
        // $("#modal_tambah").modal("show");
      },
      created: function(){
        var start_time = new Date().getTime();

        axios.get(baseUrl+"/voucher/data/list")
              .then((response) => {
              	// console.log(response.data)
                this.dataTable.data = response.data;
                this.elapsedTime = ((new Date().getTime() - start_time) / 1000).toFixed(2).toString().replace('.', ',');
              }).catch((error) => {
                console.log(error)
              })
      },
      watch: {
        changeState: function(value){
          if(this.selectedData != 0){
	          var state = this.changeState;
	          var idx = _.findIndex(this.dataTable.data, function(o){ return o.id == state });
            this.dataTable.single_data.voucher_code = this.dataTable.data[idx].voucher_code;
            this.dataTable.single_data.voucher_description = this.dataTable.data[idx].voucher_description;
            this.dataTable.single_data.voucher_uses = this.dataTable.data[idx].voucher_uses;
            this.dataTable.single_data.voucher_max_users_uses = this.dataTable.data[idx].voucher_max_users_uses;
            this.dataTable.single_data.voucher_type = this.dataTable.data[idx].voucher_type;
            this.dataTable.single_data.voucher_discount = this.dataTable.data[idx].voucher_discount;
            this.dataTable.single_data.voucher_ends_at = this.dataTable.data[idx].voucher_ends_at;
            this.dataTable.single_data.is_fixed = this.dataTable.data[idx].is_fixed;
            this.stateDiskon = this.dataTable.single_data.voucher_type;
          }

          // console.log("change State");
        },
      },

      computed: {
        list_selected: function(){
          var data_selected = []; that = this;
          _.forEach(that.selectedData, function(value){
            data_selected.push(that.dataTable.data[_.findIndex(that.dataTable.data, function(o) { return o.id == value })]);
          })

          // console.log(data_selected);
          return data_selected ;
        }
      },

      methods: {
        add: function(event){
          event.preventDefault();
          this.dataTable.single_data.voucher_code = '';
          this.dataTable.single_data.voucher_description = '';
          this.dataTable.single_data.voucher_uses = '';
          this.dataTable.single_data.voucher_max_users_uses = '';
          this.dataTable.single_data.voucher_type = '1';
          this.dataTable.single_data.voucher_discount = '';
          this.dataTable.single_data.voucher_ends_at = '';
          this.dataTable.single_data.is_fixed = '1';

          $("#modal_tambah").modal("show");
        },

        edit: function(event){
          event.preventDefault();

          // console.log(this.dataTable.data);

          if(this.selectedData != 0){
            this.changeState = _.first(this.selectedData);
	          var state = this.changeState;
	          var idx = _.findIndex(this.dataTable.data, function(o){ return o.id == state });
            this.dataTable.single_data.voucher_code = this.dataTable.data[idx].voucher_code;
            this.dataTable.single_data.voucher_description = this.dataTable.data[idx].voucher_description;
            this.dataTable.single_data.voucher_uses = this.dataTable.data[idx].voucher_uses;
            this.dataTable.single_data.voucher_max_users_uses = this.dataTable.data[idx].voucher_max_users_uses;
            this.dataTable.single_data.voucher_type = this.dataTable.data[idx].voucher_type;
            this.dataTable.single_data.voucher_discount = this.dataTable.data[idx].voucher_discount;
            this.dataTable.single_data.voucher_ends_at = this.dataTable.data[idx].voucher_ends_at;
            this.dataTable.single_data.is_fixed = this.dataTable.data[idx].is_fixed;
            this.stateDiskon = this.dataTable.single_data.voucher_type;
          }

          $("#modal_edit").modal("show");
        },

        addSave: function(event){
          event.preventDefault();
          this.btn_save_disabled = true;
          this.dataTable.single_data.voucher_uses = ''+this.dataTable.single_data.voucher_uses;
          this.dataTable.single_data.voucher_max_users_uses = ''+this.dataTable.single_data.voucher_max_users_uses;
          this.dataTable.single_data.voucher_type = ''+this.dataTable.single_data.voucher_type;
          this.dataTable.single_data.voucher_discount = ''+this.dataTable.single_data.voucher_discount;
          this.dataTable.single_data.is_fixed = ''+this.dataTable.single_data.is_fixed;
          this.dataSave = this.dataTable.single_data;

          if(this.dataTable.single_data.voucher_max_users_uses == '' || this.dataTable.single_data.voucher_uses == '' || this.dataTable.single_data.voucher_discount == ''){
            $.alert("Tampaknya Ada Yang Salah Dengan Inputan Anda. Pastikan Inputan Dalam Bentuk Angka Harus Anda Isi Dengan Isian Angka.");
            this.btn_save_disabled = false; return;
          }else if(parseInt(this.dataTable.single_data.voucher_max_users_uses) > parseInt(this.dataTable.single_data.voucher_uses)){
            $.alert("Nilai Penggunaan 1 User Tidak Boleh lebih Besar Dari Nilai Maksimal Digunakan.");
            this.btn_save_disabled = false; return;
          }else if(_.some(this.dataTable.single_data, _.isEmpty)){
            $.alert("Tidak Boleh Ada Data Yang Kosong");
            this.btn_save_disabled = false; return;
          }

          axios.post(baseUrl + '/voucher/save', this.dataSave )
          .then((response) => {
            console.log(response.data);
            if(response.data.status == "berhasil"){
              this.btn_save_disabled = false;
              this.dataTable.data.unshift(response.data.content);
              $.toast({
                  heading: 'Penambahan Berhasil',
                  text: 'Data '+this.contentHeader+' Baru Berhasil Ditambahkan.',
                  position: 'top-right',
                  stack: false
              })
            }else if(response.data.status == "exist"){
              $.toast({
                  heading: 'Perubahan Gagal',
                  text: 'Voucher Dengan Kode '+response.data.content+' Sudah Ada Di Database, Data Ini Tidak Bisa Kami Simpan..',
                  icon: 'error',
                  position: 'top-right',
                  hideAfter: false,
                  stack: false
              })
            }else{
              console.log("local")
            }
          }).catch((error) => {
            alert(error);
          }).then((data) => {
            this.dataTable.single_data.voucher_code = '';
            this.dataTable.single_data.voucher_description = '';
            this.dataTable.single_data.voucher_uses = '';
            this.dataTable.single_data.voucher_max_users_uses = '';
            this.dataTable.single_data.voucher_type = '1';
            this.dataTable.single_data.voucher_discount = '';
            this.dataTable.single_data.voucher_ends_at = '';
            this.dataTable.single_data.is_fixed = '1';
          })

        },

        editSave: function(event){
          // event.preventDefault();
         this.btn_update_disabled = true; 
         this.dataTable.single_data.voucher_uses = ''+this.dataTable.single_data.voucher_uses;
         this.dataTable.single_data.voucher_max_users_uses = ''+this.dataTable.single_data.voucher_max_users_uses;
         this.dataTable.single_data.voucher_type = ''+this.dataTable.single_data.voucher_type;
         this.dataTable.single_data.voucher_discount = ''+this.dataTable.single_data.voucher_discount;
         this.dataTable.single_data.is_fixed = ''+this.dataTable.single_data.is_fixed;
         this.dataSave = this.dataTable.single_data;

          if(this.dataTable.single_data.voucher_max_users_uses == '' || this.dataTable.single_data.voucher_uses == '' || this.dataTable.single_data.voucher_discount == ''){
            $.alert("Tampaknya Ada Yang Salah Dengan Inputan Anda. Pastikan Inputan Dalam Bentuk Angka Harus Anda Isi Dengan Isian Angka.");
            this.btn_save_disabled = false; return;
          }else if(parseInt(this.dataTable.single_data.voucher_max_users_uses) > parseInt(this.dataTable.single_data.voucher_uses)){
            $.alert("Nilai Penggunaan 1 User Tidak Boleh lebih Besar Dari Nilai Maksimal Digunakan.");
            this.btn_save_disabled = false; return;
          }else if(_.some(this.dataTable.single_data, _.isEmpty)){
            $.alert("Tidak Boleh Ada Data Yang Kosong");
            this.btn_save_disabled = false; return;
          }

          axios.post(baseUrl + '/voucher/update', {data: this.dataSave, id: this.changeState})
          .then((response) => {
            console.log(response.data);
            if(response.data.status == "berhasil"){
              this.btn_update_disabled = false;
              var idx = this.dataTable.data.findIndex(u => u.id == response.data.content.id);
              this.dataTable.data[idx].voucher_code = response.data.content.voucher_code;
              this.dataTable.data[idx].voucher_description = response.data.content.voucher_description;
              this.dataTable.data[idx].voucher_uses = response.data.content.voucher_uses;
              this.dataTable.data[idx].voucher_max_users_uses = response.data.content.voucher_max_users_uses;
              this.dataTable.data[idx].voucher_type = response.data.content.voucher_type;
              this.dataTable.data[idx].voucher_discount = response.data.content.voucher_discount;
              this.dataTable.data[idx].voucher_ends_at = response.data.content.voucher_ends_at;
              this.dataTable.data[idx].is_fixed = response.data.content.is_fixed;

              $.toast({
                  heading: 'Perubahan Berhasil',
                  text: 'Data '+this.contentHeader+' Berhasil Diubah.',
                  position: 'top-right',
                  stack: false
              })
            }else if(response.data.status == "invalid"){
              this.btn_update_disabled = false;
              $.toast({
                  heading: 'Perubahan Gagal',
                  text: 'Data Voucher Yang Ingin Anda Edit Tidak Bisa Kami Temukan. Cobalah Untuk Memuat Ulang Halaman..',
                  icon: 'error',
                  position: 'top-right',
                  hideAfter: false,
                  stack: false
              })
            }else{
              console.log("localServer Error;")
            }
          }).catch((error) => {
            console.log(error);
          })
        },

        hapus: function() {
          if(this.selectedData.length == 0){
            // $.alert('Anda Harus Memilih Data Yang Akan Dihapus Terlebih Dahulu !', 'Terjadi Kesalahan')
            $.alert({
                icon: 'fa fa-warning',
                title: 'Terjadi Kesalahan',
                content: 'Tidak Ada Data Yang Dipilih!',
            });
            return;
          }
          that = this; dta = that.selectedData.length;

          $.confirm({
              title: 'Hapus Voucher?',
              content: dta + ' Data '+this.contentHeader+' Akan Dihapus, Apakah Anda Yakin ?.',
              autoClose: 'Tidak|5000',
              buttons: {
                  deleteUser: {
                      text: 'Ya',
                      action: function () {
                          axios.post(baseUrl + '/voucher/delete', that.selectedData)
                            .then((response) => {
                              console.log(response.data);
                              if(response.data.status == "berhasil"){
                                $.toast({
                                    heading: 'Hapus Data Berhasil',
                                    text: dta+ ' Data '+that.contentHeader+' Berhasil Dihapus.',
                                    position: 'top-right',
                                    stack: false
                                })
                              }
                              else{
                                console.log("local")
                              }
                            }).catch((error) => {
                              alert(error);
                            }).then(() => {
                                _.forEach(that.selectedData, function(value){
                                  that.dataTable.data.splice(_.findIndex(that.dataTable.data, function(o){ return o.id == value }), 1);
                                });

                                that.selectedData = [];
                            })
                      }
                  },
                  Tidak: function () {
                      $.alert('Hapus Data Dibatalkan.');
                  }
              }
          });

        },

        diskonChange: function(){
          this.stateDiskon = this.dataTable.single_data.voucher_type;
          this.dataTable.single_data.voucher_discount = '';
        },

        randomMe: function(length){
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            for(var i = 0; i < length; i++) {
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            }
            this.dataTable.single_data.voucher_code = text.toUpperCase();
        },

        selectedUnit: function(a){
          this.selectedData = a;

          this.changeState = _.first(this.selectedData);
        },

        getIcon: function(event){
          event.preventDefault();
          window.open("https://fontawesome.com/v4.7.0/icons/")
        },

        view_one: function(id){
          alert('View StandBy');
        },
        edit_one: function(id){
          var state = id; this.changeState = id;
          var idx = _.findIndex(this.dataTable.data, function(o){ return o.id == state });
          this.dataTable.single_data.voucher_code = this.dataTable.data[idx].voucher_code;
          this.dataTable.single_data.voucher_description = this.dataTable.data[idx].voucher_description;
          this.dataTable.single_data.voucher_uses = this.dataTable.data[idx].voucher_uses;
          this.dataTable.single_data.voucher_max_users_uses = this.dataTable.data[idx].voucher_max_users_uses;
          this.dataTable.single_data.voucher_type = this.dataTable.data[idx].voucher_type;
          this.dataTable.single_data.voucher_discount = this.dataTable.data[idx].voucher_discount;
          this.dataTable.single_data.voucher_ends_at = this.dataTable.data[idx].voucher_ends_at;
          this.dataTable.single_data.is_fixed = this.dataTable.data[idx].is_fixed;
          this.stateDiskon = this.dataTable.single_data.voucher_type;

          $("#modal_edit_one").modal("show");
        },
        delete_one: function(id){
          that = this;
          $.confirm({
              title: 'Hapus Voucher?',
              content: 'Data '+this.contentHeader+' Akan Dihapus, Apakah Anda Yakin ?.',
              autoClose: 'Tidak|5000',
              buttons: {
                  deleteUser: {
                      text: 'Ya',
                      action: function () {
                          axios.post(baseUrl + '/voucher/delete', [id])
                            .then((response) => {
                              console.log(response.data);
                              if(response.data.status == "berhasil"){
                                $.toast({
                                    heading: 'Hapus Data Berhasil',
                                    text: 'Data '+that.contentHeader+' Berhasil Dihapus.',
                                    position: 'top-right',
                                    stack: false
                                })
                              }
                              else{
                                console.log("local")
                              }
                            }).catch((error) => {
                              alert(error);
                            }).then(() => {
                              that.dataTable.data.splice(_.findIndex(that.dataTable.data, function(o){ return o.id == id }), 1);
                              if(that.selectedData.length != 0){
                                that.selectedData.splice(_.findIndex(that.selectedData, function(o){ return o == id }), 1);
                              }
                            })
                      }
                  },
                  Tidak: function () {
                      $.alert('Hapus Data Dibatalkan.');
                  }
              }
          });
        }
      }
    })

  </script>
@endsection