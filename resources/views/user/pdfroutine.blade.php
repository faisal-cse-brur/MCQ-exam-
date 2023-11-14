<!DOCTYPE html>
<html>
<head>
  <title>PDF</title>
  <head>
      <style>
      table, td, th {
        border: 1px solid;
        text-align:center;
      }

      table {
        width: 100%;
        border-collapse: collapse;
      }
      </style>
  </head>
<body>
  <h2 style="text-align:center;">Exam Routine</h2>
    <table>
      <thead>
        <th>ID</th> date
        <th>Exam Name</th>
        <th>Date</th>
        <th>Time</th>
      </thead>
      <tbody>
        @foreach($exams as $show)
        <tr>
          <td>{{$show->id}}</td>
          <td>{{$show->exam_name}}</td>
          <td>{{$show->date}}</td>
          <td>{{$show->time}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
</body>
</html>
