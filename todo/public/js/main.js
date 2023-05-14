$("#formAddList").on("submit", function(e){
    e.preventDefault();
    $('#formAddList .form-control').removeClass('is-invalid');
    $('#formAddList .invalid-feedback').remove();
    let formData = new FormData();
    let action   = $(this).attr("action");
    formData.append('title', $("#title").val());
    formData.append('description', $("#description").val());
    formData.append('tags', JSON.stringify($("#tags").val()));
    formData.append('image', $("#image")[0].files[0]);
    console.log(typeof $("#tags").val());
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: action,
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        dataType : 'json',
        beforeSend(){
            $('form#formAddList button[type=submit]#submitFormTodo').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Загрузка...');
        },
        success: function(data){
            $('#formAddList').replaceWith('<div class="alert alert-success">'+data.message+'</div>');
            $('form#formAddList button[type=submit]#submitFormTodo').html('<span data-feather="save"></span> Сохранить');
        },
        error: function(msg) {
            if (msg.status == 422) {
                let errors = msg.responseJSON.errors;
                $.each(errors, function(k, v){
                    $("input[name="+k+"]").addClass("is-invalid");
                    $("input[name="+k+"]").after('<div class="invalid-feedback">'+v+'</div>');
                });
            }
            $('form#formAddList button[type=submit]#submitFormTodo').html('<span data-feather="save"></span> Сохранить');
        }
    });
});

$("#formAddListPermission").on("submit", function(e){
    e.preventDefault();
    $('#formAddListPermission .form-control').removeClass('is-invalid');
    $('#formAddListPermission .invalid-feedback').remove();
    let formData = new FormData();
    let action   = $(this).attr("action");
    formData.append('user', $("#user").val());
    formData.append('permission', $("#permission").val());
    $.ajax({
        type: "POST",
        url: action,
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        dataType : 'json',
        beforeSend(){
            $('form#formAddListPermission button').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Загрузка...');
        },
        success: function(data){
            $('#formAddListPermission').replaceWith('<div class="alert alert-success">'+data.message+'</div>');
            $('form#formAddListPermission button').html('<span data-feather="save"></span> Сохранить');
        },
        error: function(msg) {
            if (msg.status == 422) {
                let errors = msg.responseJSON.errors;
                $.each(errors, function(k, v){
                    $("select[name="+k+"]").addClass("is-invalid");
                    $("select[name="+k+"]").after('<div class="invalid-feedback">'+v+'</div>');
                });
            }
            $('form#formAddList button').html('<span data-feather="save"></span> Сохранить');
        }
    });
});

function deleteTodo(id) {
    $.post( "/lk/delete/"+id, function(data){
        if(data==true){
            $('#item-'+id).hide();
        } else {
            $('table').html('<div class="alert alert-warning">Доступ к удалению запрещен</div>');
        }
    } );
}

$('input[type=search]#search').keyup(function(){
    $.post( "/lk/search/"+this.value, function(data){
        if(data.status==200){
            let tableStart = '<div class="table-responsive mt-5">\n' +
                '            <table class="table table-striped table-sm">\n' +
                '                <thead>\n' +
                '                <tr>\n' +
                '                    <th scope="col">#ID</th>\n' +
                '                    <th scope="col">Превью</th>\n' +
                '                    <th scope="col">Заголовок</th>\n' +
                '                    <th scope="col">Текст</th>\n' +
                '                </tr>\n' +
                '                </thead>\n' +
                '                <tbody>';
            let trList = '';
            let tableEnd = '</tbody>\n' +
                '            </table>\n' +
                '        </div>';
            $.each(data.list, function(k, v){
                trList += '<tr id="item-'+v.id+'">\n' +
                    '                        <td>'+v.id+'</td>\n' +
                    '                        <td>\n' +
                    '                            <a href="/storage/'+v.image+'" target="_blank">\n' +
                    '                                <img src="/storage/'+v.previous+'" alt="'+v.title+'" style="width: 150px; height: 150px;">\n' +
                    '                            </a>\n' +
                    '                        </td>\n' +
                    '                        <td>'+v.title+'</td>\n' +
                    '                        <td>'+v.description+'</td>\n' +
                    '                    </tr>';
            });
            $('main').html(tableStart+trList+tableEnd);
        } else {
            $('table').html('<div class="alert alert-warning">Доступ к удалению запрещен</div>');
        }
    } );
});

$('.tags-multiple').select2({
    tags: true,
    tokenSeparators: [',', ' ']
});
