<script>
    $(document).ready(function () {
        let className = '{{ $className }}';
        let element = $('.' + className);
        element.on('click', function (e) {
            e.preventDefault();
            const swalWithBootstrapButton = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger mx-2'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButton.fire({
                title: 'آیا مطمئن هستید؟',
                text: "شما قادر به بازگردانی رکورد نیستید!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'بله، حذف شود',
                cancelButtonText: 'خیر، لغو درخواست',
                reverseButtons: true
            }).then((result) => {
                if (result.value === true) {
                    $(this).parent().submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButton.fire({
                        title: 'لغو شد',
                        text: 'رکورد شما امن است :)',
                        icon: 'error',
                        confirmButtonText: 'باشه'
                    });
                }
            })
        });
    });
</script>
