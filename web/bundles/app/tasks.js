var tasks = new function() {
    this.init = function (settings) {
        var projectTasks = $('#projectTasks');
        
        var updateProjectTasks = function(data) {
            projectTasks.find('.tasksDone').text(data.tasksDone);
            projectTasks.find('.tasksTotal').text(data.tasksTotal);
            
            if(data.tasksDone == data.tasksTotal) {
                projectTasks.addClass('done');
            }else{
                projectTasks.removeClass('done');
            }
        }
        
        var updateTaskHandler = function(url, callback) {
            return function() {
                var task = $(this).closest('.task');
                $.ajax({
                    url: url,
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        'id' : task.data('id')
                    })
                }).done(function(data) {
                    callback(task, data);
                    updateProjectTasks(data);
                });
            }
        }
        
        $(function() {
            $('.task:not(.done) .icon').on('click',
                updateTaskHandler(settings.doneUrl, function(task) {
                    task.addClass('done');
                })
            );
            
            $('.task .delete').on('click',
                updateTaskHandler(settings.deleteUrl, function(task) {
                    task.remove()
                })
            );
        })
    }
}