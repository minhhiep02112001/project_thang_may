function readURL(input) {
    $('.file-upload-content').find('img').remove();
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = document.createElement('img');
            img.setAttribute('style' , ' max-height: 200px ; max-width:400px ; padding: 20px;');
            img.setAttribute('src', e.target.result);
            $('#fileName').val(input.files[0].name);
            $('.file-upload-content').append(img);
        };
        reader.readAsDataURL(input.files[0]);
    } 
}

//Ajax : 
jQuery(document).ready(function(){
    // Xóa dữ liệu bảng trong php admin : 
    $('.btn-delete').click(function(event){
        event.preventDefault();
        var id = $(this).data('id');
        var model = $(this).data('model');

        if(confirm('Bạn có chắc muốn xóa không ???')){
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/'+model+'/'+id,
                type: 'DELETE',
                dataType: 'json',
                data: {
                    id: id,
                },
                success:function(data){
                    Swal.fire({
                        icon: data['icon'],
                        iconColor:data['iconColor'],
                        html: '<h4 style="color:black;font-weight:500;">'+data['text']+'</h4>',
                        background:'#fff',
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didClose:(toast) => {
                            location.reload();
                        }
                    })
                },
                error:function(){
                    Swal.fire({
                        icon: 'error',
                        iconColor:'red',
                        html: '<h4 style="color:black;font-weight:500;">Error</h4>',
                        background:'#fff',
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,  
                    });
                }        
            });
        }
    });
});