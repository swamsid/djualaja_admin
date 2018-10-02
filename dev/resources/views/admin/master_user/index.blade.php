@extends("admin.app")

@section("title", " Master Pengiklan")


@section("extra_styles")
  
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

    .modal-lg{
      width: 60%; ! important
    }

    button:disabled,
    button[disabled]{
      cursor: no-drop;
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
                <li class="hovered" @click="edit"><a href="#"><i class="fa fa-pencil"></i> &nbsp;Lihat Profil lengkap</a></li>
                {{-- <li class="hovered" @click="hapus"><a href="#"><i class="fa fa-eraser"></i> &nbsp;Hapus Data</a></li> --}}

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
    <div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document" style="margin-top: 20px;">
        <div class="modal-content" style="border-radius: 1px; font-size: 0.8em;">
          <div class="modal-header" style="padding: 15px;">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #263238;">Informasi @{{ contentHeader }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body" style="padding: 15px; background: white;">
            <div class="col-md-12 text-center text-muted" v-if="dataTable.single_data.length == 0">
              <small><i class="fa fa-frown-o"></i> &nbsp;Tidak Bisa Menemukan Data Pengiklan Ini..</small>
            </div>

            <div class="row" v-if="dataTable.single_data.length != 0">

              <div class="col-md-7" style="background: none; border-right: 1px solid #ccc;">
                <div class="row">
                  <div class="col-md-6" style="background: none;">
                    <img width="100%" class="img-responsive" :src="image" :alt="'First slide'" style="margin-top: 20px;">
                  </div>

                  <div class="col-md-6" style="padding: 0px; padding-right: 10px; padding-top: 5px;">
                    <table id="my-table" width="100%" border="0" style="font-size: 0.9em; border-color: #ccc;" >

                      <tr>
                        <td width="35%">Nama  </td>
                        <td class="answer">@{{ dataTable.single_data.name }}</td>
                      </tr>

                      <tr>
                        <td>Email  </td>
                        <td class="answer">@{{ dataTable.single_data.email }}</td>
                      </tr>

                      <tr>
                        <td>No.Telpn  </td>
                        <td class="answer">@{{ dataTable.single_data.phone }}</td>
                      </tr>

                      <tr>
                        <td>facebook  </td>
                        <td class="answer">@{{ dataTable.single_data.facebook }}</td>
                      </tr>

                      <tr>
                        <td>Instagram  </td>
                        <td class="answer">@{{ dataTable.single_data.instagram }}</td>
                      </tr>

                      <tr>
                        <td>Total Iklan  </td>
                        <td class="answer">
                          @{{ dataTable.single_data.iklan }} Iklan Aktif
                        </td>
                      </tr>

                      <tr>
                        <td>Status  </td>
                        <td class="answer">
                          <span class='badge badge-info' v-if='dataTable.single_data.confirmed == 1'>Verified</span>
                          <span class='badge badge-danger' v-if='dataTable.single_data.confirmed != 1'>Unverified</span>
                        </td>
                      </tr>

                    </table>
                  </div>

                </div>

                <div class="row" style="padding: 0px 10px;">
                  <div class="col-md-12" style="background: none; padding: 10px 15px; border-bottom: 1px solid #ccc; border-top: 1px solid #ccc; margin-top: 15px; font-weight: 600;">
                    Info Lokasi
                  </div>

                  <div class="col-md-12" style="background: none; padding: 10px 15px; border-bottom: 1px solid #ccc; margin-top: 0px;">

                    <table id="my-table" width="100%" border="0" style="font-size: 0.9em; border-color: #ccc;" >

                      <tr>
                        <td width="35%">Alamat  </td>
                        <td class="answer">@{{ dataTable.single_data.address }}</td>
                      </tr>

                      <tr>
                        <td>Kota  </td>
                        <td class="answer">@{{ dataTable.single_data.kota }}</td>
                      </tr>

                      <tr>
                        <td>Longitude  </td>
                        <td class="answer" v-html="(dataTable.single_data.longtitude == '') ? 'Tidak Diisi' : dataTable.single_data.longtitude"></td>
                      </tr>

                      <tr>
                        <td>Latitude  </td>
                        <td class="answer" v-html="(dataTable.single_data.latitude == '') ? 'Tidak Diisi' : dataTable.single_data.latitude"></td>
                      </tr>
                    </table>

                  </div>
                </div>

              </div>

              <div class="col-md-5">
                <div class="col-md-12" style="padding: 0px;">
                  <table width="100%" border="0">
                    <tr>
                      <td style="font-weight: 0.9em;">Pengiklan Ini Sedang</td>
                      <td>
                        <select class="form-control" v-model="sts">
                          <option value="null">aktif</option>
                          <option value="inactive">inactive</option>
                        </select>
                      </td>
                    </tr>

                    <tr>
                      <td style="font-weight: 0.9em; padding-top: 15px;" width="30%" colspan="2">
                        <textarea class="form-control" placeholder="Berikan Alasan Kenapa Anda Merubah Status Ini" style="height: 80px; resize: none;" id="explain"></textarea>
                      </td>
                    </tr>
                  </table>
                </div>

              </div>

            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-primary" :disabled="btn_save_disabled" @click="editSave">Proses</button>
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
            
            <div class="row" v-show="selectedData.length != 0">

              <div class="col-md-7" style="border-right: 1px solid #eee;">
                <div class="col-md-12" style="padding: 10px 10px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; margin-top: 0px;">
                    Form Keterangan Kategori
                </div>

                <table id="form-table" border="0">
                  <tr>
                    <td width="30%" class="title"> Data Yang Diedit </td>
                    <td colspan="2">
                        <select class="form-control" style="width: 70%" v-model="changeState">
                          <option v-for="dat in list_selected" :value="dat.id">@{{ dat.name }}</option>
                        </select>
                    </td>
                  </tr>

                  <tr>
                    <td width="25%" class="title"> Perkiraan Nomor </td>
                    <td colspan="2">
                        <input type="text" class="form-control" placeholder="Perkiraan Nomor" readonly style="width: 70%" v-model="dataTable.single_data.category_id">
                    </td>
                  </tr>

                  <tr>
                    <td width="25%" class="title"> Nama Kategori </td>
                    <td width="60%">
                        <input type="text" class="form-control" id="kategori_name" placeholder="Input Category Name" style="width: 100%" v-model="dataTable.single_data.name">
                    </td>
                    <td></td>
                  </tr>

                  <tr>
                    <td width="25%" class="title"> Ikon Kategori </td>
                    <td>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <button class="btn btn-outline-secondary" type="button" style="font-size:0.9em; padding: 5px 10px 5px 15px;" @click="getIcon">
                            <i class="fa fa-search"></i> fa-
                          </button>
                        </div>
                        <input type="text" class="form-control" placeholder="Input Category Icon" style="height: 2.8em" v-model="dataTable.single_data.icon">
                      </div>
                    </td>
                    <td>
                      <i :class="'fa fa-'+dataTable.single_data.icon"></i>
                    </td>
                  </tr>
                </table>
              </div>

              <div class="col-md-5">
                <div class="col-md-12" style="padding: 10px 10px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; margin-top: 0px;">
                    Inputan Tambahan
                    <i class="fa fa-plus pull-right text-success" style="margin-top: 4px; cursor: pointer;" @click="create_addForm"></i>
                </div>

                <div class="col-md-12" style="margin-top: 10px; padding: 5px 13px;">
                  <div class="col-md-12" v-if="dataTable.dataAddForm.length == 0">
                    <center><small class="text-muted"><i class="fa fa-frown-o"></i> &nbsp;Tidak Bisa Menemukan Inputan Tambahan Apapun..</small></center>
                  </div>
                  <div class="row" v-for="(formAdd, idx) in dataTable.dataAddForm">
                    <div class="col-md-10">
                      <input type="text" class="form-control" :placeholder="'Masukkan Nama Inputan ke '+(idx+1)" v-model="formAdd.nama" style="margin-bottom: 5px;">
                    </div>

                    <div class="col-md-1" style="padding-top: 7px;">
                      <i class="fa fa-eraser text-danger" style="cursor: pointer;" @click="delete_addForm(idx)"></i>
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

  </div>

@endsection


@section("extra_scripts")
  
  <script src="{{ URL::asset('js/component/vue_datatables.js') }}"></script>

  <script>
      
    function createFakeData(){
      let data = [];
      for(let i = 0; i < 50; i++){
        data.push({id: 'CT-00'+i,
                   category_id: 'CT-00'+i,
                   name:'Doe',
                   level:'aa' ,
                   parrent:'null',
                   icon:'#' + i,
                   aa: 'aaa'});
      }
      return data;
    }

    var app = new Vue({
      el: '#vue-content',
      data: {
        btn_save_disabled   : false,
        btn_update_disabled : false,
        elapsedTime         : 0,
        contentHeader       : 'Pengiklan',
        dataSave            : [],
        selectedData        : [],
        changeState          : '',
        sts : 'banned',

        dataTable: {
          columns: [
            { text: "Nama Pengiklan", searchable: true, index: "name", width:"15%", override: false},
            { text: "Tanggal Gabung", searchable: true, index: "created_at", width:"20%", override: false },
            { text: "Kota/Kabupaten", searchable: true, index: "kota", width:"10%", override: false },
            { text: "Jumlan Iklan", searchable: true, index: "iklan", width:"12%", override: function(e){
              return e+' Iklan Aktif';
            } },
            { text: "status", searchable: true, index: "confirmed", width:"10%", override: function(e){ return (e == 1) ? "<span class='badge badge-info' style='width:70px;'>Verified</span>" : "<span class='badge badge-danger' style='width:70px;'>Unverified</span>" } },

           /* semua object yang ada di column dibutuhkan sehingga tidak boleh ada satupun object yang tertinggal. 
            
                  object :
                      - text        -> hanya boleh String (text, searchable, index, width, override)
                      - searchable  -> hanya boleh Boolean true/false
                      - index       -> hanya boleh String (sesuai object di dalam array data)
                      - width       -> hanya boleh String (harus satuan ukuran px atau %)
                      - override    -> hanya boleh function / Boolean false (jika tidak menggunakan function)

            */ // Semua Harus Wajib Diisi.
            
          ],

          button_helper: ['V'],
          data: [],
          single_data: [],
          dataAddForm: [],
          deletedElementChild: [],

          size: 10,
        }

      },
      mounted: function(){
        console.log("Vue Ready");
        // $("#modal_view").modal("show");
        if('{{ $override }}' == "create"){
          this.add();
        }
      },
      created: function(){
        var start_time = new Date().getTime();

        axios.get(baseUrl + "/master_user/list")
              .then((response) => {
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
            this.dataTable.single_data = this.dataTable.data[idx];
            this.sts = (this.dataTable.single_data.status == null) ? 'null' : this.dataTable.single_data.status;
          }

          // console.log(this.dataTable.single_data);
        },

        sts: function(e){
          
        }
      },

      computed: {
        list_selected: function(){
          var data_selected = []; that = this;
          _.forEach(that.selectedData, function(value){
            data_selected.push(that.dataTable.data[_.findIndex(that.dataTable.data, function(o) { return o.id == value })]);
          })

          return data_selected ;
        },

        image: function(){
          var img = this.dataTable.single_data.photo;
          var path; 

          if(img == 'null'){
            path = Pof+'/images/users/user-default.jpg';
          }else{
            path = Pof+'/images/users/upload/'+this.dataTable.single_data.id+'/profile.png';
          }

          return path;
        }
      },

      methods: {
        edit: function(event){
          // event.preventDefault();

          if(this.selectedData != 0){
            var state = this.changeState;
            var idx = _.findIndex(this.dataTable.data, function(o){ return o.id == state });
            this.dataTable.single_data = this.dataTable.data[idx];            
            this.sts = (this.dataTable.single_data.status == null) ? 'null' : this.dataTable.single_data.status;
          }else{
            this.dataTable.single_data = [];
          }

          $("#modal_view").modal("show");
          $('#explain').val("");
          // console.log(this.dataTable.single_data);
        },

        editSave: function(event){
          event.preventDefault();
          this.btn_save_disabled = true;
          this.dataSave = this.dataTable.single_data;

          // console.log(this.category.id);

          if($("#explain").val() == ''){
            $.alert("Anda Harus Mengisi Alasan Terlebih Dahulu");
            this.btn_save_disabled = false; return;
          }

          that = this;

          $.confirm({
              title: 'Pesan Sistem',
              content: 'Apakah Anda Sudah Yakin ??.',
              buttons: {
                  deleteUser: {
                      text: 'Ya',
                      action: function () {
                          axios.post(baseUrl + '/master_user/update', {sts: that.sts, explain: $("#explain").val(), id: that.dataTable.single_data.id})
                                .then((response) => {
                                  console.log(response.data);
                                  if(response.data.status == "berhasil"){
                                    that.btn_save_disabled = false;
                                    var idx = _.findIndex(that.dataTable.data, function(o){ return o.id == that.dataTable.single_data.id });
                                    that.dataTable.data[idx].status = response.data.content;
                                    that.dataTable.single_data.status = response.data.content;

                                    $.toast({
                                        heading: 'Perubahan Berhasil',
                                        text: 'Data '+that.contentHeader+' Berhasil Diubah.',
                                        position: 'top-right',
                                        stack: false
                                    })
                                  }
                                  else{
                                    console.log("localServer Error;")
                                  }
                                }).catch((error) => {
                                  alert(error);
                                  that.btn_save_disabled = false;
                                })
                      }
                  },
                  Tidak: function () {
                      $.alert('Aksi Dibatalkan.');
                      that.btn_save_disabled = false;
                  }
              }
          });

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
                          axios.post(baseUrl + '/master_kategori/delete', that.selectedData)
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

        create_addForm: function(){
          this.dataTable.dataAddForm.push({id: "null", nama: ""})
        },

        delete_addForm: function(id){
          if(this.dataTable.dataAddForm[id].id !== "null")
            this.dataTable.deletedElementChild.push(this.dataTable.dataAddForm[id].id);

          this.dataTable.dataAddForm.splice(id, 1);
        },

        selectedUnit: function(a){
          this.selectedData = a;
          // console.log(a);
          this.changeState = _.first(this.selectedData);
        },

        getIcon: function(event){
          event.preventDefault();
          window.open("https://fontawesome.com/v4.7.0/icons/")
        },

        view_one: function(id){
          var state = id;
          var idx = _.findIndex(this.dataTable.data, function(o){ return o.id == state });
          this.dataTable.single_data = this.dataTable.data[idx];            
          this.sts = (this.dataTable.single_data.status == null) ? 'null' : this.dataTable.single_data.status;

          // console.log(this.selectedData);

          $("#modal_view").modal("show");
          $('#explain').val("");
        },
        edit_one: function(id){
          console.log('standBy');
        },
        delete_one: function(id){
          console.log('standBy');
        }
      }
    })

  </script>
@endsection