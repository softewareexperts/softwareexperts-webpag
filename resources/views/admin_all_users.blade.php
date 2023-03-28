@extends('layouts.app')
@section('title')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panelt">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('status') }}
            </div>
            @elseif(session('failed'))
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('failed') }}
            </div>
            @endif
            <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for users..">

                <table id="myTable" class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">email</th>
                    <th scope="col">User Type</th>
                    <th scope="col">Action</th>

                </tr>
                </thead>
                <tbody>
                    @foreach ($user as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                           <td>{{ $user->name }}</td>
                           <td>{{ $user->email }}</td>
                           <td>
                            @if($user->user_type==0)
                            User
                            @else
                            Admin
                            @endif
                        </td>
                        <td>
                            <button onclick="return confirm('Are You Sure to Asign Role to this user?')" class="btn btn-primary" type="button">
                                <i class="fa-solid fa-file-pen"></i><a href="{{ Route('change.role',$user->id) }}" style="color:aliceblue"> Change Role</a> 
                            </button>
                            <button class="btn btn-danger" type="button" id="del_todo" data-id="" >
                            <i class="fa-solid fa-trash"></i><a href="{{ Route('delete.user',$user->id) }}" style="color:aliceblue"> Delete</a>
                            </button>
                        </td>
                    </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function myFunction() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      td = table.getElementsByTagName("td");
    
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
    </script>
@endsection