 @extends('admin.layouts.master')
 @section('content')
     <div class="content">

         <!-- Start Content-->
         <div class="container-xxl">

             <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                 <div class="flex-grow-1">
                     <h4 class="fs-18 fw-semibold m-0">Warehouse</h4>
                 </div>

             </div>

             <!-- Form Validation -->
             <div class="row">
                 <div class="col-xl-12">
                     <div class="card">
                         <div class="card-header">
                             <h5 class="card-title mb-0">Add Warehouse</h5>
                         </div><!-- end card header -->

                         <div class="card-body">
                             <form id="warehouse" method="post" class="row g-3">
                                 @csrf

                                 <div class="col-md-6">
                                     <label for="validationDefault01" class="form-label">Warehouse Name :</label>
                                     <input type="text" class="form-control" name="name">
                                 </div>
                                 <div class="col-md-6">
                                     <label for="validationDefault02" class="form-label">Warehouse Email :</label>
                                     <input type="text" class="form-control" name="email">
                                 </div>
                                 <div class="col-md-6">
                                     <label for="validationDefault02" class="form-label">Warehouse Phone :</label>
                                     <input type="text" class="form-control" name="phone">
                                 </div>
                                 <div class="col-md-6">
                                     <label for="validationDefault02" class="form-label">Warehouse City :</label>
                                     <input type="text" class="form-control" name="city">
                                 </div>

                                 <div class="col-12">
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


             </div>



         </div>

     </div>
 @endsection

 @push('scripts')
     <script>
         $(document).ready(function() {

             $('#warehouse').on('submit', function(e) {
                 e.preventDefault();
                 //  alert();
                 let name = $('input[name="name"]').val();
                 let image = $('input[name="image"]').val();

                 if (!name || !image) {
                     toastr.error("Please fill in all required fields.");
                     return
                 }

                 $('#spinner').removeClass('d-none');
                 $('#saveButton').attr('disabled', true);
                 let formData = new FormData(this);
                 $.ajax({
                     url: "{{ route('admin.brand.store') }}",
                     method: "POST",
                     data: formData,
                     processData: false,
                     contentType: false,
                     success: function(response) {
                         toastr.success(response.message);

                         $('#brandSubmit')[0].reset();
                         $('#showImage').attr('src', "{{ url('uploads/no_image.jpg') }}");
                         setTimeout(() => {
                             window.location.href = "{{ route('admin.brand.all') }}"

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
