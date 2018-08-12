@extends("admin.app")

@section("title", " Laporan Iklan Dari Pengguna")


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
          <div class="col-11">
            <ol class="breadcrumb breadcrumb-custom">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Pengelola Iklan</a></li>
              <li class="breadcrumb-item active" aria-current="page"><span>Data @{{ contentHeader }}</span></li>
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
              <data-list-category :list-data="dataTable.data" :size="dataTable.size" :columns="dataTable.columns" :data_category="dataTable.single_data" :dataTab="dataTable.data" @get_select_unit="selectedUnit"></data-list-category>
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

                          <div v-for="(picture, idx) in dataTable.single_data[0].iklan.photos" :class="(idx == 0) ? 'text-center carousel-item active' : 'text-center carousel-item'">
                            <img style="height: 250px; object-fit: contain; margin: 0 auto;" :src="picture.property_of+'/images/users/upload/'+dataTable.single_data[0].user_id+'/products/'+dataTable.single_data[0].iklan.product_id+'/'+picture.photo_name" :alt="'First slide'">
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
                        <td class="answer">@{{ dataTable.single_data[0].iklan.product_name }}</td>
                      </tr>

                      <tr>
                        <td>Kondisi  </td>
                        <td class="answer">@{{ dataTable.single_data[0].iklan.product_condition }}</td>
                      </tr>

                      <tr>
                        <td>Nego  </td>
                        <td class="answer" v-html="(dataTable.single_data[0].iklan.product_nego) ? 'Ya' : 'Tidak'"></td>
                      </tr>

                      <tr>
                        <td>Harga  </td>
                        <td class="answer">Rp.@{{ humanizePrice(dataTable.single_data[0].iklan.product_price) }},-</td>
                      </tr>

                      <tr>
                        <td>Alamat  </td>
                        <td class="answer">@{{ dataTable.single_data[0].iklan.product_location }}</td>
                      </tr>

                      <tr>
                        <td>Kota  </td>
                        <td class="answer">@{{ dataTable.single_data[0].iklan.district.regency.name }}</td>
                      </tr>


                    </table>
                  </div>

                </div>

                <div class="row" style="padding: 0px 10px;">
                  <div class="col-md-12" style="background: none; padding: 10px 15px; border-bottom: 1px solid #ccc; border-top: 1px solid #ccc; margin-top: 15px; font-weight: 600;">
                    Deskripsi Iklan
                  </div>

                  <div class="col-md-12" style="background: none; padding: 10px 15px; border-bottom: 1px solid #ccc; margin-top: 0px; font-size: 0.9em;" v-html="dataTable.single_data[0].iklan.product_description">
                  </div>
                </div>

              </div>

              <div class="col-md-5">
                <div class="col-md-12" style="padding: 0px;">
                  <div class="row">
                    <div class="col-md-5" style="background: none;">
                    
                        <img style="height: 100px; object-fit: contain; margin: 0 auto;" :src="Pof+'/images/users/upload/'+dataTable.single_data[0].user.id+'/profile.png'" :alt="'First slide'">

                    </div>

                    <div class="col-md-7" style="padding: 0px; padding-right: 10px; padding-top: 5px;">
                      <table id="my-table" width="100%" border="0" style="font-size: 0.9em; border-color: #ccc;" >

                        <tr>
                          <td width="35%">Nama  </td>
                          <td class="answer">@{{ dataTable.single_data[0].user.name }}</td>
                        </tr>

                        <tr>
                          <td>email  </td>
                          <td class="answer">@{{ dataTable.single_data[0].user.email }}</td>
                        </tr>


                      </table>
                    </div>

                  </div>

                  <div class="row" style="padding: 0px 10px;">
                    <div class="col-md-12" style="background: none; padding: 10px 15px; border-bottom: 1px solid #ccc; border-top: 1px solid #ccc; margin-top: 15px; font-weight: 600;">
                      Informasi Laporan
                    </div>

                    <div class="col-md-12 text-right" style="background: none; padding: 10px 15px; border-bottom: 0px solid #ccc; margin-top: 0px; font-size: 0.9em; font-weight: 600; font-style: italic;">
                      Subject &nbsp; &nbsp; : @{{ dataTable.single_data[0].report_category }}
                    </div>

                    <div class="col-md-12" style="background: none; padding: 10px 15px; border-bottom: 1px solid #ccc; margin-top: 0px; font-size: 0.9em;" v-html="dataTable.single_data[0].report_reason">
                    </div>
                  </div>

                </div>

              </div>

            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="update" :disabled="btn_save_disabled">Block Iklan</button>
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
        contentHeader       : 'Laporan Iklan Dari Pengguna',
        dataSave            : [],
        selectedData        : [],
        changeState         : '',
        status_onUpdate: 'approved',
        message:"",

        dataTable: {

          columns: [
            { text: "Tanggal Pelaporan", searchable: true, index: "created_at", width: "12%", override: false},
            { text: "Pelapor", searchable: true, index: "name", width: "5%", override: false},
            { text: "Subject Laporan", searchable: true, index: "report_category", width: "7%", override: false},
            { text: "Nama Iklan", searchable: true, index: "product_name", width: "7%", override: false},

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
          single_data: [],
        }

      },
      mounted: function(){
        console.log("Vue Ready");
        // $('#modal_view').modal('show');
        if('{{ $override }}' == "create"){
          this.add();
        }
      },
      created: function(){
        var start_time = new Date().getTime();

        axios.get(baseUrl + "/laporan_user/data/list?data=approved")
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
            var that = this;
            var data = that.dataTable.data[_.findIndex(that.dataTable.data, function(o) { return o.id == that.changeState })]
            // console.log(data);
            axios.post(baseUrl + "/laporan_user/data/get_info", {id: data.id})
                    .then((response) => {
                      console.log(response.data);
                      if(response.data.length != 0){
                        this.dataTable.single_data = response.data;
                        // alert(response.data[0].product_status);
                        // console.log(this.dataTable.single_data);
                      }
                      $("#modal_view").modal("show");
                    }).catch((err) => {
                      console.log(err);
                    })

          },

         update: function(){
          // event.preventDefault();
          // this.btn_save_disabled = true;
          this.dataSave = this.dataTable.single_data;
          that = this;
          // alert("okee");

          axios.post(baseUrl + '/laporan_user/block', {id: this.dataTable.single_data[0].id})
          .then((response) => {
            console.log(response.data);
            if(response.data.status == "berhasil"){
              this.btn_save_disabled = false;
              that.dataTable.data.splice(_.findIndex(that.dataTable.data, function(o){ return o.id == response.data.content }), 1);
              
              $.toast({
                  heading: 'Perubahan Berhasil',
                  text: 'Status '+this.contentHeader+' Berhasil Diubah.',
                  position: 'top-right',
                  stack: false
              })
            }else if(response.data.status == 'not found'){
              $.toast({
                  heading: 'Perubahan Tidak Berhasil',
                  text: 'Iklan Yang Ingin Anda Block Tidak Dapat Kami Temukan. Cobalah Untuk Memuat Halaman Terlebih Dahulu.',
                  position: 'top-right',
                  stack: false
              })
            }else{
              console.log("local")
            }
          }).catch((error) => {
            alert(error);
          }).then((data) => {
            
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
          // console.log(a);
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