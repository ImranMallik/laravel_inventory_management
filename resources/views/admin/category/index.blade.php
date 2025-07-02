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

                                                  <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editData{{$item->id}}">
                                                        Edit
                                                    </button>

                                                      {{-- Modal --}}

                                                    <div class="modal fade" id="editData{{$item->id}}" tabindex="-1" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="standard-modalLabel">Add Category</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <form id="editCategory" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" value="{{$item->id}}" name="id">
                                                                    <div class="modal-body">
                                                                        <!-- Category Name input field -->
                                                                        <div class="mb-3">
                                                                            <label for="category_name" class="form-label">Category Name :</label>
                                                                            <input type="text" class="form-control" id="category_name" name="name"
                                                                                placeholder="Enter category name" value="{{$item->name}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                        <button class="btn btn-primary" type="submit" id="saveButton">
                                                                        <span id="spinner" class="spinner-border spinner-border-sm me-2 d-none"
                                                                            role="status" aria-hidden="true"></span>
                                                                        Save Change
                                                                    </button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>

                                                 <a href="{{ route('admin.category.delete', $item->id) }}"
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

                 <form id="category" method="POST">
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
                         <button class="btn btn-primary" type="submit" id="saveButton">
                                         <span id="spinner" class="spinner-border spinner-border-sm me-2 d-none"
                                             role="status" aria-hidden="true"></span>
                                         Save Change
                                     </button>
                     </div>
                 </form>

             </div>
         </div>
     </div>
 @endsection
 @push('scripts')
     <script>
         $(document).ready(function() {

             $('#category').on('submit', function(e) {
                 e.preventDefault();
                 //  alert();
                 let name = $('input[name="name"]').val();
                

                 if (!name) {
                     toastr.error("Please fill in all required fields.");
                     return
                 }

                 $('#spinner').removeClass('d-none');
                 $('#saveButton').attr('disabled', true);
                 let formData = new FormData(this);
                 $.ajax({
                     url: "{{ route('admin.category.store') }}",
                     method: "POST",
                     data: formData,
                     processData: false,
                     contentType: false,
                     success: function(response) {
                         toastr.success(response.message);

                         $('#category')[0].reset();
                          $('#standard-modal').modal('hide'); 
                         setTimeout(() => {
                             window.location.href = "{{ route('admin.category.all') }}"

                         }, 1500);
                     },
                     error: function(xhr) {
                         let errors = xhr.responseJSON?.errors;
                         if (errors) {
                             $.each(errors, function(key, value) {
                                 toastr.error(value[0]);
                             });
                         } else {
                             toastr.error("An unexpected error occurred.");
                         }
                     },
                     complete: function() {
                         // Hide spinner and enable button again
                         $('#spinner').addClass('d-none');
                         $('#saveButton').removeAttr('disabled');
                     }
                 });
             });



             
             //Update Category......
             $('#editCategory').on('submit', function(e) {
                 e.preventDefault();
                 //  alert();
                 let name = $('input[name="name"]').val();
                 let id = $('input[name="id"]').val();
                

                 if (!name) {
                     toastr.error("Please fill in all required fields.");
                     return
                 }

                 $('#spinner').removeClass('d-none');
                 $('#saveButton').attr('disabled', true);
                 let formData = new FormData(this);
                 $.ajax({
                      url: "{{ route('admin.category.update', ':id') }}".replace(':id', id),
                     method: "POST",
                     data: formData,
                     processData: false,
                     contentType: false,
                     success: function(response) {
                         toastr.success(response.message);

                         $('#editCategory')[0].reset();
                          $('#editData').modal('hide'); 
                         setTimeout(() => {
                             window.location.href = "{{ route('admin.category.all') }}"

                         }, 1500);
                     },
                     error: function(xhr) {
                         let errors = xhr.responseJSON?.errors;
                         if (errors) {
                             $.each(errors, function(key, value) {
                                 toastr.error(value[0]);
                             });
                         } else {
                             toastr.error("An unexpected error occurred.");
                         }
                     },
                     complete: function() {
                         // Hide spinner and enable button again
                         $('#spinner').addClass('d-none');
                         $('#saveButton').removeAttr('disabled');
                     }
                 });
             });
         })
     </script>
 @endpush