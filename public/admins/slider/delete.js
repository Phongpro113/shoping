(function() {
    $('.delete_slider').click(function (e) {
        var $removeBtn = $(this);
        var url = $removeBtn.data('url');
        var confirmation = confirm("are you sure you want to remove?");
        if (confirmation) {
            $.ajax({
                type: "GET",
                url: url,  // or whatever is the URL to the destroy action in the controller
                success: function (data) {
                    console.log(data);
                    $removeBtn.parent().parent().parent().remove(); // assumes that the wrapper for each line item is cart-data-details__total
                }
            });
        }
        return false;
    });

})();
