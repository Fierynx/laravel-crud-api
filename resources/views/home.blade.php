<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Products</title>
  <style>
    #table-header {
      font-weight: 500;
    }
  </style>
</head>
<body><br><br>
  <div class="container-sm" style="max-width: 1200px;">
    <table border="1px" class="table table-striped table-hover" >
        <tr id="table-header">
          <td>#</td>
          <td>Deadline</td>
          <td>Title</td>
          <td>Subject</td>
          <td>Description</td>
          <td>Image</td>
        </tr>
        @forelse ($tasks as $task)
          <tr>
            <td>{{ $task->TaskId }}</td>
            <td>{{ $task->Deadline }}</td>
            <td>{{ $task->Title }}</td>
            <td>{{ $task->subject->Subject }}</td>
            <td>{{ $task->Description }}</td>
            <td><img width="200" height="200" src="/storage/{{ $task->Image }}" alt="Image Not Found"></td>
            </td>
          </tr>
        @empty
          <p class="alert-danger">No Data</p>
        @endforelse
    </table>
    <div class="d-flex justify-content-center">
      {{ $tasks->links() }}
    </div>
  </div>
  <script src="https://kit.fontawesome.com/ab7504228a.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>