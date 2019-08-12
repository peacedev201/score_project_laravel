@extends('layouts.app')

@section('content')


    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}" />


   

<script type="text/javascript" src="https://www.prepbootstrap.com/Content/data/shortGridData.js"></script>

<div class="container">



<!-- Editable Table - START -->

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading" style = "height:130px">
            <h1 class="text-center" >Case AHT Competition </h1>
            <h1>
            <a href="{{ route('month') }}"><span class="pull-right btn btn-primary"  style = "font-size:15px;    margin-left: 10px;">Current Month </span> </a>
            <a href="{{ route('week') }}"><span class="pull-right btn btn-success"  style = "font-size:15px;    margin-left: 10px;">Current Week  </span></a>
            <a href="{{ route('home') }}"><span class="pull-right btn btn-info"  style = "font-size:15px;    margin-left: 10px;">Today</span> </a>
              <span class="pull-left btn btn-info" style = "font-size:15px"data-toggle="modal" data-target="#scoreModal">Submit</span>
              
            </h1>
        </div>
        <div class="panel-body text-center">            
            <div id="grid">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th ></th>
                    <th style = "width:15%">RANK</th>
                    <th style = "width:15%">PREVIOUS RANK</th>
                    <th style = "width:15%">PLAYER</th>
                    <th style = "width:15%">TEAM</th>
                    <th style = "width:15%">POINTS</th>
                    @if (Auth::user()->name == 'aaa') 
                    <th >ACTIONS</th>
                    @endif
                </tr>
                </thead>
                <tbody id = "table_data">   
                <!-- @foreach($result_data as $result_data)
                <tr>
                    <th style = "width:20%"><span><img src="{{URL::asset('img/1.jpg')}}" class = "avatar_size"></span></th>
                    <th style = "width:16%">{{$result_data->rank}}</th>
                    <th style = "width:16%">{{$result_data->pre_rank}}</th>
                    <th style = "width:16%">{{$result_data->name}}</th>
                    <th style = "width:16%">{{$result_data->team}}</th>
                    <th style = "width:16%">{{$result_data->points}}</th>
                </tr>
                @endforeach             -->
                
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>


<!--This is score submit modal-->
<div class="modal fade" id="scoreModal" 
     tabindex="-1" role="dialog" 
     aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="favoritesModalLabel">Record your score</h2>
      </div>
      <div class="modal-body">
        <p>Enter the number of cases in your last call and hit submit</p>
        <p>Your number of cases will be updates and time recorded for checking.</p>
        <input type="number" class="form-control" style="margin:auto; width:65%;" id="score"  placeholder="How many cases for your calls?">

      </div>
      <div class="modal-footer">

          <button type="button" class="btn btn-success" data-dismiss="modal" id = "submit" style = "margin:auto;width:50%">
            Submit
          </button>
          
      </div>
    </div>
  </div>
</div>

<form id="editEmpForm" method="post">
    <div class="modal " id="editEmpModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Table</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Name</label>
                    <div class="col-md-10">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name..." required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Team</label>
                    <div class="col-md-10">
                        <input type="text" name="team" id="team" class="form-control" placeholder="Team..." required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Points</label>
                    <div class="col-md-10">
                        <input type="number" name="points" id="points" class="form-control" placeholder="Points..." required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="user_id" id="user_id" class="form-control">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
        </div>
    </div>
</form>

<form id="deleteEmpForm" method="post">
    <div class="modal " id="deleteEmpModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Delete Player</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
               <strong>Are you sure to delete this player?</strong>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="deleteEmpId" id="deleteEmpId" class="form-control">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-primary">Yes</button>
          </div>
        </div>
      </div>
    </div>
</form>

<!-- you need to include the shieldui css and js assets in order for the grids to work -->
<link rel="stylesheet" type="text/css" href="https://www.prepbootstrap.com/Content/shieldui-lite/dist/css/light/all.min.css" />
<script type="text/javascript" src="https://www.prepbootstrap.com/Content/shieldui-lite/dist/js/shieldui-lite-all.min.js"></script>
<script type="text/javascript">
    // function today(){
    //     $roleID =  "today";

    //     $.ajax({
    //         url: "set_session.php",
    //         data: { role: $roleID },
    //         success: function(response)
    //             {
    //                 console.log(response);
    //                 location.reload();
    //             }
    //     });  
    // }

    $(document).ready(function () {
        

        $.ajax({
            url :"/home_view_month",
            type:'GET',
            success: function(data){

                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<tr id="'+data[i].id+'">'+
                                '<td style = "width:20%"><span><img src="{{URL::asset('img/1.jpg')}}" class = "avatar_size"></span></td>'+
                                '<td>'+data[i].month_rank+'</td>'+
                                '<td>' +data[i].month_pre_rank+'</td>'+
                                '<td>'+data[i].name+'</td>'+
                                '<td>'+data[i].team+'</td>'+
                                '<td>'+data[i].month_points+'</td>'+
                                '@if (Auth::user()->name == "aaa")'+
                                '<td style="text-align:right; display:inline-flex">'+
                                        '<a href="javascript:void(0);" class="btn btn-info btn-sm editRecord" data-id="'+data[i].id+'" data-fullname="'+data[i].fullname+'" data-address="'+data[i].address+'" data-idnumber="'+data[i].idnumber+'" data-dob="'+data[i].dob+'" data-mobile="'+data[i].mobile+'" data-telephone="'+data[i].telephone+'" >Edit</a>'+' '+'<a href="javascript:void(0);" class="btn btn-danger btn-sm deleteRecord" style = "margin-left: 5px;"data-id="'+data[i].id+'">Delete</a>'+'</td>'+'</tr>'+
                                '@endif';
                                    }
                                    $('#table_data').html(html);
                }
            });

            $('#table_data').on('click','.editRecord',function(){
                var id = $(this).data('id');
                console.log("here is data id");
                console.log(id);
                var rank = $(this).data('month_rank');
                var pre_rank = $(this).data('month_pre_rank');
                var name = $(this).data('name');
                var team = $(this).data('team');
                var points = $(this).data('month_points');
                $('#editEmpModal').modal('show');  
                $('[name="user_id"]').val(id);  
                $('[name="name"]').val(name);
                $('[name="team"]').val(team);
                $('[name="points"]').val(points);
            });

            $(document).on('click','.deleteRecord',function(){
                var id = $(this).data('id');
                var name = $(this).data('name');
                console.log("here is delete_data id");
                console.log(id);
                $('#deleteEmpModal').modal('show');
                $('[name="deleteEmpId"]').val(id);
            });

            $('#editEmpForm').on('submit', function(){
                var id = $('#user_id').val();
                var name = $('#name').val();
                var team = $('#team').val();
                var points = $('#points').val();
                $.ajax({
                    type : "GET",
                    url  : "month_data_update",
                    dataType : "JSON",
                    data : {id:id, name:name, team:team, points:points},
                    success: function(data){
                        location.reload();
                    }
                });
                return false;
            });
            $('#deleteEmpForm').on('submit',function(){
                var id = $('#deleteEmpId').val();
                $.ajax({
                    type : "GET",
                    url  : "data_delete",
                    dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                        location.reload();
                    }
                });
                return false;
            });

        $('#submit').click(function() {
            id = "{{ Auth::user()->id }}"
            score = $("#score").val();
            $.ajax({
                url: '/score_add',
                type: 'GET',
                data: { id: id,
                        score: score },
                success: function(response)
                {
                    location.reload();
                }
            });
        });

        // $("#grid").shieldGrid({
        //     dataSource: {
        //         data: ,
        //         schema: {
        //             fields: {
        //                 rank: { path: "rank", type: Number },
        //                 pre_rank: { path: "pre_rank", type: Number },
        //                 name: { path: "name", type: String },
        //                 team: { path: "team", type: String },
        //                 points: { path: "points", type: Number },
        //                 email: { path: "email", type: String },
        //             }
        //         }
        //     },
        //     sorting: {
        //         multiple: true
        //     },
        //     rowHover: false,
        //     columns: [
        //         { field: "rank", title: "RANK", width: "80px" },
        //         { field: "pre_rank", title: "PREVIOUS RANK" },
        //         { field: "name", title: "PLAYER" },
        //         { field: "team", title: "TEAM" },
        //         { field: "points", title: "POINTS" },             
        //         {
        //             width: 150,
        //             title: "Custom Editor",
        //             buttons: [
        //                 { commandName: "edit", caption: "Edit" },
        //                 { commandName: "delete", caption: "Delete" }
        //             ]
        //         }
        //     ],
        //     editing: {
        //         enabled: true,
        //         mode: "popup",
        //         confirmation: {
        //             "delete": {
        //                 enabled: true,
        //                 template: function (item) {
        //                     return "Delete row with ID = " + item.id
        //                 }
        //             }
        //         }
        //     }            
        // });

       
    });
</script>

<style type="text/css">
    .sui-grid-core .sui-gridheader .sui-headercell {
        text-align: center;
        border-width: 0 0 0 1px;
    }
    .sui-button-cell
    {
        text-align: center;
    }

    .sui-checkbox
    {
        font-size: 17px !important;
        padding-bottom: 4px !important;
    }

    .deleteButton img
    {
        margin-right: 3px;
        vertical-align: bottom;
    }

    .bigicon
    {
        color: #5CB85C;
        font-size: 20px;
    }
</style>

<!-- Editable Table - END -->

</div>
@endsection
