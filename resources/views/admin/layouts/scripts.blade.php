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

    });
</script>
