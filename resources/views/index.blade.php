@extends('layouts.master')
@section('content')
<h1 class="text-center p-3 bg-dark text-white">Image_Crud</h1>

<div class="container">

    <div class="modal fade" id="AddStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addPostForm" enctype="multipart/form-data" action="">
                        @csrf
                        <div class="form group mb-3">
                            <input onchange="doAfterSelectImage(this)" type="file" name="image" id="image" style="display: none">
                            <label for="image" class="img-uploaders form-control">
                            <img src="{{ asset('assets/images/placeholder.png') }}" alt="" height="100px" id="post_user_image">
                            </label>
                            <p>Post Screenshot</p>
                        </div>
                        <div class="form group mb-3">
                            <label for="">Product Name</label>
                            <input type="text" class="form-control input" name="name" id="name">
                        </div>
                        <div class="form group mb-3">
                            <label for="description">Description:</label>
                            <textarea name="description" class="form-control input" id="description" cols="30" rows="10"></textarea>
                        </div>
                        <span style="display: none;" id="error_image">
                            <div class="alert alert-danger" role="start">Post is required</div>
                        </span>
                        <button type="button" class="save_post_btn custom_btn mt-4">Save Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Student Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_stud_id">
                    <h4>Are You Sure You Want To Delete This Data ???</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger delete_student_btn">Yes,Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Cart Modal --}}
    <div class="modal fade" id="CartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cart list</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_stud_id">
                </div>
                <div class="modal-footer cart_body">

                </div>
            </div>
        </div>
    </div>
    {{-- End cart Modal --}}

    <h3 class="text-center p-3 bg-dark text-white mt-4">Post listing
        <a href="#" data-bs-toggle="modal" data-bs-target="#AddStudentModal" class="btn btn-primary float-end btn-sm">Add Product</a>
        <a href="#" data-bs-toggle="modal" data-bs-target="#CartModal" class="btn btn-primary float-end btn-sm">Cart</a>
    </h3>
     <div class="postRecord"></div>
</div>

@endsection

@push('scripts')
    <script>
        function doAfterSelectImage(input){
            readURL(input);
        }
        function readURL(input){
            if(input.files && input.files[0]){
                var reader=new FileReader();
                reader.onload=function(e){
                    $('#post_user_image').attr('src',e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush



