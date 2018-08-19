@extends("admin.app")

@section("title", " Master Pop Up")


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
      <div class="modal-dialog modal-lg" role="document" style="margin-top: 10px;">
        <div class="modal-content" style="border-radius: 1px; font-size: 0.8em;">
          <div class="modal-header" style="padding: 15px;">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #263238;">Tambah Data @{{ contentHeader }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 15px; background: white;">
            <div class="row">
              <div class="col-md-6" style="border-right: 1px solid #eee;">
                <table id="form-table" border="0">

                  <tr>
                    <td width="30%" class="title"> Type Pop Up </td>
                    <td width="65%">
                        <select id="jenis_popup" class="form-control" v-model="dataTable.single_data.type_popup">
                          <option value="text">Text</option>
                          <option value="image">Image</option>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Untuk Halaman </td>
                    <td width="65%">
                        <select id="jenis_popup" class="form-control" v-model="dataTable.single_data.halaman">
                          <option value="home">Home</option>
                          <option value="list_iklan">List Iklan</option>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Berlaku Hingga </td>
                    <td width="65%">
                        <input type="text" class="form-control datePick" placeholder="Pilih Tanggal" style="cursor: pointer;" readonly v-model="dataTable.single_data.berlaku_sampai">
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Judul Popup </td>
                    <td width="65%">
                        <input type="text" class="form-control" placeholder="Masukkan Nama PopUp" v-model="dataTable.single_data.judul_popup">
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title" style="vertical-align: top; padding-top: 15px"> Kontent Popup </td>
                    <td width="65%">
                        <textarea class="form-control" cols="5" rows="5" placeholder="Masukkan Content PopPup" v-model="dataTable.single_data.content_popup">
                          
                        </textarea>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Url Link </td>
                    <td width="65%">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3" style="font-size: 0.9em;">http://</span>
                          </div>
                          <input type="text" class="form-control" placeholder="Masukkan Url Link" v-model="dataTable.single_data.link_redirect">
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>
                </table>
              </div>

              <div class="col-md-6">
                <div class="col-md-12 text-center text-muted">
                  <small>Jika Jenis Pop Up Text, Maka Gambar Tidak Wajib Diisi.</small>
                </div>

                <div class="col-md-12" style="padding: 0px; margin-top: 10px;">
                  <div style="width: 28em; height: 18em; margin: 0 auto;">
                      <img id="image" src="{{asset('images/ad-default.png')}}" alt="Picture" />
                  </div>
                  <input type="file" id="uploader" style="margin-top: 20px;" />
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
      <div class="modal-dialog modal-lg" role="document" style="margin-top: 10px;">
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
              <div class="col-md-6" style="border-right: 1px solid #eee;">
                <table id="form-table" border="0">

                  <tr>
                    <td width="25%" class="title"> Data Yang Diedit </td>
                    <td colspan="2">
                        <select class="form-control" style="width: 70%" v-model="changeState">
                          <option v-for="dat in list_selected" :value="dat.id">@{{ dat.judul_popup }}</option>
                        </select>
                    </td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Type Pop Up </td>
                    <td width="65%">
                        <select id="jenis_popup" class="form-control" v-model="dataTable.single_data.type_popup">
                          <option value="text">Text</option>
                          <option value="image">Image</option>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Untuk Halaman </td>
                    <td width="65%">
                        <select id="jenis_popup" class="form-control" v-model="dataTable.single_data.halaman">
                          <option value="home">Home</option>
                          <option value="list_iklan">List Iklan</option>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Berlaku Hingga </td>
                    <td width="65%">
                        <input type="text" class="form-control datePick" placeholder="Pilih Tanggal" style="cursor: pointer;" readonly v-model="dataTable.single_data.berlaku_sampai">
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Judul Popup </td>
                    <td width="65%">
                        <input type="text" class="form-control" placeholder="Masukkan Nama PopUp" v-model="dataTable.single_data.judul_popup">
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title" style="vertical-align: top; padding-top: 15px"> Kontent Popup </td>
                    <td width="65%">
                        <textarea class="form-control" cols="5" rows="5" placeholder="Masukkan Content PopPup" v-model="dataTable.single_data.content_popup">
                          
                        </textarea>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Url Link </td>
                    <td width="65%">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3" style="font-size: 0.9em;">http://</span>
                          </div>
                          <input type="text" class="form-control" placeholder="Masukkan Url Link" v-model="dataTable.single_data.link_redirect">
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>
                </table>
              </div>

              <div class="col-md-6">
                <div class="col-md-12 text-center text-muted">
                  <small>Jika Jenis Pop Up Text, Maka Gambar Tidak Wajib Diisi.</small>
                </div>

                <div class="col-md-12" style="padding: 0px; margin-top: 10px;">
                  <div style="width: 28em; height: 18em; margin: 0 auto;">
                      <img id="image_edit" src="{{asset('images/ad-default.png')}}" alt="Picture" />
                  </div>
                  <input type="file" id="uploader_edit" style="margin-top: 20px;" />
                </div>
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
        app.dataTable.single_data.berlaku_sampai = $(this).val();
      });

      $('.datePick').datepicker("setStartDate", '{{ date('Y-m-d') }}');

      $image = $("#image").cropper({
            viewMode: 3,
            dragMode: 'move',
            autoCropArea: 1,
            restore: false,
            modal: true,
            guides: true,
            highlight: false,
            cropBoxMovable: false,
            cropBoxResizable: false,
            toggleDragModeOnDblclick: false,
        });

      $("#uploader").change(function() {
            var $image = $("#image");
            var $inputImage = $(this);
            if (window.FileReader) {
                $("#infoo").text("Mengupload...");
                var fileReader = new FileReader(),
                    files = this.files,
                    file;
                if (!files.length) {
                    return;
                }
                file = files[0];
                if (/^image\/\w+$/.test(file.type)) {
                    fileReader.readAsDataURL(file);
                    fileReader.onload = function() {
                        var size = file.size / 1024;
                        if (Math.round(size) > 800) {
                            $.dialog({
                                title: 'Upload Gagal',
                                content: 'Ukuran Gambar Tidak Boleh Melebihi 800 kb.',
                            });
                            $("#status_upload").css("display", "none");
                            $(".btn_image").attr("disabled", false);
                            $inputImage.val("");
                            return;
                        }
                        $image.cropper("reset", true).cropper("replace", this.result);
                    };
                } else {
                    $.dialog({
                        title: 'Upload Gagal',
                        content: 'File Yang Akan Anda Upload Bukan Termasuk Gambar (Jpg/Png).',
                    });
                    $inputImage.val("");
                }
            } else {
                return;
                //$inputImage.addClass("hide");
            }
        });

        $image_edit = $("#image_edit").cropper({
            viewMode: 3,
            dragMode: 'move',
            autoCropArea: 1,
            restore: false,
            modal: true,
            guides: true,
            highlight: false,
            cropBoxMovable: false,
            cropBoxResizable: false,
            toggleDragModeOnDblclick: false,
        });

      $("#uploader_edit").change(function() {
            var $image = $("#image_edit");
            var $inputImage = $(this);
            if (window.FileReader) {
                $("#infoo").text("Mengupload...");
                var fileReader = new FileReader(),
                    files = this.files,
                    file;
                if (!files.length) {
                    return;
                }
                file = files[0];
                if (/^image\/\w+$/.test(file.type)) {
                    fileReader.readAsDataURL(file);
                    fileReader.onload = function() {
                        var size = file.size / 1024;
                        if (Math.round(size) > 800) {
                            $.dialog({
                                title: 'Upload Gagal',
                                content: 'Ukuran Gambar Tidak Boleh Melebihi 800 kb.',
                            });
                            $("#status_upload").css("display", "none");
                            $(".btn_image").attr("disabled", false);
                            $inputImage.val("");
                            return;
                        }
                        $image.cropper("reset", true).cropper("replace", this.result);
                    };
                } else {
                    $.dialog({
                        title: 'Upload Gagal',
                        content: 'File Yang Akan Anda Upload Bukan Termasuk Gambar (Jpg/Png).',
                    });
                    $inputImage.val("");
                }
            } else {
                return;
                //$inputImage.addClass("hide");
            }
        });
    })

    var app = new Vue({
      el: '#vue-content',
      data: {
        btn_save_disabled   : false,
        btn_update_disabled : false,
        elapsedTime         : 0,
        contentHeader       : 'Pop Up',
        dataSave            : [],
        selectedData        : [],
        categoryParrent    	: [],
        changeState         : '',

        dataTable: {
          columns: [
            { text: "Judul Popup", searchable: true, index: "judul_popup", width:"10%", override: false },
            { text: "konten Popup", searchable: true, index: "content_popup", width:"20%", override: false },
            { text: "Halaman", searchable: true, index: "halaman", width:"10%", override: false },
            { text: "Berlaku Sampai", searchable: true, index: "berlaku_sampai", width:"20%", override: false },
            { text: "Type Popup", searchable: true, index: "type_popup", width:"10%", override: false },
            
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
          button_helper: ['D'],

          single_data: {
          	type_popup:  'text',
            halaman:     'home',
            judul_popup:  '',
            content_popup: '',
            berlaku_sampai: '',
            link_redirect: '',
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

        axios.get(baseUrl+"/pop_up/data/list")
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
            this.dataTable.single_data.id = this.dataTable.data[idx].id;
            this.dataTable.single_data.type_popup = this.dataTable.data[idx].type_popup;
            this.dataTable.single_data.halaman = this.dataTable.data[idx].halaman;
            this.dataTable.single_data.berlaku_sampai = this.dataTable.data[idx].berlaku_sampai;
            this.dataTable.single_data.judul_popup = this.dataTable.data[idx].judul_popup;
            this.dataTable.single_data.content_popup = this.dataTable.data[idx].content_popup;
            this.dataTable.single_data.link_redirect = this.dataTable.data[idx].link_redirect;
            $image_edit.cropper("reset", true).cropper("replace", '{{ url('/') }}/images/popup/pop_up_'+this.dataTable.data[idx].id+".png");
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

          console.log(data_selected);
          return data_selected ;
        }
      },

      methods: {
        add: function(event){
          event.preventDefault();
          this.dataTable.single_data.type_popup = "text";
          this.dataTable.single_data.halaman = "home";
          this.dataTable.single_data.berlaku_sampai = "";
          this.dataTable.single_data.judul_popup = "";
          this.dataTable.single_data.content_popup = "";
          this.dataTable.single_data.link_redirect = "";
          $image.cropper("reset", true).cropper("replace", '{{asset('images/ad-default.png')}}');
          $('#uploader').val('');

          $("#modal_tambah").modal("show");
        },

        edit: function(event){
          event.preventDefault();

          if(this.selectedData != 0){
	          var state = this.changeState;
	          var idx = _.findIndex(this.dataTable.data, function(o){ return o.id == state });
            this.dataTable.single_data.id = this.dataTable.data[idx].id;
            this.dataTable.single_data.type_popup = this.dataTable.data[idx].type_popup;
            this.dataTable.single_data.halaman = this.dataTable.data[idx].halaman;
            this.dataTable.single_data.berlaku_sampai = this.dataTable.data[idx].berlaku_sampai;
            this.dataTable.single_data.judul_popup = this.dataTable.data[idx].judul_popup;
            this.dataTable.single_data.content_popup = this.dataTable.data[idx].content_popup;
            this.dataTable.single_data.link_redirect = this.dataTable.data[idx].link_redirect;
            $image_edit.cropper("reset", true).cropper("replace", '{{ url('/') }}/images/popup/pop_up_'+this.dataTable.data[idx].id+".png");
          }

          $("#modal_edit").modal("show");
        },

        addSave: function(event){
          event.preventDefault();
          this.btn_save_disabled = true;
          this.dataSave = this.dataTable.single_data;

          if(_.some(this.dataTable.single_data, _.isEmpty)){
            $.alert("Tidak Boleh Ada Data Yang Kosong");
            this.btn_save_disabled = false; return;
          }

          // else if(this.dataTable.single_data.type_popup == 'image' && $('#uploader').val() == ""){
          //   $.alert("Popup Type Image Wajib Memiliki Gambar..");
          //   this.btn_save_disabled = false; return;
          // }

          var cropResult = $image.cropper('getCroppedCanvas').toDataURL("image/png");

          axios.post(baseUrl + '/pop_up/save', {data: this.dataSave, imgPath: cropResult })
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
            }else if(response.data.status == "exist"){
              $.toast({
                  heading: 'Perubahan Gagal',
                  text: 'Halaman '+response.data.content.halaman+' Sedang Memiliki PopUp Yang Masih Aktif, Sehingga Data Yang Anda Simpan Tidak Berhasil Kami Simpan..',
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
            // this.dataTable.single_data.type_popup = "text";
            // this.dataTable.single_data.halaman = "home";
            // this.dataTable.single_data.berlaku_sampai = "";
            // this.dataTable.single_data.judul_popup = "";
            // this.dataTable.single_data.content_popup = "";
            // this.dataTable.single_data.link_redirect = "";
            // $("#uploader").val('');
          })

        },

        editSave: function(event){
          // event.preventDefault();
          this.btn_update_disabled = true;
          this.dataSave = this.dataTable.single_data;
          this.dataTable.single_data.id = ''+this.dataTable.single_data.id; 

          console.log('a');

          if(_.some(this.dataTable.single_data, _.isEmpty)){
            alert("Tidak Boleh Ada Data Yang Kosong");
            this.btn_update_disabled = false; return;
          }

          axios.post(baseUrl + '/pop_up/update', {data: this.dataSave, imgPath: $image_edit.cropper('getCroppedCanvas').toDataURL("image/png") })
          .then((response) => {
            // console.log(response.data);
            if(response.data.status == "berhasil"){
              this.btn_update_disabled = false;
              var idx = this.dataTable.data.findIndex(u => u.id == response.data.content.id);
              this.dataTable.data[idx].judul_popup = response.data.content.judul_popup;
              this.dataTable.data[idx].content_popup = response.data.content.content_popup;
              this.dataTable.data[idx].halaman = response.data.content.halaman;
              this.dataTable.data[idx].berlaku_sampai = response.data.content.berlaku_sampai;
              this.dataTable.data[idx].type_popup = response.data.content.type_popup;
              this.dataTable.data[idx].link_redirect = response.data.content.link_redirect;

              $.toast({
                  heading: 'Perubahan Berhasil',
                  text: 'Data '+this.contentHeader+' Berhasil Diubah.',
                  position: 'top-right',
                  stack: false
              })
            }else if(response.data.status == "exist"){
              $.toast({
                  heading: 'Perubahan Gagal',
                  text: 'Halaman '+response.data.content.halaman+' Sedang Memiliki PopUp Yang Masih Aktif, Sehingga Data Yang Anda Update Tidak Berhasil Kami Lakukan..',
                  icon: 'error',
                  position: 'top-right',
                  hideAfter: false,
                  stack: false
              })
            }else if(response.data.status == "invalid"){
              $.toast({
                  heading: 'Perubahan Gagal',
                  text: 'Data PopUp Yang Ingin Anda Edit Tidak Bisa Kami Temukan. Cobalah Untuk Memuat Ulang Halaman..',
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
              title: 'Hapus PopUp?',
              content: dta + ' Data '+this.contentHeader+' Akan Dihapus, Apakah Anda Yakin ?.',
              autoClose: 'Tidak|5000',
              buttons: {
                  deleteUser: {
                      text: 'Ya',
                      action: function () {
                          axios.post(baseUrl + '/pop_up/delete', that.selectedData)
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
          alert('Edit StandBy');
        },
        delete_one: function(id){
          that = this;

          $.confirm({
              title: 'Hapus PopUp?',
              content: 'Data '+this.contentHeader+' Akan Dihapus, Apakah Anda Yakin ?.',
              autoClose: 'Tidak|5000',
              buttons: {
                  deleteUser: {
                      text: 'Ya',
                      action: function () {
                          axios.post(baseUrl + '/pop_up/delete', [id])
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