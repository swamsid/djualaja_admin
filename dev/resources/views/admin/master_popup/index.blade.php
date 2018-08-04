@extends("admin.app")

@section("title", " Master Sub Kategori")


@section("extra_styles")
  
  <link href="{{asset('js/plugins/cropper/dist/cropper.min.css')}}" rel="stylesheet">
  <link href="{{asset('js/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">

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
          <div class="col-11">
            <ol class="breadcrumb breadcrumb-custom">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Data Master</a></li>
              <li class="breadcrumb-item active" aria-current="page"><span>Master @{{ contentHeader }}</span></li>
            </ol>
          </div>

          <div class="col-1" style="padding: 5px 0px; background: none; height: 45px; border: 0px solid #ddd;">
            
            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="text-decoration: none;">
              <button type="button" class="btn btn-dark btn-xs" style="border: 0px solid white; height: 35px;">
                &nbsp; <i class="fa fa-ellipsis-v"></i> OPSI
              </button>
            </a>

          </div>
        </div>
      </nav>

    </div>

    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
      <div class="card">
        <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body" style="padding: 0px;">
              <ul class="opsi">
                <li class="hovered" @click="add"><a href="#"><i class="fa fa-plus"></i> &nbsp;Tambah Data</a></li>
                <li class="hovered" @click="edit"><a href="#"><i class="fa fa-pencil"></i> &nbsp;Edit Data</a></li>
                <li class="hovered" @click="hapus"><a href="#"><i class="fa fa-eraser"></i> &nbsp;Hapus Data</a></li>

                <li class="hovered" style="float: right;"><a href="#news"><i class="fa fa-file-pdf-o"></i> &nbsp;Print Pdf</a></li>
                <li class="hovered" style="float: right;"><a href="#contact"><i class="fa fa-file-excel-o"></i> &nbsp;Print Excel</a></li>
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
              <data-list-category :list-data="dataTable.data" :size="dataTable.size" :columns="dataTable.columns" :data_category="dataTable.single_data" :dataTab="dataTable.data" @get_select_unit="selectedUnit"></data-list-category>
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
                        <input type="text" class="form-control" placeholder="Pilih Tanggal" style="cursor: pointer;" readonly id="datePick" v-model="dataTable.single_data.berlaku_sampai">
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
                        <input type="text" class="form-control" placeholder="Masukkan Url Link" v-model="dataTable.single_data.link_redirect">
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
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 1px; font-size: 0.8em;">
          <div class="modal-header" style="padding: 15px;">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #263238;">Edit Data @{{ contentHeader }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 15px; background: white;">
            <div class="col-md-12 text-center" v-if="selectedData.length == 0" style="color: #666;">Anda Harus Memilih Data Yang Akan Diedit Terlebih Dahulu.</div>
            <table id="form-table" border="0" v-show="selectedData.length != 0">
              <tr>
                <td width="25%" class="title"> Data Yang Diedit </td>
                <td colspan="2">
                    <select class="form-control" style="width: 70%" v-model="changeState">
                      <option v-for="dat in list_selected" :value="dat.id">@{{ dat.name }}</option>
                    </select>
                </td>
              </tr>

              <tr>
                <td width="30%" class="title"> Nama Sub Kategori </td>
                <td width="65%">
                    <input type="text" class="form-control" id="kategori_name" placeholder="Input Sub Category Name" style="width: 100%" v-model="dataTable.single_data.name">
                </td>
                <td></td>
                <td></td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="editSave" :disabled="btn_update_disabled" v-if="selectedData.length != 0">Simpan Perubahan</button>
          </div>
        </div>
      </div>
    </div>

  </div>

@endsection


@section("extra_scripts")
  
  <script src="{{ URL::asset('js/component/vue_datatables.js') }}"></script>
  <script src="{{ asset('js/plugins/cropper/dist/cropper.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

  <script>

    var $image = null;

    $(document).ready(function(){

      $('#datePick').datepicker( {
          format: "yyyy-mm-dd",
      }).on("changeDate", function(){
        app.dataTable.single_data.berlaku_sampai = $(this).val();
      });

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
        categoryParrent 	: [],
        changeState          : '',

        dataTable: {
          columns: [
            { text: "Nomor Kategori", searchable: true, index: "category_id", width:"15%", override: false },
            { text: "Nama Kategori", searchable: true, index: "name", width:"20%", override: false },
            { text: "Sub Kategori Dari", searchable: true, index: "parrent_name", width:"10%", override: false },
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
        $("#modal_tambah").modal("show");
      },
      created: function(){
        var start_time = new Date().getTime();

        axios.get(baseUrl + "/master_sub_kategori/list")
              .then((response) => {
              	// console.log(response)
                this.dataTable.data = response.data.data;
                this.categoryParrent = response.data.parrent;
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
	          this.dataTable.single_data.category_id = this.dataTable.data[idx].category_id;
	          this.dataTable.single_data.name = this.dataTable.data[idx].name;
	          this.dataTable.single_data.parrent = this.dataTable.data[idx].parrent_cat_id;
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

          // console.log("list_selected");
          return data_selected ;
        }
      },

      methods: {
        add: function(event){
          event.preventDefault();
          this.dataTable.single_data.category_id = 'random';
          this.dataTable.single_data.parrent = _.first(this.categoryParrent).parrent;
          this.dataTable.single_data.name= "";
          $("#modal_tambah").modal("show");
        },

        edit: function(event){
          event.preventDefault();

          if(this.selectedData != 0){
	          var state = this.changeState;
	          var idx = _.findIndex(this.dataTable.data, function(o){ return o.id == state });
	          this.dataTable.single_data.category_id = this.dataTable.data[idx].category_id;
	          this.dataTable.single_data.name = this.dataTable.data[idx].name;
	          this.dataTable.single_data.parrent = this.dataTable.data[idx].parrent_cat_id;
          }

          $("#modal_edit").modal("show");
        },

        addSave: function(event){
          event.preventDefault();
          // alert($image.cropper('getCroppedCanvas').toDataURL("image/png"));
          // console.log(this.dataTable.single_data);
          // this.btn_save_disabled = true;
          this.dataSave = this.dataTable.single_data;

          // console.log(this.dataTable.single_data);

          if(_.some(this.dataTable.single_data, _.isEmpty)){
            $.alert("Tidak Boleh Ada Data Yang Kosong");
            this.btn_save_disabled = false; return;
          }else if(this.dataTable.single_data.type_popup == 'image' && $('#uploader').val() == ""){
            $.alert("Popup Type Image Wajib Memiliki Gambar..");
            this.btn_save_disabled = false; return;
          }

          var cropResult = $image.cropper('getCroppedCanvas').toDataURL("image/png");

          axios.post(baseUrl + '/pop_up/save', {data: this.dataSave, imgPath: cropResult })
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

          axios.post(baseUrl + '/master_sub_kategori/update', this.dataSave)
          .then((response) => {
            // console.log(response.data.content);
            if(response.data.status == "berhasil"){
              this.btn_update_disabled = false;
              this.dataTable.data[_.findIndex(this.dataTable.data, function(o) { return o.id == response.data.content.id; })].name = response.data.content.name;
              this.dataTable.data[_.findIndex(this.dataTable.data, function(o) { return o.id == response.data.content.id; })].parrent_name = response.data.content.parrent_name;
              $.toast({
                  heading: 'Perubahan Berhasil',
                  text: 'Data '+this.contentHeader+' Berhasil Diubah.',
                  position: 'top-right',
                  stack: false
              })
            }else if(response.data.status == "invalid parrent"){
            	$.toast({
				    heading: 'Perubahan Gagal',
				    text: 'Kami Tidak Bisa Menemukan Category Bernama '+response.data.content+'. Category Tersebut Mungkin Sudah Dihapus Oleh User Lain, Harap Segera Memuat Ulang Inputan \'Sub Kategori Dari\' Dan Memperbarui Data Anda.',
				    icon: 'error',
                  	position: 'top-right',
                  	hideAfter: false,
                  	stack: false
				})
            }else if(response.data.status == "invalid data"){
            	$.toast({
				    heading: 'Perubahan Gagal',
				    text: 'Data Yang Ingin Anda Ubah Tidak Bisa Kami Temukan Di Database. Mungkin Data Tersebut Sudah Dihapus Oleh User Lain. Silahkan Muat Ulang Halaman Ini Agar Anda Mendapatkan Data '+this.contentHeader+' Terupdate.',
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
              title: 'Hapus Kategori?',
              content: dta + ' Data '+this.contentHeader+' Akan Dihapus, Apakah Anda Yakin ?.',
              autoClose: 'Tidak|5000',
              buttons: {
                  deleteUser: {
                      text: 'Ya',
                      action: function () {
                          axios.post(baseUrl + '/master_sub_kategori/delete', that.selectedData)
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
        }
      }
    })

  </script>
@endsection