<script>
    $(document).on('click', '#addCategory', function(e) {
        e.preventDefault();

        let formData = new FormData($("#addCategoryForm")[0]);

        // Debugging: Log form fields
        for (let [key, value] of formData.entries()) {
            console.log(`${key}:`, value);
        }

        $.ajax({
            url: $("#addCategoryForm").attr('action'),
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            beforeSend: function() {
                $('#addCategory').text('Saving....');
            },
            success: function(data) {
                if (data.success) {
                    toastr.success("category added successfully!");
                    $("#addCategoryModal").modal('hide');
                    location.reload(true);
                } else {
                    toastr.error("Sorry, unexpected error has occured.");
                }
            },
            error: function(xhr) {
                toastr.error('Sorry, server error has occured!')
            },
            complete: function() {
                $('#addCategory').text('Save');
            }
        });
    });
</script>
