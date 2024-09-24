<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #c8abbd;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #4e2845; /* Dark maroon */
            padding: 20px;
            text-align: center;
            color: white;
        }
        h1 {
            font-weight: 600;
            margin: 0;
            font-size: 28px;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
        }
        .edit-post {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .edit-post input, .edit-post textarea {
            width: 95%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin: 10px;
            margin-bottom: 15px;
            font-size: 16px;
        }
        .edit-post button {
            background-color: #4e2845;
            color: white;
            padding: 12px;
            margin: 10px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            width: 98%;
        }
        .edit-post button:hover {
            background-color: #3e2035;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Edit Post</h1>
    </div>

    <div class="container">
        <div class="edit-post">
            <form action="/edit-post/{{$post->id}}" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="title" value="{{$post->title}}" required placeholder="Post Title">
                <textarea name="body" rows="5" required placeholder="Edit your thoughts here...">{{$post->body}}</textarea>
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

</body>
</html>
