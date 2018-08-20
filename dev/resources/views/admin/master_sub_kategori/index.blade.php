@extends("admin.app")

@section("title", " Master Sub Kategori")


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

    button:disabled,
    button[disabled]{
      cursor: no-drop;
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
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 1px; font-size: 0.8em;">
          <div class="modal-header" style="padding: 15px;">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #263238;">Tambah Data @{{ contentHeader }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 15px; background: white;">
            <table id="form-table" border="0">

              <tr>
                <td width="30%" class="title"> Nama Sub Kategori </td>
                <td width="65%">
                    <input type="text" class="form-control" id="kategori_name" placeholder="Input Sub Category Name" style="width: 100%" v-model="dataTable.single_data.name">
                </td>
                <td></td>
                <td></td>
              </tr>

              <tr>
                <td width="25%" class="title"> Sub Kategori Dari </td>
                <td>
                  <select class="form-control" v-model="dataTable.single_data.parrent">
                  	<option v-for="parrent in categoryParrent" :value="parrent.parrent">@{{ parrent.name }}</option>
                  </select>
                 </td>
                <td>
                  <i :class="parentRefresh" style="cursor: pointer;" @click="resetParrent"></i>
                </td>
                <td>
                  <a href="{{ url("/master_kategori?override=create") }}" target="_blank"><i class="fa fa-plus" style="cursor: pointer;"></i></a>
                </td>
              </tr>
            </table>
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
                <td width="30%" class="title"> Sub Kategori </td>
                <td width="65%">
                    <input type="text" class="form-control" id="kategori_name" placeholder="Input Sub Category Name" style="width: 100%" v-model="dataTable.single_data.name">
                </td>
                <td></td>
                <td></td>
              </tr>

              <tr>
                <td width="25%" class="title"> Kategori </td>
                <td>
                  <select class="form-control" v-model="dataTable.single_data.parrent">
                  	<option v-for="parrent in categoryParrent" :value="parrent.parrent">@{{ parrent.name }}</option>
                  </select>
                 </td>
                <td>
                  <i :class="parentRefresh" style="cursor: pointer;" @click="resetParrent"></i>
                </td>
                <td>
                  <a href="{{ url("/master_kategori?override=create") }}" target="_blank"><i class="fa fa-plus" style="cursor: pointer;"></i></a>
                </td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="editSave" :disabled="btn_update_disabled" v-if="selectedData.length != 0">Simpan Perubahan</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_edit_one" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 1px; font-size: 0.8em;">
          <div class="modal-header" style="padding: 15px;">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #263238;">Edit Data @{{ contentHeader }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 15px; background: white;">

            <table id="form-table" border="0">
              <tr>
                <td width="30%" class="title"> Sub Kategori </td>
                <td width="65%">
                    <input type="text" class="form-control" id="kategori_name" placeholder="Input Sub Category Name" style="width: 100%" v-model="dataTable.single_data.name">
                </td>
                <td></td>
                <td></td>
              </tr>

              <tr>
                <td width="25%" class="title"> Kategori </td>
                <td>
                  <select class="form-control" v-model="dataTable.single_data.parrent">
                    <option v-for="parrent in categoryParrent" :value="parrent.parrent">@{{ parrent.name }}</option>
                  </select>
                 </td>
                <td>
                  <i :class="parentRefresh" style="cursor: pointer;" @click="resetParrent"></i>
                </td>
                <td>
                  <a href="{{ url("/master_kategori?override=create") }}" target="_blank"><i class="fa fa-plus" style="cursor: pointer;"></i></a>
                </td>
              </tr>
            </table>
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
  
  <script src="{{ URL::asset('js/component/vue_datatables.js') }}"></script>

  <script>

    var app = new Vue({
      el: '#vue-content',
      data: {
        btn_save_disabled   : false,
        btn_update_disabled : false,
        elapsedTime         : 0,
        contentHeader       : 'Sub Kategori',
        parentRefresh 		: 'fa fa-refresh',
        dataSave            : [],
        selectedData        : [],
        categoryParrent 	: [],
        changeState          : '',

        dataTable: {
          columns: [
            { text: "Nomor Kategori", searchable: true, index: "category_id", width:"15%", override: false },
            { text: "Sub Kategori", searchable: true, index: "name", width:"15%", override: false },
            { text: "Kategori", searchable: true, index: "parrent_name", width:"13%", override: false },
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
          button_helper: ['D', 'E'],

          single_data: {
          	category_id : '',
            name 		: '',
            parrent 	: '',
          },

          size: 10,
        }

      },
      mounted: function(){
        console.log("Vue Ready");
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
          // alert('okee');
          this.btn_save_disabled = true;
          this.dataSave = this.dataTable.single_data;

          // console.log(this.dataTable.single_data);

          if(_.some(this.dataTable.single_data, _.isEmpty)){
            $.alert("Tidak Boleh Ada Data Yang Kosong");
            this.btn_save_disabled = false; return;
          }

          axios.post(baseUrl + '/master_sub_kategori/save', this.dataSave)
          .then((response) => {
            // console.log(response.data);
            if(response.data.status == "berhasil"){
              this.btn_save_disabled = false;
              this.dataTable.data.unshift(response.data.content);
              this.dataTable.single_data.category_id = (this.dataTable.data.length !== 0) ? 'CT-{{ date("ynj/iH") }}/' + (parseInt(_.first(this.dataTable.data).category_id.split('/')[2]) + 1) : 'CT-{{ date("ynj/iH") }}/1';
              $.toast({
                  heading: 'Penambahan Berhasil',
                  text: 'Data '+this.contentHeader+' Baru Berhasil Ditambahkan.',
                  position: 'top-right',
                  stack: false
              })
            }else if(response.data.status == 'exist_name'){
              that.btn_save_disabled = false;
              $.toast({
                  heading: 'Penambahan gagal',
                  text: 'Sudah Ada Sub kategori Dengan Nama '+response.data.content+'. Data Tidak Bisa Kami Simpan.',
                  position: 'top-right',
                  stack: false
              })
            }else if(response.data.status == "invalid parrent"){
            	$.toast({
				    heading: 'Penambahan Gagal',
				    text: 'Kami Tidak Bisa Menemukan Category Bernama '+response.data.content+'. Category Tersebut Mungkin Sudah Dihapus Oleh User Lain, Harap Segera Memuat Ulang Inputan \'Sub Kategori Dari\' Dan Memperbarui Data Anda.',
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
            this.dataTable.single_data.name = ""; this.dataTable.single_data.parrent = this.categoryParrent[0].parrent;
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
            console.log(response.data);
            if(response.data.status == "berhasil"){
              this.btn_update_disabled = false;
              this.dataTable.data[_.findIndex(this.dataTable.data, function(o) { return o.id == response.data.content.id; })].name = response.data.content.name;
              this.dataTable.data[_.findIndex(this.dataTable.data, function(o) { return o.id == response.data.content.id; })].parrent_name = response.data.content.parrent_name;
              this.dataTable.data[_.findIndex(this.dataTable.data, function(o) { return o.id == response.data.content.id; })].parrent_cat_id = response.data.content.parrent_cat_id;
              $.toast({
                  heading: 'Perubahan Berhasil',
                  text: 'Data '+this.contentHeader+' Berhasil Diubah.',
                  position: 'top-right',
                  stack: false
              })
            }else if(response.data.status == 'exist_name'){
              that.btn_update_disabled = false;
              $.toast({
                  heading: 'Penambahan gagal',
                  text: 'Sudah Ada Sub kategori Dengan Nama '+response.data.content+'. Data Tidak Bisa Kami Simpan.',
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
        },

        resetParrent: function(){
        	if(this.parentRefresh == 'fa fa-spinner fa-pulse')
        		return;
        	else
        		this.parentRefresh = 'fa fa-spinner fa-pulse';

        	axios.get(baseUrl + '/master_kategori/select_list')
        			.then((response) => {
        				if(response.data.status == "berhasil"){
                			this.categoryParrent = response.data.content;
        					this.parentRefresh = 'fa fa-refresh';
        				}
        			})
        },

        view_one: function(id){
          alert('View StandBy');
        },
        edit_one: function(id){
          var state = id;
          var idx = _.findIndex(this.dataTable.data, function(o){ return o.id == state });
          this.dataTable.single_data.category_id = this.dataTable.data[idx].category_id;
          this.dataTable.single_data.name = this.dataTable.data[idx].name;
          this.dataTable.single_data.parrent = this.dataTable.data[idx].parrent_cat_id;
          $("#modal_edit_one").modal("show");
        },
        delete_one: function(id){
          that = this;

          $.confirm({
              title: 'Hapus Kategori?',
              content: ' Data '+this.contentHeader+' Akan Dihapus, Apakah Anda Yakin ?.',
              autoClose: 'Tidak|5000',
              buttons: {
                  deleteUser: {
                      text: 'Ya',
                      action: function () {
                          axios.post(baseUrl + '/master_sub_kategori/delete', [id])
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