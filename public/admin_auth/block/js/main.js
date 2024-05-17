function actionDelete(event) {
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);
    Swal.fire({
        title: "Bạn có chắc muốn xoá item này?",
        text: "Dữ liệu sẽ không thể khôi phục nếu xoá!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Xoá"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: urlRequest,
                success: function (data) {
                    if(data.code == 200){
                        that.parent().parent().remove();
                        Swal.fire({
                            title: "Đã xoá!",
                            text: "Sản phẩm đã được xoá.",
                            icon: "success"
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: data.message,
                            icon: "error"
                        })
                    }
                },
                error: function (data) {

                }
            });

        }
    });
}
$(function(){
    $(document).on('click', '.btn-action-delete', actionDelete)
})
