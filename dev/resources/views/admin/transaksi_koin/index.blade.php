@extends("admin.app")

@section("title", " Data Transaksi Koin")


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
                <li class="hovered" @click="edit"><a href="#"><i class="fa fa-legal"></i> &nbsp;Periksa Transaksi Yang Ditandai</a></li>
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

              <div class="col-md-5" style="background: none; border-right: 1px solid #ccc;">
                <table id="my-table" width="100%" border="0" style="font-size: 1em; border-color: #ccc;" >

                  <tr>
                    <td width="42%">Nama Pengguna</td>
                    <td class="answer">@{{ dataTable.single_data.transaction_name }}</td>
                  </tr>

                  <tr>
                    <td>Nama Transaksi</td>
                    <td class="answer">@{{ dataTable.single_data.transaction_name }}</td>
                  </tr>

                  <tr>
                    <td>Tanggal Transaksi</td>
                    <td class="answer">@{{ dataTable.single_data.created_at }}</td>
                  </tr>

                  <tr>
                    <td>Token Yang Dibeli</td>
                    <td class="answer">@{{ dataTable.single_data.transaction_amount }}</td>
                  </tr>

                  <tr>
                    <td>Status Transaksi</td>
                    <td class="answer" v-html="sts"></td>
                  </tr>

                  <tr>
                    <td>Total Bayar</td>
                    <td class="answer" v-html="humanizePrice(dataTable.single_data.transaction_subtotal)"></td>
                  </tr>

                  <tr>
                    <td>Total Diskon</td>
                    <td class="answer" v-html="humanizePrice(dataTable.single_data.transaction_discount)"></td>
                  </tr>

                  <tr>
                    <td>Total Setelah Diskon</td>
                    <td class="answer" v-html="humanizePrice(dataTable.single_data.transaction_total)"></td>
                  </tr>

                </table>
              </div>

              <div class="col-md-7">
                
                <div class="col-md-12" style="padding: 10px 10px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; margin-top: 0px;">
                  Bukti Transfer
                </div>
                
                <div class="col-md-12" style="margin-top: 10px; padding: 5px 13px;">
                  <div class="col-md-12" v-if="dataTable.single_data.transaction_status == 'Proses Pembayaran'">
                    <center><small class="text-muted"><i class="fa fa-frown-o"></i> &nbsp;Transaksi Ini Belum Memiliki Bukti Transfer Pembayaran.</small></center>
                  </div>
                </div>

              </div>

            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Tutup</button>

            <button type="button" class="btn btn-primary" @click="update" :disabled="btn_save_disabled" v-if="dataTable.single_data.transaction_status == 'Menunggu Konfirmasi'">Konfirmasi</button>
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
        contentHeader       : 'Transaksi Koin',
        dataSave            : [],
        selectedData        : [],
        changeState         : '',
        status_onUpdate: 'approved',
        message:"",

        dataTable: {

          columns: [
            { text: "Nama Transaksi", searchable: true, index: "transaction_name", width:"27%", override: function(e){
              return (e.length > 37) ? e.substr(0, 37)+" ..." : e;
            }},
            { text: "Tanggal Transaksi", searchable: true, index: "created_at", width: "12%", override: function(e){
              return e.split(' ')[0];
            }},
            { text: "Total Koin", searchable: true, index: "transaction_amount", width: "8%", override: false},
            { text: "Total Bayar", searchable: true, index: "transaction_total", width: "10%", override: function(e){ 
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
            { text: "Status Transaksi", searchable: true, index: "transaction_status", width: "12%", override: function(e){
              let sts = "<span class='badge badge-success'>Selesai</span>";
              if(e == 'Proses Pembayaran')
                sts = "<span class='badge badge-info'>Menunggu Pembayaran</span>";
              else if(e == 'Menunggu Konfirmasi')
                sts = "<span class='badge badge-warning'>Menunggu Konfirmasi</span>";

              return sts;
            }},

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

        axios.get(baseUrl + "/transaksi/data/list")
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
        sts: function(){
          let status = "<span class='badge badge-success'>Selesai</span>";
          let e = this.dataTable.single_data.transaction_status;

          if(e == 'Proses Pembayaran')
            status = "<span class='badge badge-info'>Menunggu Pembayaran</span>";
          else if(e == 'Menunggu Konfirmasi')
            status = "<span class='badge badge-warning'>Menunggu Konfirmasi</span>";

          return status;
        }
      },

      methods: {
          edit: function(){
            // console.log(this.changeState);
            this.dataTable.single_data = [];
            axios.post(baseUrl + "/transaksi/data/get_transaksi", {id: this.changeState})
                    .then((response) => {
                      // console.log(response);
                      if(response.data != null && response.data.length != 0){
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
          this.btn_save_disabled = true;
          this.dataSave = this.dataTable.single_data;
          that = this;

          // console.log(this.dataTable.single_data)

          $.confirm({
              title: 'Pesan Sistem',
              content: 'Dengan Melakukan Konfirmasi Transaksi Ini. Anda Juga Akan Menambahkan Jumlah Koin Yang Dimiliki Oleh User Terkait Sesuai Dengan Jumlah Koin Yang Akan Dibeli..',
              buttons: {
                  deleteUser: {
                      text: 'Yaa, Saya Mengerti',
                      action: function () {
                          axios.post(baseUrl + '/transaksi/update_status', {id: that.dataTable.single_data.id})
                            .then((response) => {
                              console.log(response.data);
                              if(response.data.status == "berhasil"){
                                that.btn_save_disabled = false;
                                var idx = _.findIndex(that.dataTable.data, function(o){ return o.id == that.dataTable.single_data.id });
                                that.dataTable.data[idx].transaction_status = 'Confirmed';
                                that.dataTable.single_data.transaction_status = 'Confirmed';

                                $.toast({
                                    heading: 'Perubahan Berhasil',
                                    text: 'Status '+that.contentHeader+' Berhasil Diubah.',
                                    position: 'top-right',
                                    stack: false
                                })
                              }else if(response.data.status == 'invalid'){
                                that.btn_save_disabled = false;
                                $.toast({
                                    heading: 'Perubahan Berhasil',
                                    text: 'Status '+that.contentHeader+' Berhasil Diubah.',
                                    position: 'top-right',
                                    stack: false
                                })
                              }else{
                                console.log("local")
                              }
                            }).catch((error) => {
                              alert(error);
                            }).then((data) => {
                              // this.dataTable.single_data = [];
                            })
                      }
                  },
                  Tidak: function () {
                      $.alert('Kategori Tidak Jadi Diupdate.');
                  }
              }
          });
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
          axios.post(baseUrl + "/transaksi/data/get_transaksi", {id: id})
                  .then((response) => {
                    // console.log(response);
                    if(response.data.length != 0){
                      this.dataTable.single_data = response.data;
                      // alert(response.data[0].product_status);
                      console.log(this.dataTable.single_data);
                    }
                    $("#modal_view").modal("show");
                  }).catch((err) => {
                    console.log(err);
                  })
        },
        edit_one: function(id){
          alert('Edit StandBy');
        },
        delete_one: function(id){
          alert('Delete StandBy');
        }
      }
    })

  </script>
@endsection