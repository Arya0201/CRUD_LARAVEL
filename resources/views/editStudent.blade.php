<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Student</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="file"],
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        .form-group select {
            cursor: pointer;
        }

        .form-group .btn-submit {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group .btn-submit:hover {
            background-color: #0056b3;
        }
        .button-container{
            max-width: 500px;
            margin: 0 auto;
            display: flex;
            justify-content: end
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="form-container">
            <h2>Update Student</h2>
            <form method="POST" action="{{ route('student.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="id" name="id" value="{{$student->id}}" class="form-control">
                <div class="form-group">
                    <label for="fullName">Full Name:</label>
                    <input type="text" id="fullName" name="fullName" value="{{$student->fullName}}" class="form-control">
                    @error('fullName')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{$student->email}}" class="form-control">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="{{$student->password}}" class="form-control">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" value="{{$student->phone}}" class="form-control">
                    @error('phone')
                        <div class="alert alert-danger">{{ $message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="photo">Photo:</label>
                    <input type="file" id="photo" name="photo" class="form-control-file">
                    @error('photo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="currentphoto">Current Photo:</label>
                    <input type="text" id="currentphoto" name="currentphoto" value="{{basename($student->photo)}}" readonly class="form-control">
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" class="form-control">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ 'male' == $student->gender ? 'selected' : ''}}>Male</option>
                        <option value="Female" {{ 'female' == $student->gender  ? 'selected' : ''}}>Female</option>
                        <option value="Other" {{ 'other' == $student->gender  ? 'selected' : ''}}>Other</option>
                    </select>
                    @error('gender')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-submit">Submit</button>
                </div>
            </form>
        </div>
            <div class="button-container">
                <a class="btn btn-sm btn-dark my-2" href={{route('student.display')}}>Back</a>
            </div>

    </div>
</body>

</html>
