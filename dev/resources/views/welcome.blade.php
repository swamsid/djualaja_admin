<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <style>
            #alpha{
              width:80%;
              margin:auto;
            }
            ul{
              padding: 4px 4px;
              border: 1px solid black;
              
            }
            li{
              list-style-type:none;
              padding:4px 4px;
            }
            li:hover{
              background-color:#eee;
            }
            li:nth-child(2n){
              background-color:#ddd;
            }
            li:nth-child(2n):hover{
              background-color:#ccc;
            }

            button{
              width:100px;
              height:40px;
              background-color:#eef;
            }

            button:hover{
              cursor:pointer;
            }
            button:hover:disabled{
              cursor:not-allowed;
            }
        </style>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset("css/app.css") }}" tppabs="http://www.bootstrapdash.com/demo/purple/css/style.css">

    </head>
    <body>

        <div id="alpha">
            <paginated-list :list-data="people" :size="size"/> 
        </div>
        

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>

        
        <script src="{{ URL::asset('js/app.js') }}"></script>
        <script src="{{ URL::asset('js/component/vue_datatables.js') }}"></script>

        <script>
            function createFakeData(){
              let data = [];
              for(let i = 0; i < 100; i++){
                data.push({first: 'John',
                           last:'Doe', 
                           suffix:'#' + i});
              }
              return data;
            }


            new Vue({
                el: '#alpha',
                data:{
                    people: [],
                    size: 5
                }
            })

        </script>
    </body>
</html>
