@extends("admin.app")

@section("title", " Master Slider")


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

    .content{
      font-size: 8pt;
      box-shadow: 0px 0px 10px #ccc;
    }

    .content .slider-content{
      padding: 40px 0px;
      text-align: center;
      background: white;
      font-weight: bold;
      color: #666;
      border: 1px solid #eee;
    }

    .content .right-content{
      background: white;
      padding: 5px 5px;
    }

    .content .right-content .ctn{
      padding: 40px 10px;
      background: rgba(0,0,0,0.15);
      text-align: center;
      color: #666;
      font-weight: bold;
    }

    .content .right-content .ctn:not(:first-child){
      margin-top: 20px;
    }

    .content .bottom-content{
      padding: 5px 5px;
      background: white;
    }

    .content .bottom-content .ctn{
      border: 3px solid #fff;
      color: #666;
      padding: 25px 5px;
      font-weight: bold;
      text-align: center;
      background: rgba(0,0,0,0.1);
    }

    .content .bottom-content .ctn:not(:first-child){
      margin-left: 0px;
    }

    .content .bottom-content-right{
      background: white;
      padding: 8px 5px;
    }

    .content .bottom-content-right .ctn{
      background: rgba(0,0,0,0.15);
      padding: 25px 10px;
      text-align: center;
      font-weight: bold;
      color: #666;
    }

    span.link{
      cursor: pointer;
    }

    span.link:hover{
      color: blue;
    }

    button:disabled,
    button[disabled]{
      cursor: no-drop;
    }

    .modal-lg{
      width: 60% !important;
    }

  </style>


  <link href="{{asset('js/plugins/cropper/dist/cropper.min.css')}}" rel="stylesheet">

@endsection


@section("content")
  
  <div class="content-wrapper" id="vue-content">
  
    <div class="col-md-12 col-sm-12 col-xs-12">
      <nav aria-label="breadcrumb" role="navigation">
        <div class="row">
          <div class="col-12">
            <ol class="breadcrumb breadcrumb-custom">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Data Master Slider</a></li>
              <li class="breadcrumb-item active" aria-current="page"><span>Master Slider</span></li>
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

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="card-body">

          {{-- <div class="row">
            <div class="col-12" style="border-bottom: 1px solid #eee; margin-bottom: 20px;">
                <div class="row">
                  <div class="col-md-6">
                    <h4 class="card-title">Data @{{ contentHeader }}</h4>
                  </div>
                </div>
            </div>
          </div> --}}

          <div class="row">
            <div class="col-12">
              <div class="col-md-9 offset-1" style="background: red;">
                <div class="row content">
                  <div class="col-md-9 slider-content">
                    <span @click="changeState(1)" class="link" :style="(state == 1) ? 'color: blue': ''" v-html="(state == 1) ? 'Anda Sedang Mengelola Konten Ini' : 'Klik Untuk Mengelola Slider'"></span>
                  </div>

                  <div class="col-md-3 right-content">
                    <div class="col-md-12 ctn">
                      <span @click="changeState(2)" class="link" :style="(state == 2) ? 'color: blue': ''" v-html="(state == 2) ? 'Anda Sedang Mengelola Konten Ini' : 'Klik Untuk Mengelola Konten Ini'"></span>
                    </div>

                    <div class="col-md-12 ctn">
                      <span @click="changeState(3)" class="link" :style="(state == 3) ? 'color: blue': ''" v-html="(state == 3) ? 'Anda Sedang Mengelola Konten Ini' : 'Klik Untuk Mengelola Konten Ini'"></span>
                    </div>
                  </div>

                  <div class="col-md-9">
                    <div class="row bottom-content">
                      <div class="col-md-3 ctn">
                        <span @click="changeState(4)" class="link" :style="(state == 4) ? 'color: blue': ''" v-html="(state == 4) ? 'Anda Sedang Mengelola Konten Ini' : 'Klik Untuk Mengelola Konten Ini'"></span>
                      </div>

                      <div class="col-md-3 ctn">
                        <span @click="changeState(5)" class="link" :style="(state == 5) ? 'color: blue': ''" v-html="(state == 5) ? 'Anda Sedang Mengelola Konten Ini' : 'Klik Untuk Mengelola Konten Ini'"></span>
                      </div>
                      <div class="col-md-3 ctn">
                        <span @click="changeState(6)" class="link" :style="(state == 6) ? 'color: blue': ''" v-html="(state == 6) ? 'Anda Sedang Mengelola Konten Ini' : 'Klik Untuk Mengelola Konten Ini'"></span>
                      </div>
                      <div class="col-md-3 ctn">
                        <span @click="changeState(7)" class="link" :style="(state == 7) ? 'color: blue': ''" v-html="(state == 7) ? 'Anda Sedang Mengelola Konten Ini' : 'Klik Untuk Mengelola Konten Ini'"></span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3 bottom-content-right">
                      <div class="col-md-12 ctn">
                        <span @click="changeState(8)" class="link" :style="(state == 8) ? 'color: blue': ''" v-html="(state == 8) ? 'Anda Sedang Mengelola Konten Ini' : 'Klik Untuk Mengelola Konten Ini'"></span>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-12" style="border-bottom: 1px solid #eee; margin-bottom: 20px;">
                <div class="row">
                  <div class="col-md-6">
                    <h4 class="card-title" v-if="contentHeader == ''">Kelola Slider Atau Gambar Yang Ada Di Halaman Utama</h4>
                    <h4 class="card-title" v-if="contentHeader != ''">@{{ contentHeader }}</h4>
                  </div>

                  <div class="col-md-6 text-right">
                    <i class="fa fa-plus" style="font-size: 14pt; color: #0099CC; cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Tambah Gambar Pada Konten Ini" @click="showAdd()" v-if="state != 0"></i>
                  </div>
                </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="col-md-12">
                <div class="row">
                  <small class="text-muted" v-if="state == 0" style="margin: 0 auto;">
                    <center>Pilih Salah Konten Diatas Terlebih Dahulu</center>
                  </small>

                  <small class="text-muted" v-if="state != 0 && ajax_on_load" style="margin: 0 auto;">
                    <center><i class="fa fa-circle-o-notch fa-spin fa-fw"></i> &nbsp;Sedang Mengambil Data</center>
                  </small>

                  <small class="text-muted" v-if="state != 0 && !ajax_on_load && pictures.length == 0" style="margin: 0 auto;">
                    <center><i class="fa fa-frown-o"></i> &nbsp;Tidak Menemukan Data Satupun...</center>
                  </small>

                  <div class="col-md-12" style="padding: 0px;" v-if="state != 0 && !ajax_on_load && pictures.length > 0">
                    <div class="row">

                      <div class="col-md-2" v-for="picture in pictures">
                        <div class="col-md-12" style="border: 2px solid #aaa; border-radius: 8px; cursor: pointer;" @click="showUpdate(picture.picture_id)">
                          <div class="row">
                            <div class="col-md-12" style="padding: 0px;">
                              <img :src="picture.picture_source+picture.picture_path" style="object-fit: cover; border-top-left-radius: : 8px; border-top-right-radius-radius: : 8px;" width="100%;">
                            </div>

                            <div class="col-md-12 text-center" style="padding: 10px 0px;">
                              <i class="fa fa-check" style="color: #00C851;" v-if="picture.picture_status == 1" title="Gambar Sedang Ditampilkan Di Halaman Utama"></i>
                              <i class="fa fa-minus" style="color: #ffbb33;" v-if="picture.picture_status != 1" title="Gambar Tidak Sedang Ditampilkan Di Halaman Utama"></i>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>

                  </div>
                </div>
              </div>
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
            <h5 class="modal-title" id="exampleModalLabel" style="color: #263238;">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 15px; background: white;">
            <div class="row">
              <div class="col-md-12" style="border-right: 1px solid #eee;">
                <table id="form-table" border="0">

                  <tr>
                    <td width="30%" class="title"> Judul Gambar </td>
                    <td width="65%">
                        <input type="text" class="form-control" placeholder="Masukkan Nama PopUp" v-model="single_data.judul_gambar">
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Letak Gambar </td>
                    <td width="65%">
                        <input type="text" class="form-control" readonly v-model="single_data.letak_gambar">
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="30%" class="title"> Url Link </td>
                    <td width="65%">
                        <div class="input-group">
                          {{-- <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3" style="font-size: 0.9em;">http://</span>
                          </div> --}}
                          <input type="text" class="form-control" placeholder="Masukkan Url Link" v-model="single_data.url_link">
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td colspan="4" style="padding-top: 20px;">
                        <input type="checkbox" name="status" v-model="single_data.status"> &nbsp;<span style="color: #555; font-size: 10pt;">tampilkan gambar ini di halaman utama</span>
                    </td>
                  </tr>
                </table>

                <div class="col-md-12" style="padding: 0px; margin-top: 10px;">
                  <div style="width: 38em; height: 19em; margin-left: -10px;" v-show="state == 1">
                      <img id="image_slider" src="{{asset('images/ad-default.png')}}" alt="Picture" class="img_wrap" />
                  </div>

                  <div style="width: 27em; height: 20em; margin: 0 auto;" v-show="state == 2 || state == 3">
                      <img id="image_right" src="{{asset('images/ad-default.png')}}" alt="Picture" class="img_wrap" />
                  </div>

                  <div style="width: 34em; height: 20em; margin: 0 auto;" v-show="state == 4 || state == 5 || state == 6 || state == 7">
                      <img id="image_bottom" src="{{asset('images/ad-default.png')}}" alt="Picture" class="img_wrap" />
                  </div>

                  <div style="width: 37em; height: 19em; margin-left: -3px;" v-show="state == 8">
                      <img id="image_pojok" src="{{asset('images/ad-default.png')}}" alt="Picture" class="img_wrap" />
                  </div>

                  <input type="file" id="uploader" style="margin-top: 20px;" />
                </div>

              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="store" :disabled="btn_disabled" v-if="modal_status == 'add'">Simpan</button>

            <button type="button" class="btn btn-danger" @click="remove" :disabled="btn_disabled" v-if="modal_status == 'edit'">Hapus</button>
            <button type="button" class="btn btn-primary" @click="update" :disabled="btn_disabled" v-if="modal_status == 'edit'">Perbarui Data</button>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection


@section("extra_scripts")
  
  {{-- <script src="{{ URL::asset('js/component/vue_datatables.js') }}"></script> --}}
  <script src="{{ asset('js/plugins/cropper/dist/cropper.min.js') }}"></script>

  <script>

    $(document).ready(function(){

      $image_slider = $("#image_slider").cropper({
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

      $image_right = $("#image_right").cropper({
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

      $image_bottom = $("#image_bottom").cropper({
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

      $image_pojok = $("#image_pojok").cropper({
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
          var $image = $(".img_wrap");
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
                      if (Math.round(size) > 4000) {
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
        contentHeader  : '',
        state          : 0,
        btn_disabled   : false,
        ajax_on_load   : false,
        modal_status   : 'add',

        pictures: [],

        single_data: {
          picture_id    : '',
          type_gambar   : '',
          judul_gambar  : '',
          sumber_gambar : '',
          letak_gambar  : '',
          url_link      : '',
          status        : false,
        }

      },
      mounted: function(){
        console.log("Vue Ready");
      },
      created: function(){

      },
      watch: {

      },

      computed: {
        
      },

      methods: {
          changeState: function(state){
            switch(state){
              case 1:
                this.state = state;
                this.getData(state);
                this.contentHeader = "Sedang Mengelola Gambar Slider";
                this.single_data.letak_gambar = "Bagian Slider";
                break;

              case 2:
                this.state = state;
                this.getData(state);
                this.contentHeader = "Sedang Mengelola Gambar di Bagian Kanan Pertama";
                this.single_data.letak_gambar = "Bagian kanan Pertama";
                break;

              case 3:
                this.state = state;
                this.getData(state);
                this.contentHeader = "Sedang Mengelola Gambar di Bagian Kanan Kedua";
                this.single_data.letak_gambar = "Bagian kanan Kedua";
                break;

              case 4:
                this.state = state;
                this.getData(state);
                this.contentHeader = "Sedang Mengelola Gambar di Bagian Bawah Pertama";
                this.single_data.letak_gambar = "Bagian Bawah Pertama";
                break;

              case 5:
                this.state = state;
                this.getData(state);
                this.contentHeader = "Sedang Mengelola Gambar di Bagian Bawah Kedua";
                this.single_data.letak_gambar = "Bagian Bawah Kedua";
                break;

              case 6:
                this.state = state;
                this.getData(state);
                this.contentHeader = "Sedang Mengelola Gambar di Bagian Bawah Ketiga";
                this.single_data.letak_gambar = "Bagian Bawah Ketiga";
                break;

              case 7:
                this.state = state;
                this.getData(state);
                this.contentHeader = "Sedang Mengelola Gambar di Bagian Bawah Keempat";
                this.single_data.letak_gambar = "Bagian Bawah Keempat";
                break;

              case 8:
                this.state = state;
                this.getData(state);
                this.contentHeader = "Sedang Mengelola Gambar di Bagian Pojok Bawah";
                this.single_data.letak_gambar = "Bagian Pojok Bawah";
                break;
            }

            this.resetForm();
          },

          getData: function(state){
            this.ajax_on_load = true;
            axios.get(baseUrl+'/slider/get?state='+state)
                    .then((response) => {
                      console.log(response.data);

                      this.pictures = response.data;
                      this.ajax_on_load = false;
                      $("html, body").animate({ scrollTop: 500 }, 500);
                    })
                    .catch((err) => {
                      alert(err);
                    })
          },

          showAdd: function(state){
            $('#modal_tambah').modal('show');
            this.modal_status = 'add';
          },

          showUpdate: function(id){
            var idx = this.pictures.findIndex(a => a.picture_id === id);

            this.single_data.picture_id    = this.pictures[idx].picture_id;
            this.single_data.type_gambar   = this.pictures[idx].picture_type;
            this.single_data.judul_gambar  = this.pictures[idx].picture_title;
            this.single_data.sumber_gambar = this.pictures[idx].picture_source;
            this.single_data.url_link      = this.pictures[idx].picture_url;
            this.single_data.status        = (this.pictures[idx].picture_status == 1) ? true : false;

            if(this.state == 1){
              $image_slider.cropper("reset", true).cropper("replace", this.pictures[idx].picture_source+this.pictures[idx].picture_path);
            }else if(this.state == 2 || this.state == 3){
              $image_right.cropper("reset", true).cropper("replace", this.pictures[idx].picture_source+this.pictures[idx].picture_path);
            }else if(this.state == 4 || this.state == 5 || this.state == 6 || this.state == 7){
              $image_bottom.cropper("reset", true).cropper("replace", this.pictures[idx].picture_source+this.pictures[idx].picture_path);
            }else if(this.state == 8){
              $image_pojok.cropper("reset", true).cropper("replace", this.pictures[idx].picture_source+this.pictures[idx].picture_path);
            }

            $('#modal_tambah').modal('show');
            this.modal_status = 'edit';
          },

          store: function(){
            this.btn_disabled = true;
            if(this.single_data.judul_gambar == ''){
              $.alert("Tidak Boleh Ada Data Yang Kosong");
              this.btn_disabled = false; return;
            }

            var cropResult = '';

            if(this.state == 1){
              cropResult = $image_slider.cropper('getCroppedCanvas').toDataURL("image/png");
            }else if(this.state == 2 || this.state == 3){
              cropResult = $image_right.cropper('getCroppedCanvas').toDataURL("image/png");
            }else if(this.state == 4 || this.state == 5 || this.state == 6 || this.state == 7){
              cropResult = $image_bottom.cropper('getCroppedCanvas').toDataURL("image/png");
            }else if(this.state == 8){
              cropResult = $image_pojok.cropper('getCroppedCanvas').toDataURL("image/png");
            }

            axios.post(baseUrl+'/slider/store', {data: this.single_data, img: cropResult, state: this.state })
                    .then((response) => {
                      if(response.data.status == 'sukses'){
                        $.toast({
                            heading: 'Penambahan Berhasil',
                            text: 'Data Gambar Baru Berhasil Ditambahkan.',
                            position: 'top-right',
                            stack: false
                        })

                        this.pictures = response.data.content;
                        this.resetForm();
                      }else{
                        $.toast({
                            heading: 'Penambahan Gagal',
                            text: 'Data Gambar Baru Tidak Berhasil Ditambahkan.',
                            position: 'top-right',
                            icon: 'error',
                            hideAfter: false,
                            stack: false
                        })
                      }

                      this.btn_disabled = false;

                    }).catch((err) => {
                      alert(err);
                    }).then(() => {
                      this.btn_disabled = false;
                    })
          },

          update: function(){
            this.btn_disabled = true;
            if(this.single_data.judul_gambar == ''){
              $.alert("Tidak Boleh Ada Data Yang Kosong");
              this.btn_disabled = false; return;
            }

            var cropResult = '';

            if(this.state == 1){
              cropResult = $image_slider.cropper('getCroppedCanvas').toDataURL("image/png");
            }else if(this.state == 2 || this.state == 3){
              cropResult = $image_right.cropper('getCroppedCanvas').toDataURL("image/png");
            }else if(this.state == 4 || this.state == 5 || this.state == 6 || this.state == 7){
              cropResult = $image_bottom.cropper('getCroppedCanvas').toDataURL("image/png");
            }else if(this.state == 8){
              cropResult = $image_pojok.cropper('getCroppedCanvas').toDataURL("image/png");
            }

            axios.post(baseUrl+'/slider/update', {data: this.single_data, img: cropResult, state: this.state })
                    .then((response) => {
                      // console.log(response.data);
                      if(response.data.status == 'sukses'){
                        $.toast({
                            heading: 'Update Berhasil',
                            text: 'Data Gambar Yang Dipilih Berhasil Diupdate.',
                            position: 'top-right',
                            stack: false
                        });

                        this.pictures = response.data.content;
                        // this.resetForm();
                      }else if(response.data.status == 'gagal'){
                        $.toast({
                            heading: 'Update Gagal',
                            text: response.data.content,
                            position: 'top-right',
                            stack: false
                        })
                      }else{
                        $.toast({
                            heading: 'Update Gagal',
                            text: 'Data Gambar Yang Dipilih Tidak Berhasil Ditambahkan.',
                            position: 'top-right',
                            icon: 'error',
                            hideAfter: false,
                            stack: false
                        })
                      }

                      this.btn_disabled = false;

                    }).catch((err) => {
                      alert(err);
                    }).then(() => {
                      this.btn_disabled = false;
                    })
          },

          remove: function(){
            var cfrm = confirm('Apakah Anda Yakin ?');

            if(cfrm){
              this.btn_disabled = true;

              axios.post(baseUrl+'/slider/delete', {data: this.single_data.picture_id, state: this.state})
                    .then((response) => {
                      console.log(response.data);
                      if(response.data.status == 'sukses'){
                        $.toast({
                            heading: 'Berhasil',
                            text: 'Data Gambar Yang Dipilih Berhasil Dihapus.',
                            position: 'top-right',
                            stack: false
                        });

                        this.pictures = response.data.content;
                        this.resetForm();
                      }else if(response.data.status == 'gagal'){
                        $.toast({
                            heading: 'Hapus Gagal',
                            text: response.data.content,
                            position: 'top-right',
                            stack: false
                        })
                      }else{
                        $.toast({
                            heading: 'Gagal',
                            text: 'Data Gambar Yang Dipilih Tidak Berhasil Dihapus.',
                            position: 'top-right',
                            icon: 'error',
                            hideAfter: false,
                            stack: false
                        })
                      }

                      this.btn_disabled = false;

                    }).catch((err) => {
                      alert(err);
                    }).then(() => {
                      this.btn_disabled = false;
                    })
            }
          },

          resetForm: function(){
            this.single_data.judul_gambar = '';
            this.single_data.url_link  = '';
            this.single_data.status = false;
            $image_slider.cropper("reset", true).cropper("replace", '{{asset('images/ad-default.png')}}');
            $image_right.cropper("reset", true).cropper("replace", '{{asset('images/ad-default.png')}}');
            $image_bottom.cropper("reset", true).cropper("replace", '{{asset('images/ad-default.png')}}');
            $image_pojok.cropper("reset", true).cropper("replace", '{{asset('images/ad-default.png')}}');
            $('#uploader').val("");
          }
      }
    })

  </script>
@endsection