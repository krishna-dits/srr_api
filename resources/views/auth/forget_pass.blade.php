<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
            margin: 0;
        }

        .background {
            background: url("https://images.pexels.com/photos/4386357/pexels-photo-4386357.jpeg") no-repeat center center/cover;
            position: absolute;
            top: -50px;
            bottom: -50px;
            left: -50px;
            right: -50px;
            z-index: -1;
            filter: blur(20px);
        }
    </style>
</head>

<body>

    <!--=============== TAILWIND CSS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css"
        referrerpolicy="no-referrer" />
    <div class="background" id="background"></div>
    <div class="bg-white rounded-2xl p-10 text-center shadow-lg text-gray-500">
        <h1 class="text-3xl">Set New Password</h1>
        <form action="" method="POST">
            @csrf
            <div class="my-4 text-left">
                <label for="password" class="text-sm">New Password:</label>
                <input type="password" class="border block w-full p-2 mt-2 rounded-full" id="password"
                    placeholder="Enter password" name="new_password">
                @error('new_password')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="my-4 text-left">
                <label for="password" class="text-sm">Confirm Password:</label>
                <input type="test" class="border block w-full p-2 mt-2 rounded-full" id="password"
                    placeholder="Enter password" name="confirm_password">
                @error('confirm_password')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <button
                class="bg-gray-500 font-semibold text-white py-2 mt-4 inline-block w-full border border-gray-500 hover:border-transparent rounded-full"
                type="submit">Submit</button>
        </form>
    </div>

    <script>
        // const background = document.getElementById("background");
        // const password = document.getElementById("password");

        // password.addEventListener("input", () => {
        //     background.style.filter = `blur(${20 - password.value.length * 2}px)`;
        // });
    </script>
</body>

</html>
