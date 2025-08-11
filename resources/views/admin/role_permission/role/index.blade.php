 @extends('admin.layouts.master')
 @section('content')
     <div class="content">

         <!-- Start Content-->
         <div class="container-xxl">

             <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                 <div class="flex-grow-1">
                     <h4 class="fs-18 fw-semibold m-0">All Role</h4>
                 </div>

                 <div class="text-end">
                     <ol class="breadcrumb m-0 py-0">
                         <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                             data-bs-target="#standard-modal">
                             + Add Role
                         </button>
                     </ol>
                 </div>
             </div>

             <!-- Datatables  -->
             <div class="row">
                 <div class="col-12">
                     <div class="card">

                         <div class="card-header">

                         </div>

                         <div class="card-body">
                             <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                 <thead>
                                     <tr>
                                         <th>Sl</th>
                                         <th>Roles Name</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($roles as $key => $item)
                                         <tr>
                                             <td>{{ $key + 1 }}</td>
                                             <td>{{ $item->name }}</td>
                                             <td>

                                                 <a href="{{ route('admin.edit.permission', $item->id) }}"
                                                     class="btn btn-success btn-sm">Edit</a>


                                                 <a href="{{ route('admin.delete.permission', $item->id) }}"
                                                     class="btn btn-danger btn-sm delete-item" id="delete">Delete</a>
                                             </td>
                                         </tr>
                                     @endforeach

                                 </tbody>
                             </table>
                         </div>

                     </div>
                 </div>
             </div>




         </div>

     </div>


     {{-- User Role Model --}}
     <div class="modal fade" id="standard-modal" tabindex="-1" aria-labelledby="standard-modalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">

                 <!-- Modal Header -->
                 <div class="modal-header">
                     <h1 class="modal-title fs-5" id="standard-modalLabel">Add Role</h1>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>

                 <!-- Modal Body with Input -->
                 <div class="modal-body">
                     <form action="" method="">
                         @csrf
                         <div class="mb-3">
                             <label for="roleName" class="form-label">Role Name</label>
                             <input type="text" class="form-control" id="roleName" name="roleName"
                                 placeholder="Enter role name" required>
                         </div>
                     </form>
                 </div>

                 <!-- Modal Footer -->
                 <div class="modal-footer">
                     <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                     <button type="submit" form="addRoleForm" class="btn btn-primary">Save</button>
                 </div>

             </div>
         </div>
     </div>
 @endsection
