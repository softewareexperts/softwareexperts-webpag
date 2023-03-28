@extends('layouts.app')
@section('title')

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" id="add_todo">
  Add List
</button>
</div>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panelt">
                <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">List</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($todos as $record)
               <tr id="list_todo_{{ $record->id }}">
                    <th scope="row">{{ $record->id }}</th>
                       <td>{{ $record->name }}</td>
                    <td>
                        <button class="btn btn-primary" type="button" id="edit_todo" data-id="{{ $record->id }}" >
                            <i class="fa-solid fa-file-pen"></i> Edit 
                        </button>
                        <button class="btn btn-danger" type="button" id="del_todo" data-id="{{ $record->id }}" >
                        <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </td>
                </tr> 
                    @endforeach
                    

                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="model_todo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="model_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_todo">
            <input type="hidden" name="id" id="id" value="1">
            <div class="form-group">
              <label for="formGroupExampleInput">Name</label>
              <input type="text" class="form-control" name="name" id="name_todo" placeholder="Example input" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
          </form>
      </div>
 
    </div>
  </div>
  <script type="text/javascript">

    $(document).ready(function(){
        $.ajaxSetup({
            header:{
                'x-csrf-token' :$ ('meta[name="csrf-token"]').attr('contant')
            }
        })
    });


      $("#add_todo").on('click',function(){
        $("form_todo").trigger('reset');
        $("#model_title").html('Add List');
        $("#model_todo").modal('show');
      });

      $("body").on('click','#edit_todo',function(){
        var id = $(this).data('id');
        $.get('/todos/'+id+'/edit', function(res){
            $('#model_title').html('Edit Todo');
            $('#id').val(res.id);
            $("#name_todo").val(res.name);
            $("model_todo").modal('show');
        });
      });


      $("body").on('click','#del_todo',function(){
        var id = $(this).data('id');
        confirm('Are you sure want to delete !');
        $.ajax({
            type:'DELETE',
            url: "/todos/destroy/" + id
        }).done(function(res){
            $("#row_todo_" + id).remove();
        });
    });


    $("#form_todo").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '{{ route("todos.store")}}',
            data: $("#form_todo").serialize(),
            type:'POST'
        }).done(function(res){
            var row = '<tr id="row_todo_'+ res.id + '">';
            row += '<td width="20">' + res.id + '</td>';
            row += '<td>' + res.name + '</td>';
            row += '<td width="150">' + '<button type="button" id="edit_todo" data-id="' + res.id +'" class="btn btn-info btn-sm mr-1">Edit</button>' + '<button type="button" id="delete_todo" data-id="' + res.id +'" class="btn btn-danger btn-sm">Delete</button>' + '</td>';
            if($("#id").val()){
                $("#row_todo_" + res.id).replaceWith(row);
            }else{
                $("#list_todo").prepend(row);
            }
            $("#form_todo").trigger('reset');
            $("#modal_todo").modal('hide');
        });
    });

</script>
@endsection