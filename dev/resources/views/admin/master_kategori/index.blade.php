@extends("admin.app")

@section("title", " Master Kategori")


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
            <div class="row">

              <div class="col-md-7" style="border-right: 1px solid #eee;">
                <div class="col-md-12" style="padding: 10px 10px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; margin-top: 0px;">
                    Form Keterangan Kategori
                </div>

                <table id="form-table" border="0">
                  <tr>
                    <td width="30%" class="title"> Perkiraan Nomor </td>
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
                        <input type="text" class="form-control" placeholder="Input dataTable.single_data Icon" style="height: 2.8em" v-model="dataTable.single_data.icon">
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
            
            <div class="row">

              <div class="col-md-7" style="border-right: 1px solid #eee;">
                <div class="col-md-12" style="padding: 10px 10px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; margin-top: 0px;">
                    Form Keterangan Kategori
                </div>

                <table id="form-table" border="0">
                  <tr>
                    <td width="30%" class="title"> Perkiraan Nomor </td>
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
        contentHeader       : 'Kategori',
        dataSave            : [],
        selectedData        : [],
        changeState          : '',

        dataTable: {
          columns: [
            { text: "Nomor Kategori", searchable: true, index: "category_id", width:"15%", override: false},
            { text: "Nama Kategori", searchable: true, index: "name", width:"20%", override: false },
            { text: "Ikon Kategori", searchable: true, index: "icon", width:"10%", override: function(e){ return '<i class="fa fa-'+e+'"></i>' } },
            { text: "Form Tambahan", searchable: true, index: "count", width:"10%", override: function(e){ return e+" <small>Form</small>" } },

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
            category_id: '',
            name: '',
            icon: '',
          },

          dataAddForm: [],
          deletedElementChild: [],

          size: 10,
        }

      },
      mounted: function(){
        console.log("Vue Ready");
        // $("#modal_tambah").modal("show");
        if('{{ $override }}' == "create"){
          this.add();
        }
      },
      created: function(){
        var start_time = new Date().getTime();

        axios.get(baseUrl + "/master_kategori/list")
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
            this.dataTable.single_data.category_id = this.dataTable.data[idx].category_id;
            this.dataTable.single_data.name = this.dataTable.data[idx].name;
            this.dataTable.single_data.icon = this.dataTable.data[idx].icon;
            this.dataTable.dataAddForm = [];

            axios.post(baseUrl + "/master_kategori/get_form_add", {id: this.dataTable.data[idx].category_id})
              .then((response) => {
                // console.log(response.data)

                this.dataTable.dataAddForm = response.data

              }).catch((error) => {
                console.log(error)
              })
          }

          // console.log(this.dataTable.single_data);
        }
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
        add: function(){
          this.dataTable.single_data.category_id = (this.dataTable.data.length !== 0) ? 'CT-{{ date("ynj/iH") }}/' + (parseInt(_.first(this.dataTable.data).category_id.split('/')[2]) + 1) : 'CT-{{ date("ynj/iH") }}/1';
          this.dataTable.single_data.name= "";
          this.dataTable.single_data.icon= "";
          this.dataTable.dataAddForm = [];

          $("#modal_tambah").modal("show");
        },

        edit: function(event){
          event.preventDefault();

          if(this.selectedData != 0){
            var state = this.changeState;
            var idx = _.findIndex(this.dataTable.data, function(o){ return o.id == state });
            this.dataTable.single_data.category_id = this.dataTable.data[idx].category_id;
            this.dataTable.single_data.name = this.dataTable.data[idx].name;
            this.dataTable.single_data.icon = this.dataTable.data[idx].icon;
            this.dataTable.dataAddForm = [];

            axios.post(baseUrl + "/master_kategori/get_form_add", {id: this.dataTable.data[idx].category_id})
              .then((response) => {
                // console.log(response.data)

                this.dataTable.dataAddForm = response.data

              }).catch((error) => {
                console.log(error)
              })
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

          var state = true;

          _.forEach(this.dataTable.dataAddForm, function(value){
            if(value.nama == ""){
              state = false;
              return
            }
          })

          if(!state){
            $.alert("Nama Inputan Tambahan Tidak Boleh Ada Yang Kosong");
            this.btn_save_disabled = false; return;
          }

          axios.post(baseUrl + '/master_kategori/save', {data: this.dataSave, formAd: this.dataTable.dataAddForm})
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
            }else if(response.data.status == 'exist_name'){
              that.btn_save_disabled = false;
              $.toast({
                  heading: 'Penambahan gagal',
                  text: 'Sudah Ada kategori Dengan Nama '+response.data.content+'. Data Tidak Bisa Kami Simpan.',
                  position: 'top-right',
                  stack: false
              })
            }else{
              console.log("local")
            }
          }).catch((error) => {
            alert(error);
          }).then((data) => {
            this.dataTable.single_data.name = ""; this.dataTable.single_data.icon = "";
            this.dataTable.dataAddForm = [];
          })

        },

        editSave: function(event){
          event.preventDefault();
          this.btn_update_disabled = true;
          this.dataSave = this.dataTable.single_data;

          // console.log(this.category.id);

          if(_.some(this.dataTable.single_data, _.isEmpty)){
            alert("Tidak Boleh Ada Data Yang Kosong");
            this.btn_update_disabled = false; return;
          }

          var state = true;

          _.forEach(this.dataTable.dataAddForm, function(value){
            if(value.nama == ""){
              state = false;
              return
            }
          })

          if(!state){
            $.alert("Nama Inputan Tambahan Tidak Boleh Ada Yang Kosong");
            this.btn_update_disabled = false; return;
          }

          that = this;

          $.confirm({
              title: 'Pesan Sistem',
              content: 'Jika Anda Mengganti/Menghapus Inputan Tambahan Di Kategori Ini, Mungkin Akan Menyebabkan Jawaban Yang Telah Diberikan Oleh Pengguna Terhadap Inputan Tersebut Tidak Relevan. Jika Anda Memilih Lanjutkan, Maka Kami Harap Anda Paham Dengan Segala Kemungkinan Yang Akan Terjadi.',
              buttons: {
                  deleteUser: {
                      text: 'Lanjutkan',
                      action: function () {
                          axios.post(baseUrl + '/master_kategori/update', {data: that.dataSave, formAd: that.dataTable.dataAddForm, deleted: that.dataTable.deletedElementChild})
                                .then((response) => {
                                  console.log(response.data);
                                  if(response.data.status == "berhasil"){
                                    that.btn_update_disabled = false;
                                    that.dataTable.data[_.findIndex(that.dataTable.data, function(o) { return o.id == response.data.content.id; })].name = response.data.content.name;
                                    that.dataTable.data[_.findIndex(that.dataTable.data, function(o) { return o.id == response.data.content.id; })].icon = response.data.content.icon;
                                    that.dataTable.data[_.findIndex(that.dataTable.data, function(o) { return o.id == response.data.content.id; })].count = response.data.category_add_form.length;
                                    that.dataTable.dataAddForm = response.data.category_add_form;
                                    $.toast({
                                        heading: 'Perubahan Berhasil',
                                        text: 'Data '+that.contentHeader+' Berhasil Diubah.',
                                        position: 'top-right',
                                        stack: false
                                    })
                                  }else if(response.data.status == 'exist_name'){
                                    that.btn_update_disabled = false;
                                    $.toast({
                                        heading: 'Penambahan gagal',
                                        text: 'Sudah Ada kategori Dengan Nama '+response.data.content+'. Data Tidak Bisa Kami Simpan.',
                                        position: 'top-right',
                                        stack: false
                                    })
                                  }else{
                                    console.log("localServer Error;")
                                  }
                                }).catch((error) => {
                                  alert(error);
                                }).then((data) => {
                                  that.dataTable.deletedElementChild = [];
                                })
                      }
                  },
                  Tidak: function () {
                      $.alert('Kategori Tidak Jadi Diupdate.');
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

          this.changeState = _.first(this.selectedData);
        },

        getIcon: function(event){
          event.preventDefault();
          window.open("https://fontawesome.com/v4.7.0/icons/")
        },

        view_one: function(id){
          console.log('View StandBy');
        },

        edit_one: function(id){
          var state = id;
          var idx = _.findIndex(this.dataTable.data, function(o){ return o.id == state });
          this.dataTable.single_data.category_id = this.dataTable.data[idx].category_id;
          this.dataTable.single_data.name = this.dataTable.data[idx].name;
          this.dataTable.single_data.icon = this.dataTable.data[idx].icon;
          this.dataTable.dataAddForm = [];

          axios.post(baseUrl + "/master_kategori/get_form_add", {id: this.dataTable.data[idx].category_id})
                  .then((response) => {
                    // console.log(response.data)

                    this.dataTable.dataAddForm = response.data

                  }).catch((error) => {
                    console.log(error)
                  });

          $("#modal_edit_one").modal('show');
        },

        delete_one: function(id){

          that = this;

          $.confirm({
              title: 'Hapus Kategori?',
              content: 'Data Akan Dihapus, Apakah Anda Yakin ?.',
              autoClose: 'Tidak|5000',
              buttons: {
                  deleteUser: {
                      text: 'Ya',
                      action: function () {
                          axios.post(baseUrl + '/master_kategori/delete', [id])
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