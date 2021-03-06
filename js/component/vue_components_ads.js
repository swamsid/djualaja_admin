Vue.component('data-list-category',{
  data(){
    return {
      pageNumber: 0,
      search: "",
      row: 10,
      dataTab: [],
      selected_unit: null,
    }
  },
  props:{
    listData:{
      type:Array,
      required:true
    },
    columns:{
      type:Array,
      required:true
    },
    data_category:{
      type: Array,
      required:false
    }
  },
  mounted: function(){
    console.log("Datatables Ready...")
  },
  methods:{
      nextPage(){
         this.pageNumber++;
         console.log(this.row);
      },
      prevPage(){
        this.pageNumber--;
      },
      selectMe(id){
        this.$emit("get_select_unit", id);
      }
  },
  watch: {

    listData: function(value){
      this.dataTab = value;
      console.log("List Data Change");
      // alert(a);
    },

    search: function(value){
      this.pageNumber = 0;

      if(value == ""){ this.dataTab = this.listData; return }

      idx = $('#column_index').val();

      var data = _.map(this.listData, function(o){
        if(o[idx].toUpperCase().includes(value.toUpperCase())) return o
      })

      // console.log(_.without(data, undefined))

      this.dataTab = _.without(data, undefined)
    }
  },
  computed:{
    pageCount(){
      let l = this.dataTab.length,
          s = this.row;

      return (l !== s) ? Math.floor(l/s) : (Math.floor(l/s) - 1) ;
    },
    paginatedData(){
      const start = this.pageNumber * this.row,
            end = start + this.row;

      // console.log(start + "/" + end)
      return this.dataTab
               .slice(start, end);
    },
    columnIdx(){
      var data = _.map(this.columns, function(o){
        if(o.searchable == true) return o
      })

      return _.without(data, undefined)
    }
  },
  template: `<div>
              <div class="col-md-12" style="margin-bottom: 10px;">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group" style="width:50%;">
                      <span class="input-group-addon" style="font-size:0.8em">
                        Menampilkan
                      </span>
                      <select class="form-control" style="height:2.8em;" v-model="row">
                        <option value="10">10 Baris</option>
                        <option value="50">50 Baris</option>
                        <option value="100">100 Baris</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3" style="background:none; padding:0px;5px;">
                    <div class="input-group">
                      <span class="input-group-addon" style="font-size:0.8em">
                        <i class="fa fa-search"></i>
                      </span>
                      <select class="form-control" style="height:2.8em;" id="column_index">
                        <option v-for="column in columnIdx" :value="column.index">{{ column.text }}</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3" style="padding:0px 15px 0px 5px;">
                    <input type="text" class="form-control" style="background:white;" v-model="search" placeholder="Kata Kunci ....">
                  </div>
                </div>
              </div>

              <div class="col-md-12" style="padding:20px 20px;">
                <div class="row">
                  <div class="col-md-2" style="background: none; height:250px; padding: 0px 10px; cursor: pointer" v-for="(data, index) in paginatedData" @click="selectMe(data.product_id)">
                    <div class="col-md-12" style="padding: 0px; border:1px solid #ccc; border-radius: 5px;">
                      <div class="col-md-12" style="padding:0px;">
                        <img width="100%" :src="data.photos[0].property_of+'/images/users/upload/'+data.user_id+'/products/'+data.product_id+'/picture_1.png'" alt="" />
                      </div>
                      <div class="col-md-12" style="padding:0px; font-size: 0.8em; font-weight: bold; padding: 5px; color: #d32f2f;">
                        {{ data.product_name }}
                      </div>

                      <div class="col-md-12" style="padding:0px; font-size: 0.8em; font-weight: bold; padding: 5px; color: #4b515d;">
                        Rp. {{ data.product_price }}
                      </div>
                    </div>
                  </div>
                </div>

              </div>

              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6" style="padding: 0px 0px 0px 20px;">
                    <span class="text-muted" style="font-size:0.7em;">{{ dataTab.length }} Data Ditemukan , Data Yang Tidak Sesuai Pencarian {{ listData.length - dataTab.length }}</span>
                  </div>
                  <div class="col-md-6 text-right" style="background: none; margin-top: 15px;">
                    <button :disabled="pageNumber === 0" @click="prevPage" type="button" class="btn btn-primary">Sebelumnya</button>
                    <button :disabled="pageNumber >= pageCount" @click="nextPage" type="button" class="btn btn-success">Selanjutnya</button>
                  </div>
                </div>
              </div>
            </div>
  `
});