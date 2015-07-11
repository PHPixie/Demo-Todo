var projects = new function() {
    this.init = function (settings) {
        $(function() {
            $('.project .delete').on('click',function() {
                var project = $(this).closest('.project');
                $.ajax({
                    url: settings.deleteUrl,
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        'id' : project.data('id')
                    })
                }).done(function() {
                    project.remove();
                });
            });
        });
    }
}