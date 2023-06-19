$(document).ready(function() {
    // Load all todos on page load
    loadTodos();
  
    // Submit the add todo form
    $('#addTodoForm').submit(function(event) {
      event.preventDefault();
      var todoText = $('#todoText').val();
      addTodo(todoText);
    });
  
    // Delete todo when delete button is clicked
    $('#todoList').on('click', '.deleteTodoBtn', function() {
      var todoId = $(this).data('id');
      deleteTodo(todoId);
    });
  
    // Load all todos
    function loadTodos() {
      $.ajax({
        url: 'api.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          if (response.status === 'success') {
            $('#todoList').empty();
            $.each(response.data, function(index, todo) {
              var listItem = '<li class="list-group-item">' + todo.text + '<button class="btn btn-danger float-right deleteTodoBtn" data-id="' + todo.id + '">Delete</button></li>';
              $('#todoList').append(listItem);
            });
          }
        },
        error: function() {
          console.log('Error occurred while loading todos');
        }
      });
    }
  
    // Add a new todo
    function addTodo(todoText) {
      $.ajax({
        url: 'api.php',
        type: 'POST',
        data: { text: todoText },
        dataType: 'json',
        success: function(response) {
          if (response.status === 'success') {
            $('#todoText').val('');
            loadTodos(); // Update the todo list after adding a new todo
          }
        },
        error: function() {
          console.log('Error occurred while adding a todo');
        }
      });
    }
  
    // Delete a todo
    function deleteTodo(todoId) {
      $.ajax({
        url: 'api.php?id=' + todoId,
        type: 'DELETE',
        dataType: 'json',
        success: function(response) {
          if (response.status === 'success') {
            loadTodos(); // Update the todo list after deleting a todo
          }
        },
        error: function() {
          console.log('Error occurred while deleting a todo');
        }
      });
    }
  });

  

  // ...

// Get a single todo by its ID
function getTodoById(todoId) {
    $.ajax({
      url: 'api.php?id=' + todoId,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        if (response.status === 'success') {
          var todo = response.data;
          alert('Todo: ' + todo.text);
        } else {
          console.log(response.message);
        }
      },
      error: function() {
        console.log('Error occurred while retrieving todo');
      }
    });
  }
  
  // ...
  