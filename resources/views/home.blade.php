<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Little Diary - Notes Style</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #000000; /* Black background */
            color: #e0c1e2;
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
            background-color: #1a1a1a; /* Darker black for container */
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #e0c1e2; /* Light text color */
            margin-bottom: 15px;
        }
        .create-post, .all-posts {
            background-color: #2d2d2d; /* Darker gray for form/post background */
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            padding: 20px;
            margin-bottom: 20px;
        }
        .create-post input, .create-post textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #4e2845; /* Dark maroon border */
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 16px;
            background-color: #1a1a1a; /* Dark input background */
            color: #e0c1e2;
        }
        .create-post input:focus, .create-post textarea:focus {
            border-color: #e0c1e2; /* Light focus border */
            outline: none;
        }
        .create-post button {
            background-color: #4e2845;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        .create-post button:hover {
            background-color: #3e2035; /* Darker maroon on hover */
        }
        .post {
            border-left: 4px solid #4e2845;
            background-color: #2d2d2d;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 6px;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.2);
        }
        .post h3 {
            margin: 0 0 10px 0;
            font-size: 18px;
            color: #e0c1e2;
        }
        .post p {
            margin: 0;
            color: #b3b3b3; /* Slightly lighter text color */
        }
        .post-actions a {
            color: #e0c1e2;
            text-decoration: none;
            margin-right: 10px;
        }
        .post-actions button {
            background-color: #ff4d4d; /* Red delete button */
            border: none;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-register {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
        .login-register button {
            background-color: #4e2845;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            margin: 0 10px;
            transition: background-color 0.3s ease;
        }
        .login-register button:hover {
            background-color: #3e2035;
        }
        .form-container {
            background-color: #2d2d2d;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #e0c1e2;
            font-weight: 500;
        }
        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #4e2845;
            border-radius: 6px;
            font-size: 16px;
            background-color: #1a1a1a;
            color: #e0c1e2;
        }
        .input-group input:focus {
            border-color: #e0c1e2;
            outline: none;
        }
        .logout {
            text-align: right;
            margin-bottom: 20px;
        }
        .logout button {
            background-color: #ff4d4d;
            border: none;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Little Diary</h1>
        <p>Capture your thoughts like notes</p>
    </div>

    <div class="container">

        @auth
        <div class="logout">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>

        <h2>Create a New Post</h2>
        <div class="create-post">
            <form action="/create-post" method="POST">
                @csrf
                <input type="text" name="title" placeholder="Post Title" required>
                <textarea name="body" rows="5" placeholder="Write your thoughts here..." required></textarea>
                <button type="submit">Save Post</button>
            </form>
        </div>

        <h2>All Posts</h2>
        <div class="all-posts">
            @foreach($posts as $post)
            <div class="post">
                <h3>{{ $post['title'] }} by {{ $post->user->name }}</h3>
                <p>{{ $post['body'] }}</p>
                <div class="post-actions">
                    <a href="/edit-post/{{$post->id}}">Edit</a>
                    <form action="/delete-post/{{$post->id}}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        @else
        <div class="login-register">
            <button id="loginBtn">Login</button>
            <button id="registerBtn">Register</button>
        </div>

        <div class="form-container hidden" id="loginForm">
            <h2>Login</h2>
            <form action="/login" method="POST">
                @csrf
                <div class="input-group">
                    <label for="loginname">Username</label>
                    <input type="text" id="loginname" name="loginname" required>
                </div>
                <div class="input-group">
                    <label for="loginpassword">Password</label>
                    <input type="password" id="loginpassword" name="loginpassword" required>
                </div>
                <button type="submit">Log in</button>
            </form>
        </div>

        <div class="form-container hidden" id="registerForm">
            <h2>Register</h2>
            <form action="/register" method="POST">
                @csrf
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Register</button>
            </form>
        </div>
        @endauth
    </div>

    <script>
        document.getElementById('loginBtn').addEventListener('click', function() {
            document.getElementById('loginForm').classList.remove('hidden');
            document.getElementById('registerForm').classList.add('hidden');
        });

        document.getElementById('registerBtn').addEventListener('click', function() {
            document.getElementById('registerForm').classList.remove('hidden');
            document.getElementById('loginForm').classList.add('hidden');
        });
    </script>

</body>
</html>
