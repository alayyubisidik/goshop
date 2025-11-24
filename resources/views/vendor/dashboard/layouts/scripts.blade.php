<script>
    var notyf = new Notyf({
        duration: 3000
    });

    $(document).ready(function() {
        $('.select2').select2();
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

        // slug auto-generate
        $('#name').on('input', function() {
            $('#slug').val(slugify($(this).val()));
        });

        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/[^a-z0-9\-\.]/g, '') // Remove all non-alphanumeric chars except hyphens and dots
                .replace(/\-\-+/g, '-') // Replace multiple hyphens with a single one
                .replace(/^\-+|\-$/g, ''); // Trim hyphens from start and end
        }
    });

    document.addEventListener("DOMContentLoaded", function() {

        if (window.Litepicker) {
            document.querySelectorAll('.datepicker').forEach(element => {
                new Litepicker({
                    element: element,
                    buttonText: {
                        previousMonth: `<!-- Download SVG icon from http://tabler.io/icons/icon/chevron-left -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1"><path d="M15 6l-6 6l6 6" /></svg>`,
                        nextMonth: `<!-- Download SVG icon from http://tabler.io/icons/icon/chevron-right -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1"><path d="M9 6l6 6l-6 6" /></svg>`,
                    },
                });
            });
        }
    });
</script>
