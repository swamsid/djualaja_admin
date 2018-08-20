@extends("admin.app")

@section("title", " Data Iklan Pending")


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

    #my-table td{
      border: 1px solid #ccc;
      border-left: 0px;
      border-right: 0px;
    }

    #my-table td.answer{
      color: #d32f2f;
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
              <li class="breadcrumb-item"><a href="#">Pengelola Iklan</a></li>
              <li class="breadcrumb-item active" aria-current="page"><span>Data @{{ contentHeader }}</span></li>
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
                {{-- <li class="hovered" @click="add"><a href="#"><i class="fa fa-plus"></i> &nbsp;Tambah Data</a></li> --}}
                <li class="hovered" @click="edit"><a href="#"><i class="fa fa-legal"></i> &nbsp;Periksa Iklan Yang Ditandai</a></li>
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
              <small><i class="fa fa-frown-o"></i> &nbsp;Tidak Bisa Menemukan Data Iklan Ini..</small>
            </div>

            <div class="row" v-if="dataTable.single_data.length != 0">

              <div class="col-md-7" style="background: none; border-right: 1px solid #ccc;">
                <div class="row">
                  <div class="col-md-7" style="background: none;">
                    
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">

                          <div v-for="(picture, idx) in dataTable.single_data[0].photos" :class="(idx == 0) ? 'carousel-item active' : 'carousel-item'">
                            <img width="100%" class="img-responsive" :src="picture.property_of+'/images/users/upload/'+dataTable.single_data[0].user_id+'/products/'+dataTable.single_data[0].product_id+'/'+picture.photo_name" :alt="'First slide'">
                          </div>

                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                    </div>

                  </div>

                  <div class="col-md-5" style="padding: 0px; padding-right: 10px; padding-top: 5px;">
                    <table id="my-table" width="100%" border="0" style="font-size: 0.9em; border-color: #ccc;" >

                      <tr>
                        <td width="35%">Nama  </td>
                        <td class="answer">@{{ dataTable.single_data[0].product_name }}</td>
                      </tr>

                      <tr>
                        <td>Kondisi  </td>
                        <td class="answer">@{{ dataTable.single_data[0].product_condition }}</td>
                      </tr>

                      <tr>
                        <td>Nego  </td>
                        <td class="answer" v-html="(dataTable.single_data[0].product_nego) ? 'Ya' : 'Tidak'"></td>
                      </tr>

                      <tr>
                        <td>Harga  </td>
                        <td class="answer">Rp.@{{ humanizePrice(dataTable.single_data[0].product_price) }},-</td>
                      </tr>

                      <tr>
                        <td>Alamat  </td>
                        <td class="answer">@{{ dataTable.single_data[0].product_location }}</td>
                      </tr>

                      <tr>
                        <td>Kota  </td>
                        <td class="answer">@{{ dataTable.single_data[0].district.regency.name }}</td>
                      </tr>


                    </table>
                  </div>

                </div>

                <div class="row" style="padding: 0px 10px;">
                  <div class="col-md-12" style="background: none; padding: 10px 15px; border-bottom: 1px solid #ccc; border-top: 1px solid #ccc; margin-top: 15px; font-weight: 600;">
                    Deskripsi Iklan
                  </div>

                  <div class="col-md-12" style="background: none; padding: 10px 15px; border-bottom: 1px solid #ccc; margin-top: 0px; font-size: 0.9em;" v-html="dataTable.single_data[0].product_description">
                  </div>
                </div>

              </div>

              <div class="col-md-5">
                <div class="col-md-12" style="padding: 0px;">
                  <table width="100%" border="0">
                    <tr>
                      <td style="font-weight: 0.9em;" width="30%">Pre-Filtered</td>
                      <td>
                        <span title="Iklan Ini Lolos Pengecekan Pertama Oleh Sistem" class="badge badge-info" v-if="dataTable.single_data[0].product_pre_filter == 'passed'">@{{ dataTable.single_data[0].product_pre_filter }}</span>
                        <span title="Iklan Ini Tidak Lolos Pengecekan Pertama Oleh Sistem" class="badge badge-danger" v-if="dataTable.single_data[0].product_pre_filter == 'fail'">@{{ dataTable.single_data[0].product_pre_filter }}</span>
                      </td>
                    </tr>

                    <tr>
                      <td style="font-weight: 0.9em;" width="30%">Status Iklan</td>
                      <td>
                        <select class="form-control" v-model="status_onUpdate">
                          <option value="pending">Pending</option>
                          <option value="approved">Approved</option>
                          <option value="blocked">blocked</option>
                        </select>
                      </td>
                    </tr>

                    <tr>
                      <td style="font-weight: 0.9em; padding-top: 15px;" width="30%" colspan="2">
                        <textarea disabled class="form-control" placeholder="Berikan Alasan Kenapa Anda Merubah Status Ini" style="height: 80px; resize: none;" id="explain" v-model="message"></textarea>
                      </td>
                    </tr>
                  </table>
                </div>

              </div>

            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="update" :disabled="btn_save_disabled">Simpan</button>
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
        contentHeader       : 'Iklan Pengguna (Pending)',
        dataSave            : [],
        selectedData        : [],
        changeState         : '',
        status_onUpdate: 'pending',
        message:"",

        dataTable: {

          columns: [
            { text: "Judul Iklan", searchable: true, index: "product_name", width:"27%", override: function(e){
              return (e.length > 37) ? e.substr(0, 37)+" ..." : e;
            }},
            { text: "Pengiklan", searchable: true, index: "name", width: "10%", override: false},
            { text: "Harga Iklan", searchable: true, index: "product_price", width: "8%", override: function(e){ 
              var bilangan = e;
  
              var number_string = bilangan.toString(),
                sisa  = number_string.length % 3,
                rupiah  = number_string.substr(0, sisa),
                ribuan  = number_string.substr(sisa).match(/\d{3}/g);
                  
              if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
              }

              // Cetak hasil
              return rupiah; // Hasil: 23.456.789
            }},
            { text: "Dibuat Tanggal", searchable: true, index: "product_created_at", width: "12%", override: false},
            { text: "Foto", searchable: true, index: "photo_count", width: "5%", override: false},
            { text: "Pre-Filter", searchable: true, index: "product_pre_filter", width: "7%", override: function(e){ 
              return (e == "passed") ? "<span class='badge badge-info'>"+e+"</span>" : "<span class='badge badge-danger'>"+e+"</span>" }
            },

           /* semua object yang ada di column dibutuhkan sehingga tidak boleh ada satupun object yang tertinggal. 
            
                  object :
                      - text        -> hanya boleh String (text, searchable, index, width, override)
                      - searchable  -> hanya boleh Boolean true/false
                      - index       -> hanya boleh String (sesuai object di dalam array data)
                      - width       -> hanya boleh String (harus satuan ukuran px atau %)
                      - override    -> hanya boleh function / Boolean false (jika tidak menggunakan function)

            */ // Semua Harus Wajib Diisi.
            
          ],

          button_helper: ["V"],
          data: [],
          single_data: [],
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

        axios.get(baseUrl + "/iklan_pengguna/data/list?data=pending")
              .then((response) => {
                this.dataTable.data = response.data
                this.elapsedTime = ((new Date().getTime() - start_time) / 1000).toFixed(2).toString().replace('.', ',');
                // console.log(this.dataTable.data);
              }).catch((error) => {
                console.log(error)
              })
      },
      watch: {
        status_onUpdate: function(value){
          if(value != this.dataTable.single_data[0].product_status){
            $('textarea#explain').removeAttr("disabled");
          }else{
            $('textarea#explain').attr("disabled", "disabled");
          }

          this.message = "";
        },

        changeState: function(value){
          if(this.selectedData != 0){
            
          }

          // console.log(this.dataTable.single_data);
        }
      },

      computed: {
        // list_selected: function(){
        //   var data_selected = []; that = this;
        //   _.forEach(that.selectedData, function(value){
        //     data_selected.push(that.dataTable.data[_.findIndex(that.dataTable.data, function(o) { return o.id == value })]);
        //   })

        //   console.log(data_selected);

        //   return data_selected ;
        // }
      },

      methods: {
          edit: function(){
            // console.log(this.changeState);
            this.dataTable.single_data = [];
            axios.post(baseUrl + "/iklan_pengguna/data/get_iklan", {id: this.changeState})
                    .then((response) => {
                      // console.log(response);
                      if(response.data.length != 0){
                        this.dataTable.single_data = response.data;
                        this.status_onUpdate = response.data[0].product_status;
                        // alert(response.data[0].product_status);
                        console.log(this.dataTable.single_data);
                      }
                      $("#modal_view").modal("show");
                    }).catch((err) => {
                      console.log(err);
                    })

          },

         update: function(){
          // event.preventDefault();
          this.btn_save_disabled = true;
          this.dataSave = this.dataTable.single_data;

          if(this.dataTable.single_data[0].product_status != this.status_onUpdate && this.message == ""){
            $.alert("Anda Harus Memberikan Alasan Terlebih Dahulu");
            this.btn_save_disabled = false;
            return;
          }

          that = this;
          axios.post(baseUrl + '/iklan_pengguna/update_status', {id: this.dataTable.single_data[0].product_id, status: this.status_onUpdate, message: this.message})
          .then((response) => {
            console.log(response.data);
            if(response.data.status == "berhasil"){
              this.btn_save_disabled = false;
              // alert(response.data.content);
              if(response.data.content != "pending"){
                var idx = _.findIndex(this.dataTable.data, function(o){ return o.id == that.dataTable.single_data[0].product_id })
                this.dataTable.data.splice(idx, 1);
                $('#modal_view').modal('toggle');
                this.dataTable.single_data = [];
              }

              $.toast({
                  heading: 'Perubahan Berhasil',
                  text: 'Status '+this.contentHeader+' Berhasil Diubah.',
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
            this.dataTable.single_data.name = ""; this.dataTable.single_data.icon = "";
            this.dataTable.dataAddForm = [];
          })
        },

        humanizePrice: function(alpha){
          var bilangan = alpha;
  
          var number_string = bilangan.toString(),
            sisa  = number_string.length % 3,
            rupiah  = number_string.substr(0, sisa),
            ribuan  = number_string.substr(sisa).match(/\d{3}/g);
              
          if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
          }

          // Cetak hasil
          return rupiah; // Hasil: 23.456.789
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
          this.dataTable.single_data = [];
          axios.post(baseUrl + "/iklan_pengguna/data/get_iklan", {id: id})
                  .then((response) => {
                    // console.log(response);
                    if(response.data.length != 0){
                      this.dataTable.single_data = response.data;
                      this.status_onUpdate = response.data[0].product_status;
                      // alert(response.data[0].product_status);
                      console.log(this.dataTable.single_data);
                    }
                    $("#modal_view").modal("show");
                  }).catch((err) => {
                    console.log(err);
                  })
        },
        edit_one: function(id){
          alert('Edit Standby')
        },
        delete_one: function(id){
          alert('Delete StandBy');
        }
      }
    })

  </script>
@endsection