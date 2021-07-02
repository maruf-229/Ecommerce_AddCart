$(document).ready(function() {
    getPostImages();
    $('.save_post_btn').on('click', function(e) {
        e.preventDefault();
        // alert('heda');
        let check = userHasUploadedImage();
        if (check) {
            let myForm = document.getElementById('addPostForm');
            let formData = new FormData(myForm);
            // console.log(formData);
            uploadPost(formData);
            $('#AddStudentModal').modal('hide');
            $('#AddStudentModal').find('.input').val("");
        }
    });
});

// Save post
function uploadPost(formData) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "save_post",
        data: formData,
        dataType: "JSON",
        contentType: false,
        processData: false,
        success: function(data) {
            if (data.status) {
                // console.log('success');
                showCustomSuccess(data.message);
                $('#post_user_image').attr('src', 'assets/images/placeholder.png');
                getPostImages();
            } else {
                // console.log('error');
                showCustomError(data.error);
            }
        },
        error: function(err) {
            showCustomError('Something Went Wrong!');
        }
    });
}

// validate image
function userHasUploadedImage() {
    let check = true;
    let file = $('#image').get(0).files[0];
    // console.log(file);
    if (file == undefined || file == null) {
        check = false;
        handleErrors();
        return check;
    }
    handleErrors();
    return check;
}

function handleErrors() {
    let file = $('#image').get(0).files[0];
    if (file == undefined || file == null) {
        $('#error_image').show();
    } else {
        $('#error_image').hide();
    }
}



$(document).on('click', '.update_post_btn', function(e) {
    e.preventDefault();
    let myForm = document.getElementById('updatePostForm');
    let formData = new FormData(myForm);
    updatePost(formData);
});

function updatePost(formData) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const id = $('#id').val();
    $.ajax({
        type: "POST",
        url: "update_post/" + id,
        data: formData,
        dataType: "JSON",
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            if (data.status) {
                // console.log('success');
                showCustomSuccess(data.message);
            } else {
                showCustomError(data.error);
            }
        },
        error: function(err) {
            showCustomError('Something Went Wrong!');
        }
    });
}

$(document).on('click', '.del_post', function(e) {
    e.preventDefault();
    let id = $(this).attr('id');
    // alert(stud_id);
    $('#delete_stud_id').val(id);
    $('#DeleteStudentModal').modal('show');
});

$(document).on('click', '.delete_student_btn', function(e) {
    e.preventDefault();
    let id = $('#delete_stud_id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "del_post/" + id,
        data: {
            id: id
        },
        success: function(data) {
            if (data.status) {
                showCustomSuccess(data.message);
                getPostImages();
            } else {
                showCustomError(data.error);
            }
            $('#DeleteStudentModal').modal('hide');
        }
    });
});

function getPostImages() {
    $.ajax({
        type: "GET",
        url: "get_posts",
        success: function(response) {
            var response = JSON.parse(response);
            // console.log(response);
            $('.postRecord').empty();
            $('.postRecord').append(
                `<table class="table table-hover dt-responsive nowrap postList" id="example" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Post Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>`
            );
            response.forEach(element => {
                $('.postList tbody').append(`
                <tr>
                    <td>${element.id}</td>
                    <td>
                        <img src="storage/posts/${element.image}" class="showcase-image">
                    </td>
                    <td>${element.name}</td>
                    <td>${element.description}</td>
                    <td>
                        <button href="#" class="btn btn-danger btn-sm del_post" id="${element['id']}">Delete</button>
                        <a href="edit/${element.id}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                </tr>
                `)
            });
        }
    });
}