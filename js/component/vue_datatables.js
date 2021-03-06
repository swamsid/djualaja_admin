Vue.component('data-list-category',{
  data(){
    return {
      pageNumber: 0,
      search: "",
      row: 10,
      dataTab: [],
      selected_unit: [],
      sortBy: '',
      order: 'asc',
      prepend: ''
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
    },
    button_helper:{
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
      view_one(id){
        this.$emit("view_one", id);
      },
      edit_one(id){
        this.$emit("edit_one", id);
      },
      delete_one(id){
        this.$emit("delete_one", id);
      },
      sortMe(alpha){
        if(alpha == this.sortBy){
          this.order = (this.order == 'asc') ? 'desc' : 'asc';

          this.dataTab = _.orderBy(this.dataTab, [this.sortBy], [this.order]);
        }else{
          this.order = 'asc';
          this.sortBy = alpha;

          this.dataTab = _.orderBy(this.dataTab, [this.sortBy], [this.order]);
        }
      }
  },
  watch: {
    selected_unit: {
      handler: function(){
        this.$emit("get_select_unit", this.selected_unit);
      },
      deep: true
    },

    listData: function(value){
      this.sortBy = this.columns[0].index;
      this.order = 'asc'
      this.dataTab = _.orderBy(value, [this.sortBy], [this.order]);
      console.log(this.dataTab);
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
    },
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

              <div class="col-md-12">
                <table id="order-listing" class="table table-bordered table-condensed" cellspacing="0">
                  <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th v-for="column in columns" :width="column.width" @click="sortMe(column.index)" style="cursor: pointer;">
                          {{ column.text }}
                          <i class="fa fa-caret-up" v-if="sortBy == column.index && order == 'asc'"></i>
                          <i class="fa fa-caret-down" v-if="sortBy == column.index && order == 'desc'"></i>
                        </th>
                        <th width="8%" v-if="button_helper.length != 0">Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <tr v-if="paginatedData.length == 0">
                      <td colspan="6" class="text-center text-muted" style="font-size:0.8em; font-style: italic;"> Ups . Kami Tidak Dapat Menemukan Data Apapun </td>
                    </tr>

                    <tr v-for="(data, index) in paginatedData">
                        <td>
                          <input type="checkbox" :value="data.id" v-model="selected_unit">
                        </td>
                        <td :title="data[column.index]" :style="(jQuery.isFunction(column.style)) ? column.style(data[column.index]) : column.style" v-for="column in columns" :width="column.width" v-html="(column.override == false) ? data[column.index] : column.override(data[column.index])"></td>
                        
                        <td v-if="button_helper.length != 0">
                          <span v-if="button_helper.findIndex(e => e == 'V') >= 0" @click="view_one(data.id)" class='badge badge-success' style="cursor:pointer" title="Lihat Data"><i class="fa fa-eye"></i></span>
                          <span v-if="button_helper.findIndex(e => e == 'E') >= 0" @click="edit_one(data.id)" class='badge badge-success' style="cursor:pointer" title="Edit Data"><i class="fa fa-pencil-square"></i></span>
                          <span v-if="button_helper.findIndex(e => e == 'D') >= 0" @click="delete_one(data.id)" class='badge badge-success' style="cursor:pointer" title="Hapus Data"><i class="fa fa-eraser"></i></span>
                        </td>
                    </tr>
                    
                  </tbody>
                </table>

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