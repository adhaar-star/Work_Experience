

                        $('#delete_task').on('click', function (event) {
                            var result = confirm("Are you sure?");
                            var task_id = $(this).attr("rel");
                            if (result) {
                                $.ajax({
                                    url: base_url + "ajax/delete/tasks/task_id/" + task_id,
                                    dataType: 'json',
                                    cache: false,
                                    success: function (data) {
                                        window.location.reload();
                                    }
                                });
                            }
                        }),
                                
                                

                        /*
                         * MODALS
                         *
                         */
                        $('#addTaskModal').on('show.bs.modal', function (event) {
                            var button = $(event.relatedTarget) // Button that triggered the modal
                            var container_name = button.data('container_name');
                            var container_id = button.data('container_id');

                            var modal = $(this)
                            modal.find('.modal-title').text('Add Task in: ' + container_name)
                            $('#task_container').val(container_id)
                        })

                        $('#editTaskModal').on('show.bs.modal', function (event) {
                            var button = $(event.relatedTarget) // Button that triggered the modal
                            var current_task_id = button.data('task_id');

                            var modal = $(this)
                            if (!current_task_id) {
                                return false;
                            }
                            $.ajax({
                                url: base_url + "ajax/get_task_details/" + current_task_id,
                                dataType: 'json',
                                cache: false,
                                success: function (data) {
                                    modal.find('.task_id').val(data.task.task_id);
                                    modal.find('#delete_task').attr('rel', data.task.task_id);
                                    modal.find('.task_title').val(data.task.task_title);
                                    modal.find('.task_header').html(data.task.task_title);
                                    modal.find('.task_description').val(data.task.task_description);
                                    modal.find('.task_time_estimate').val(data.task.task_time_estimate);
                                    modal.find('.task_time_spent').val(data.task.task_time_spent);
                                    modal.find('.colorPicker').colorselector("setValue", data.task.task_color);
                                    if (data.task_due_date != "0000-00-00 00:00:00")
                                        modal.find('.task_due_date').val(data.task_due_date);

                                    // Details tab
                                    modal.find('.task_date_creation').html(data.task.task_date_creation);
                                    modal.find('.task_date_closed').html(data.task.task_date_closed);

                                    // Working periods task
                                    $('.periods_body').html("");
                                    if (data.task_periods.length > 0) {
                                        data.task_periods.forEach(function (p) {
                                            $('.periods_body').append("<tr><td>" + p.task_date_start + "</td><td>" + p.task_date_stop + "</td><td>" + p.total_time + "</td></tr>");
                                        });
                                        $('.total_time_spent').html(data.task_time_spent);
                                    } else {
                                        $('.periods_body').append("<tr><td colspan='3'>No working periods found for this task.</td></tr>");
                                    }

                                },
                            })


                            $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

                                var tab = $(e.target).attr('href');

                                $.ajax({
                                    url: base_url + "ajax/get_task_details/" + current_task_id,
                                    dataType: 'json',
                                    cache: false,
                                    success: function (data) {
                                        modal.find('.task_id').val(data.task_id);

                                    },
                                });

                            })

                            event.stopPropagation();
                        })
                                ;


                        $(function () {




                            /* Here we will store all data */
                            var myArguments = {};
                           // var data_save = myArguments.serializeArray();
                        //    myArguments.push({ _token: token });
                                    
                            function assembleData(object, arguments) {
                                var data = $(object).sortable('toArray'); // Get array data
                               // var container_id = $(object).attr("rel"); // Get step_id and we will use it as property name
                                 var container_id = $(object).attr("rel_name");
                                 var container_name = $(object).attr("data-name");
                               //  alert(container_name);
                               
                               
                                $(".setboxsize .columnFields .ui-sortable").each(function () {                                
                             var chnageLabelNames=$(this).attr('data-name');
                              $(this).find('.label_backlogs').each(function(){                                  
                                $(this).html('<span class="label_backlogs">'+chnageLabelNames+'</span>');
                              });                            
                             
                            });
                            
                                var arrayLength = data.length; // no need to explain

                                /* Create step_id property if it does not exist */
                                if (!arguments.hasOwnProperty(container_id)) {
                                    arguments[container_id] = new Array();
                                }

                                /* Loop through all items */
                                for (var i = 0; i < arrayLength; i++) {
                                    if (data[i]) {
                                        var task_id = data[i];
                                        /* push all image_id onto property step_id (which is an array) */
                                        arguments[container_id].push(task_id);
                                    }
                                }
                                return arguments;
                            }

                            /* Sort task */
                            $(".column").sortable({
                                connectWith: ".column",
                                cancel: ".nodrag",
                                opacity: 0.7,
                                 cursor: 'move',
                                placeholder: "li-placeholder",
                                /* That's fired first */
                                start: function (event, ui) {
                                    myArguments = {};
                                    $('.bin_container').fadeIn(500);
                                
                                },
                                /* That's fired second */
                                remove: function (event, ui) {
                                     
                                    /* Get array of items in the list where we removed the item */
                                    myArguments = assembleData(this, myArguments);
                                  //myArguments = assembleData(this, token);
                                       
                               
                           
                                     
                                },
                                /* That's fired thrird */
                                receive: function (event, ui) {
                                    /* Get array of items where we added a new item */
                                    myArguments = assembleData(this, myArguments);
                                },
                                update: function (e, ui) {
                                    if (this === ui.item.parent()[0]) {
                                        /* In case the change occures in the same container */
                                        if (ui.sender == null) {
                                           
                                            myArguments = assembleData(this, myArguments);
                                          
                                        }
                                    }
                                },
                                /* That's fired last */
                                stop: function (event, ui) {
                                    $('.bin_container').fadeOut(500);
                                    /* Send JSON to the server */
                                     
                                    $("#result").html("Send JSON to the server:<pre>" + JSON.stringify(myArguments) + "</pre>");
                                    
                                    var get_json=JSON.stringify(myArguments);
//alert(JSON.stringify(myArguments));

                              //   var data_save = myArguments.serializeArray();
                                    // data_save.push({ _token: token, value: "update" });
                                   //    alert(JSON.stringify(myArguments));
  
                                    $.ajax({
                                        headers: {'_token':token},
                                        url: base_url + "boards/create",
                                        type: 'post',
                                        dataType: 'json',
                                     // data: myArguments,
                                        data : { _token: token ,response: myArguments },
                                        cache: false,
                                       
                                          
                                     /*      $(".setboxsize .columnFields .ui-sortable").each(function () {                                
                             var chnageLabelNames=$(this).attr('data-name');
                              $(this).find('.label_backlogs').each(function(){
                                  
                                $(this).html(chnageLabelNames);
                              });                            
                             
                            });
                            
                            */
                                       
                                        
                                    });
                                    
                                    
                                    
                                },
                            });


                          //  $(".portlet").addClass("ui-helper-clearfix ui-corner-all");

                            $(".portlet-toggle").on("click", function () {
                                var icon = $(this);
                                icon.toggleClass("ui-icon-minusthick ui-icon-plusthick");
                                icon.closest(".portlet").find(".portlet-content").toggle();
                                return false;
                            });
                            
                            
                            
                            
                            
                            

 
                        });


