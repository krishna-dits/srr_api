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
        <h1 class="text-3xl">Password reseted successfully.</h1>
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
