<!DOCTYPE html>
<html>
<head>
  <title>Todo App</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 500px;
      margin-top: 50px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Todo App</h2>

    <form id="addTodoForm" class="mb-3">
      <div class="input-group">
        <input type="text" class="form-control" id="todoText" placeholder="Enter todo">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">Add Todo</button>
        </div>
      </div>
    </form>

    <ul id="todoList" class="list-group">
      <!-- Todo items will be dynamically added here -->
    </ul>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
