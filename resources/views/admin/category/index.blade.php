 @extends('admin.layouts.master')
 @section('content')
     <div class="content">

         <!-- Start Content-->
         <div class="container-xxl">

             <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                 <div class="flex-grow-1">
                     <h4 class="fs-18 fw-semibold m-0">All Categories</h4>
                 </div>

                 <div class="text-end">
                     <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#standard-modal">
                         + Add
                     </button>
                 </div>
             </div>

             <!-- Datatables  -->
             <div class="row">
                 <div class="col-12">
                     <div class="card">

                         <div class="card-header">

                         </div><!-- end card header -->

                         <div class="card-body">
                             <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                 <thead>
                                     <tr>
                                         <th>Sl</th>
                                         <th>Name</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($categories as $key => $item)
                                         <tr>
                                             <td>{{ $key + 1 }}</td>
                                             <td>{{ $item->name }}</td>
                                             <td>

                                                 <a href="{{ route('admin.brand.edit', $item->id) }}"
                                                     class="btn btn-success btn-sm">Edit</a>


                                                 <a href="{{ route('admin.brand.delete', $item->id) }}"
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

     {{-- Modal --}}

     <div class="modal fade" id="standard-modal" tabindex="-1" aria-labelledby="standard-modalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">

                 <div class="modal-header">
                     <h1 class="modal-title fs-5" id="standard-modalLabel">Add Category</h1>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>

                 <form action="#" method="POST">
                     @csrf
                     <div class="modal-body">
                         <!-- Category Name input field -->
                         <div class="mb-3">
                             <label for="category_name" class="form-label">Category Name :</label>
                             <input type="text" class="form-control" id="category_name" name="name"
                                 placeholder="Enter category name" required>
                         </div>
                     </div>

                     <div class="modal-footer">
                         <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary">Save Category</button>
                     </div>
                 </form>

             </div>
         </div>
     </div>
 @endsection
