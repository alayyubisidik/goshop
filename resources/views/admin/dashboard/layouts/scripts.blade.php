<script>
    var notyf = new Notyf({
        duration: 3000
    });

    $(document).ready(function() {

        function previewImage(inputSelector, previewSelector) {
            $(inputSelector).on("change", function() {
                const file = this.files[0];
                const preview = $(previewSelector);

                if (!file) {
                    preview.hide().attr("src", "");
                    return;
                }

                if (!file.type.startsWith("image/")) {
                    alert("Please select an image file.");
                    $(this).val("");
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.attr("src", e.target.result).show();
                };
                reader.readAsDataURL(file);
            });
        }

        previewImage("#avatar-upload", "#avatar-preview");
        previewImage("#icon-upload", "#logo-preview");
        previewImage("#image-upload", "#image-preview");
        previewImage("#brand-logo-upload", "#brand-logo-preview");
    });


    $('.delete-btn').on('click', function(e) {
        e.preventDefault();

        const form = $(this).closest('form'); // form terdekat
        const data = $(this).data('name'); // ambil atribut data-name

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: `Data "${data}" akan dihapus secara permanen.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // submit form jika konfirmasi
            }
        });
    });
</script>
