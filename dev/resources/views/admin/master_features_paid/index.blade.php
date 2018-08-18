@extends("admin.app")

@section("title", " Master Fitur Berbayar")


@section("extra_styles")

  <link rel="stylesheet" href="{{ asset('js/plugins/froala/css/froala_editor.min.css') }}">
  <link rel="stylesheet" href="{{ asset('js/plugins/froala/css/froala_style.min.css') }}">
  <link rel="stylesheet" href="{{ asset('js/plugins/froala/css/plugins/char_counter.min.css') }}">
  
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

    .form-table:not(:first-child){
      background: none;
      margin-top: 20px;
    }

    .form-table .title{
      color: #666;
      padding-top: 5px;
      padding-left: 30px
    }

    button:disabled,
    button[disabled]{
      cursor: no-drop;
    }

    .modal-lg {
        max-width: 50% !important;
    }

  </style>

@endsection


@section("content")

  <?php
    $override = "";
    if(isset($_GET["override"])){
      $override = $_GET["override"];
    }
  ?>
  
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
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 1px; font-size: 0.8em;">
          <div class="modal-header" style="padding: 15px;">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #263238;">Tambah Data @{{ contentHeader }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 15px; background: white;">
            <div class="row form-table">
              <div class="col-md-3 title">
                Nama Fitur
              </div>

              <div class="col-md-8">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Input Features Name" v-model="dataTable.single_data.paid_name" maxlength="70">

                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" style="font-size:0.9em; padding: 10px 15px 5px 15px;" disabled>
                      <span v-text="70 - dataTable.single_data.paid_name.length"></span> / 70
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="row form-table">
              <div class="col-md-3 title">
                Deskripsi Fitur
              </div>

              <div class="col-md-8">
                <textarea class="editor"></textarea>
              </div>
            </div>

            <div class="row form-table">
              <div class="col-md-3 title">
                Harga Fitur
              </div>

              <div class="col-md-8">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Input Features Price (number only)" v-model="dataTable.single_data.paid_price" @keypress="onlyNumber(this.event, dataTable.single_data.paid_price)">

                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" style="font-size:0.9em; padding: 10px 10px 5px 10px;" disabled>
                      Token
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="row form-table">
              <div class="col-md-3 title">
                Durasi Fitur
              </div>

              <div class="col-md-8">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Input Features Duration number only)" v-model="dataTable.single_data.paid_duration" @keypress="onlyNumber(this.event, dataTable.single_data.paid_duration)">

                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" style="font-size:0.9em; padding: 10px 15px 5px 15px;" disabled>
                      Hari
                    </button>
                  </div>
                </div>
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
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 1px; font-size: 0.8em;">
          <div class="modal-header" style="padding: 15px;">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #263238;">Edit Data @{{ contentHeader }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 15px; background: white;">

            <div class="col-md-12 text-center" v-if="selectedData.length == 0" style="color: #666;">Anda Harus Memilih Data Yang Akan Diedit Terlebih Dahulu.</div>

            <div v-show="!selectedData.length == 0">

              <div class="row form-table">
                <div class="col-md-3 title">
                  Data Yang Diedit
                </div>

                <div class="col-md-8">
                  <select class="form-control" style="width: 70%" v-model="changeState">
                    <option v-for="dat in list_selected" :value="dat.id">@{{ dat.paid_name }}</option>
                  </select>
                </div>
              </div>

              <div class="row form-table">
                <div class="col-md-3 title">
                  Nama Fitur
                </div>

                <div class="col-md-8">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Input Features Name" v-model="dataTable.single_data.paid_name" maxlength="70">

                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="button" style="font-size:0.9em; padding: 10px 15px 5px 15px;" disabled>
                        <span v-text="70 - dataTable.single_data.paid_name.length"></span> / 70
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row form-table">
                <div class="col-md-3 title">
                  Deskripsi Fitur
                </div>

                <div class="col-md-8">
                  <textarea class="editor"></textarea>
                </div>
              </div>

              <div class="row form-table">
                <div class="col-md-3 title">
                  Harga Fitur
                </div>

                <div class="col-md-8">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Input Features Price (number only)" v-model="dataTable.single_data.paid_price" @keypress="onlyNumber(this.event, dataTable.single_data.paid_price)">

                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="button" style="font-size:0.9em; padding: 10px 10px 5px 10px;" disabled>
                        Token
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row form-table">
                <div class="col-md-3 title">
                  Durasi Fitur
                </div>

                <div class="col-md-8">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Input Features Duration number only)" v-model="dataTable.single_data.paid_duration" @keypress="onlyNumber(this.event, dataTable.single_data.paid_duration)">

                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="button" style="font-size:0.9em; padding: 10px 15px 5px 15px;" disabled>
                        Hari
                      </button>
                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="editSave" :disabled="btn_update_disabled" v-if="selectedData.length != 0">Simpan Perubahan</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_edit_one" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 1px; font-size: 0.8em;">
          <div class="modal-header" style="padding: 15px;">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #263238;">Edit Data @{{ contentHeader }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 15px; background: white;">

            <div>

              <div class="row form-table">
                <div class="col-md-3 title">
                  Nama Fitur
                </div>

                <div class="col-md-8">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Input Features Name" v-model="dataTable.single_data.paid_name" maxlength="70">

                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="button" style="font-size:0.9em; padding: 10px 15px 5px 15px;" disabled>
                        <span v-text="70 - dataTable.single_data.paid_name.length"></span> / 70
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row form-table">
                <div class="col-md-3 title">
                  Deskripsi Fitur
                </div>

                <div class="col-md-8">
                  <textarea class="editor"></textarea>
                </div>
              </div>

              <div class="row form-table">
                <div class="col-md-3 title">
                  Harga Fitur
                </div>

                <div class="col-md-8">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Input Features Price (number only)" v-model="dataTable.single_data.paid_price" @keypress="onlyNumber(this.event, dataTable.single_data.paid_price)">

                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="button" style="font-size:0.9em; padding: 10px 10px 5px 10px;" disabled>
                        Token
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row form-table">
                <div class="col-md-3 title">
                  Durasi Fitur
                </div>

                <div class="col-md-8">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Input Features Duration number only)" v-model="dataTable.single_data.paid_duration" @keypress="onlyNumber(this.event, dataTable.single_data.paid_duration)">

                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="button" style="font-size:0.9em; padding: 10px 15px 5px 15px;" disabled>
                        Hari
                      </button>
                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="editSave" :disabled="btn_update_disabled">Simpan Perubahan</button>
          </div>
        </div>
      </div>
    </div>

  </div>

@endsection


@section("extra_scripts")
  
  <script src="{{ URL::asset('js/plugins/froala/js/froala_editor.min.js') }}"></script>
  <script src="{{ URL::asset('js/plugins/froala/js/plugins/char_counter.min.js') }}"></script>
  <script src="{{ URL::asset('js/component/vue_datatables.js') }}"></script>

  <script>
      
    $(function() {
      $('.editor').froalaEditor({
        toolbarButtons: ['bold', 'italic', 'underline', '|', 'strikeThrough', 'subscript', 'superscript'],
        placeholderText: 'Type Features Description...',
        charCounterMax: 200,
        htmlAllowedTags: ['strong', 'u', 'em', 's', 'sub', 'sup'],
        multiLine: false,
        enter: $.FroalaEditor.ENTER_DIV
      })

      $('.editor').on('froalaEditor.contentChanged', function (e, editor) {
        app.dataTable.single_data.paid_description = $(this).val();
      });
    });

    var app = new Vue({
      el: '#vue-content',
      data: {
        btn_save_disabled   : false,
        btn_update_disabled : false,
        elapsedTime         : 0,
        contentHeader       : 'Fitur Berbayar',
        dataSave            : [],
        selectedData        : [],
        changeState         : '',

        dataTable: {
          columns: [
            { text: "Nomor Fitur", searchable: true, index: "paid_code", width:"15%", override: function(e){ return e } },
            { text: "Nama Fitur", searchable: true, index: "paid_name", width:"20%", override: function(e){ return e } },
            { text: "Harga Fitur", searchable: true, index: "paid_price", width:"10%", override: function(e){ return e + ' <small><b>Token</b></small>' } },
            { text: "Durasi Fitur", searchable: true, index: "paid_duration", width:"10%", override: function(e){ return e + ' <small><b>Hari</b></small>' } },
            { text: "Dibuat", searchable: true, index: "created_at", width:"10%", override: false },

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

          button_helper: ['E', 'D'],

          single_data: {
            paid_code: 'null',
            paid_name: '',
            paid_description: '',
            paid_price: '',
            paid_duration: '',
          },

          size: 10,
        }

      },
      mounted: function(){
        console.log("Vue Ready");
        if('{{ $override }}' == "create"){
          this.add();
        }
        // console.log(this.selectedData.length);
      },
      created: function(){
        var start_time = new Date().getTime();

        axios.get(baseUrl + "/master_features_paid/list")
              .then((response) => {
                // console.log(response.data);
                this.dataTable.data = response.data
                this.elapsedTime = ((new Date().getTime() - start_time) / 1000).toFixed(2).toString().replace('.', ',');
              }).catch((error) => {
                console.log(error)
              })
      },
      watch: {
        changeState: function(value){
          if(this.selectedData != 0){
            var idx = _.findIndex(this.dataTable.data, function(o){ return o.id == value });
            this.dataTable.single_data.paid_code = this.dataTable.data[idx].paid_code;
            this.dataTable.single_data.paid_name = this.dataTable.data[idx].paid_name;
            this.dataTable.single_data.paid_description = this.dataTable.data[idx].paid_description;
            this.dataTable.single_data.paid_price = this.dataTable.data[idx].paid_price.toString();
            this.dataTable.single_data.paid_duration = this.dataTable.data[idx].paid_duration.toString();

            $('.editor').froalaEditor('html.set', this.dataTable.single_data.paid_description);
          }

          // console.log(this.dataTable.single_data);
        },
      },

      computed: {
        list_selected: function(){
          var data_selected = []; that = this;
          _.forEach(that.selectedData, function(value){
            data_selected.push(that.dataTable.data[_.findIndex(that.dataTable.data, function(o) { return o.id == value })]);
          })

          return data_selected ;
        }
      },

      methods: {
        // required

        add: function(){
          this.dataTable.single_data.paid_code = "null";
          this.dataTable.single_data.paid_name = "";
          this.dataTable.single_data.paid_description = "";
          this.dataTable.single_data.paid_price = "";
          this.dataTable.single_data.paid_duration = "";

          $('.editor').froalaEditor('html.set', '');
          $("#modal_tambah").modal("show");
        },

        edit: function(event){
          event.preventDefault();

          if(this.selectedData != 0){
            var state = this.changeState;
            var idx = _.findIndex(this.dataTable.data, function(o){ return o.id == state });
            this.dataTable.single_data.paid_code = this.dataTable.data[idx].paid_code;
            this.dataTable.single_data.paid_name = this.dataTable.data[idx].paid_name;
            this.dataTable.single_data.paid_description = this.dataTable.data[idx].paid_description;
            this.dataTable.single_data.paid_price = this.dataTable.data[idx].paid_price.toString();
            this.dataTable.single_data.paid_duration = this.dataTable.data[idx].paid_duration.toString();

            $('.editor').froalaEditor('html.set', this.dataTable.single_data.paid_description);
          }

          $("#modal_edit").modal("show");
        },

        addSave: function(event){
          event.preventDefault();
          this.btn_save_disabled = true;
          this.dataSave = this.dataTable.single_data;
          // console.log($(".editor").val());

          if(_.some(this.dataTable.single_data, _.isEmpty)){
            $.alert("Tidak Boleh Ada Data Yang Kosong");
            this.btn_save_disabled = false; return;
          }

          // console.log(this.dataTable.single_data);

          axios.post(baseUrl + '/master_features_paid/save', this.dataSave)
          .then((response) => {
            // console.log(response.data);
            if(response.data.status == "berhasil"){
              this.btn_save_disabled = false;
              this.dataTable.data.unshift(response.data.content);
              $.toast({
                  heading: 'Penambahan Berhasil',
                  text: 'Data '+this.contentHeader+' Baru Berhasil Ditambahkan.',
                  position: 'top-right',
                  stack: false
              })
            }
            else{
              console.log("local")
            }
          }).catch((error) => {
            alert(error);
          }).then((data) => {
            this.dataTable.single_data.paid_name = ""; this.dataTable.single_data.paid_description = "";
            this.dataTable.single_data.paid_price = ""; this.dataTable.single_data.paid_duration = "";
            $('.editor').froalaEditor('html.set', '');
          })
        },

        editSave: function(event){
          event.preventDefault();
          this.btn_update_disabled = true;
          this.dataSave = this.dataTable.single_data;

          // console.log(this.dataTable.single_data);

          if(_.some(this.dataTable.single_data, _.isEmpty)){
            alert("Tidak Boleh Ada Data Yang Kosong");
            this.btn_update_disabled = false; return;
          }

          // console.log(this.single_data);

          axios.post(baseUrl + '/master_features_paid/update', this.dataSave)
          .then((response) => {
            // console.log(response.data);
            if(response.data.status == "berhasil"){
              this.btn_update_disabled = false;
              this.dataTable.data[_.findIndex(this.dataTable.data, function(o) { return o.id == response.data.content.id; })].paid_name = response.data.content.paid_name;
              this.dataTable.data[_.findIndex(this.dataTable.data, function(o) { return o.id == response.data.content.id; })].paid_description = response.data.content.paid_description;
              this.dataTable.data[_.findIndex(this.dataTable.data, function(o) { return o.id == response.data.content.id; })].paid_price = response.data.content.paid_price;
              this.dataTable.data[_.findIndex(this.dataTable.data, function(o) { return o.id == response.data.content.id; })].paid_duration = response.data.content.paid_duration;
              $.toast({
                  heading: 'Perubahan Berhasil',
                  text: 'Data '+this.contentHeader+' Berhasil Diubah.',
                  position: 'top-right',
                  stack: false
              })
            }
            else{
              console.log("localServer Error;")
            }
          }).catch((error) => {
            alert(error);
          })
        },

        hapus: function() {
          if(this.selectedData.length == 0){
            $.alert({
                icon: 'fa fa-warning',
                title: 'Terjadi Kesalahan',
                content: 'Tidak Ada Data Yang Dipilih!',
            });
            return;
          }
          that = this; dta = that.selectedData.length;

          $.confirm({
              title: 'Hapus Kategori?',
              content: dta + ' Data '+this.contentHeader+' Akan Dihapus, Apakah Anda Yakin ?.',
              autoClose: 'Tidak|5000',
              buttons: {
                  deleteUser: {
                      text: 'Ya',
                      action: function () {
                          axios.post(baseUrl + '/master_features_paid/delete', that.selectedData)
                            .then((response) => {
                              // console.log(response.data);
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

        selectedUnit: function(a){
          this.selectedData = a;

          this.changeState = _.first(this.selectedData);
        },

        // end required

        onlyNumber: function(event, value){
          var checker = /[0-9]/g;

          if(!checker.test(event.key) || parseInt(event.key) == 0 && value == '')
            event.preventDefault()
          else
            return true;
        },

        view_one: function(id){
          alert('View StandBy');
        },
        edit_one: function(id){
          var state = id;
          var idx = _.findIndex(this.dataTable.data, function(o){ return o.id == state });
          this.dataTable.single_data.paid_code = this.dataTable.data[idx].paid_code;
          this.dataTable.single_data.paid_name = this.dataTable.data[idx].paid_name;
          this.dataTable.single_data.paid_description = this.dataTable.data[idx].paid_description;
          this.dataTable.single_data.paid_price = this.dataTable.data[idx].paid_price.toString();
          this.dataTable.single_data.paid_duration = this.dataTable.data[idx].paid_duration.toString();

          $('.editor').froalaEditor('html.set', this.dataTable.single_data.paid_description);

          $("#modal_edit_one").modal("show");
        },
        delete_one: function(id){
          that = this;
          $.confirm({
              title: 'Hapus Kategori?',
              content: 'Data '+this.contentHeader+' Akan Dihapus, Apakah Anda Yakin ?.',
              autoClose: 'Tidak|5000',
              buttons: {
                  deleteUser: {
                      text: 'Ya',
                      action: function () {
                          axios.post(baseUrl + '/master_features_paid/delete', [id])
                            .then((response) => {
                              // console.log(response.data);
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