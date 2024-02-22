<!DOCTYPE html>
<html>
<head>
    <title>Employee Management</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
    body
    {
      margin:0;
      padding:0;
      background-color:#f1f1f1;
    }
    .box
    {
      width:900px;
      padding:20px;
      background-color:#fff;
      border:1px solid #ccc;
      border-radius:5px;
      margin-top:10px;
    }
  </style>
</head>
<body>
  <div class="container box">
    <h3 align="center">Employee Management</h3><br />
    <div class="table-responsive">
      <br />
      <input class="form-control" id="search_by_employee" type="text" placeholder="Search by employee details..">
      <br>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Mobile Number</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>   
    </div>
  </div>
</body>
</html>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
  
  function load_data()
  {
    $.ajax({
      url:"<?php echo base_url(); ?>employee/load_data",
      dataType:"JSON",
      success:function(data){
        var html = '<tr>';
        html += '<td id="fname" contenteditable placeholder="Enter First Name"></td>';
        html += '<td id="lname" contenteditable placeholder="Enter Last Name"></td>';
        html += '<td id="gender" contenteditable placeholder="Enter Gender"></td>';
        html += '<td id="mobile_no" contenteditable placeholder="Enter Mobile Number"></td>';
        html += '<td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus"></span></button></td></tr>';
        for(var count = 0; count < data.length; count++)
        {
          html += '<tr>';
          html += '<td class="table_data" data-row_id="'+data[count].eid+'" data-column_name="fname" contenteditable>'+data[count].fname+'</td>';
          html += '<td class="table_data" data-row_id="'+data[count].eid+'" data-column_name="lname" contenteditable>'+data[count].lname+'</td>';
          html += '<td class="table_data" data-row_id="'+data[count].eid+'" data-column_name="gender" contenteditable>'+data[count].gender+'</td>';
          html += '<td class="table_data" data-row_id="'+data[count].eid+'" data-column_name="mobile_no" contenteditable>'+data[count].mobile_no+'</td>';
          html += '<td><button type="button" name="delete_btn" id="'+data[count].eid+'" class="btn btn-xs btn-danger btn_delete"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
        }
        $('tbody').html(html);
      }
    });
  }

  load_data();

  $(document).on('click', '#btn_add', function(){
    var fname = $('#fname').text();
    var lname = $('#lname').text();
    var gender = $('#gender').text();
    var mobile_no = $('#mobile_no').text();
    if(fname == '')
    {
      alert('Enter First Name');
      return false;
    }
    if(lname == '')
    {
      alert('Enter Last Name');
      return false;
    }
    if(gender == '')
    {
      alert('Enter Gender');
      return false;
    }
    if(mobile_no == '')
    {
      alert('Enter Mobile Number');
      return false;
    }
    $.ajax({
      url:"<?php echo base_url(); ?>employee/insert",
      method:"POST",
      data:{
        fname:fname,
        lname:lname,
        gender:gender,
        mobile_no:mobile_no
      },
      success:function(data){
        load_data();
      }
    })
  });

  $(document).on('blur', '.table_data', function(){
    var id = $(this).data('row_id');
    var table_column = $(this).data('column_name');
    var value = $(this).text();
    $.ajax({
      url:"<?php echo base_url(); ?>employee/update",
      method:"POST",
      data:{id:id, table_column:table_column, value:value},
      success:function(data)
      {
        load_data();
      }
    })
  });

  $(document).on('click', '.btn_delete', function(){
    var id = $(this).attr('id');
    if(confirm("Are you sure you want to delete this?"))
    {
      $.ajax({
        url:"<?php echo base_url(); ?>employee/delete",
        method:"POST",
        data:{id:id},
        success:function(data){
          load_data();
        }
      })
    }
  });

  $("#search_by_employee").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    console.log(value);
    $.ajax({
      url:"<?php echo base_url(); ?>employee/search",
      dataType:"JSON",
      method:"POST",
      data:{search_keyword:value},
      success:function(data){
        var html = '<tr>';
        html += '<td id="fname" contenteditable placeholder="Enter First Name"></td>';
        html += '<td id="lname" contenteditable placeholder="Enter Last Name"></td>';
        html += '<td id="gender" contenteditable placeholder="Enter Gender"></td>';
        html += '<td id="mobile_no" contenteditable placeholder="Enter Mobile Number"></td>';
        html += '<td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus"></span></button></td></tr>';
        for(var count = 0; count < data.length; count++)
        {
          html += '<tr>';
          html += '<td class="table_data" data-row_id="'+data[count].eid+'" data-column_name="fname" contenteditable>'+data[count].fname+'</td>';
          html += '<td class="table_data" data-row_id="'+data[count].eid+'" data-column_name="lname" contenteditable>'+data[count].lname+'</td>';
          html += '<td class="table_data" data-row_id="'+data[count].eid+'" data-column_name="gender" contenteditable>'+data[count].gender+'</td>';
          html += '<td class="table_data" data-row_id="'+data[count].eid+'" data-column_name="mobile_no"