const todos = {
    token: "",
    setShowModalEvents : function() {
        const me = this;
        $(".todo_modal_opener_button").each(function () {
            $(this).on("click", function () {
                me.showModal({
                    id : $(this).attr("data_id"),
                    name: $(this).attr("data_name"),
                    todoData: $(this).attr("data_todo_data")
                });
            });
        });
    },
    showModal : function(args) {
        $("#todoModalLongTitle").html("Todo for " + args.name);
        $('#todo_datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
        $("#modal_user_id").attr("value", args.id);
        $("#modal_form").attr("action", "users/" + args.id);
        this.setContainer(JSON.parse(args.todoData));
        $("#todosModal").modal('show');
    },
    submitModal : function() {
        const me = this;
        const userId = $("#modal_user_id").attr("value");
        const name = $("#todo_name").val();
        const date = $("#todo_datepicker").val();
        $.ajax({
            type: "POST",
            url: "/todos/add",
            data: {
                name: name,
                date: date,
                user_id: userId,
                _token: this.token
            },
            success: function(result) {
                try {
                    const res = JSON.parse(result);
                    if (typeof res.error !== 'undefined') {
                        alert("Error: " + res.error);
                        return;
                    }
                } catch (e) {

                }
                me.setContainer(result);
                $("#todo_name").val("");
                $("#todo_datepicker").val("");
            },
            error: function(result){
                alert("ajax error!");
                console.log(result);
            },
            complete: function(){}
        });
    },
    setContainer : function(data) {
        const userId = $("#modal_user_id").val();
        $(".btn[data_id="+userId+"]").attr("data_todo_data", JSON.stringify(data));
        let html = "";
        for (let i in data) {
            html += '<div class="row" style="margin-bottom: 10px;">';
                html += '<div class="col">';
                    html += data[i].name;
                html += '</div>';
                html += '<div class="col">';
                    html += data[i].date;
                html += '</div>';
                html += '<div class="col">';
                    html += '<button class="btn btn-danger" onclick="todos.delete('+data[i].id+')">Delete</button>';
                html += '</div>';
            html += '</div>';
        }
        $("#todo_container").html(html);
    },
    delete : function (id) {
        const me = this;
        $.ajax({
            type: "GET",
            url: "/todos/delete/" + id,
            success: function(result) {
                me.setContainer(result);
            },
            error: function(result){
                alert("ajax error!");
                console.log(result);
            },
            complete: function(){}
        });
    }
};