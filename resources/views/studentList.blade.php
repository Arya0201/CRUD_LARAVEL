<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 20px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 10px 10px 0 0;
            font-weight: bold;
        }

        .card-body {
            padding: 0;
        }

        .table {
            margin-bottom: 0;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table th {
            border-top: none;
        }

        .table th:first-child,
        .table td:first-child {
            border-left: none;
        }

        .table th:last-child,
        .table td:last-child {
            border-right: none;
        }
    </style>
</head>

<body>

    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
         {{session('status')}}
      </div>
    @endif
    @if (session('error'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
         {{session('error')}}
      </div>
    @endif
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Student List
            </div>
            <div class="d-flex justify-content-end my-2 mx-2">
                <a class="btn btn-sm btn-dark" href="/create">Create Student</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Photo</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student )
                            <tr>
                                <td>{{$student->fullName}}</td>
                                <td>{{$student->email}}</td>
                                <td>{{$student->phone}}</td>
                                <td>{{$student->gender}}</td>
                                <td>  <img src="{{ asset($student->photo) }}" style="width: 70px; height:70px;border-radius: 50%;" alt="Img" /></td>
                                <td>
                                    <form action="{{route('student.delete',$student->id)}}" method="POST">
                                        <a class="btn btn-sm btn-primary" href={{route('student.edit',$student->id)}}>Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"   onclick="return confirm('Are you sure ?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
