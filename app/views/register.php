<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: whitesmoke;
        }

        .card {
            min-width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h1 {
            margin-bottom: 3rem;
        }

        .form-control {
            width: 350px;
            padding: 2.5rem 2rem;
            border-radius: .5rem;
            background: whitesmoke;
            box-shadow: 2px 4px 10px rgba(0, 0, 0, .35),
                inset 10px 10px 25px rgba(255, 255, 255, 1);
        }

        .field {
            position: relative;
        }

        .form-input {
            width: 100%;
            border: none;
            outline: none;
            border-radius: 5px;
            padding: .5rem;
            background: rgba(0, 0, 0, .085);
            margin-bottom: 1rem;
            border-bottom: 2px solid transparent;
            border-right: 2px solid transparent;
            border-top: 2px solid transparent;
            border-left: 2px solid transparent;
            z-index: 1;
            transition: border-bottom .2s ease,
                border-right .2s ease .1s,
                border-top .2s ease .2s,
                border-left .2s ease .3s;
        }

        .form-label {
            position: absolute;
            top: .5rem;
            left: .5rem;
            transition: .3s ease;
        }

        .form-input:focus {
            background: none;
            border-color: #3b80ee;
        }

        .form-input:focus+.form-label {
            top: -.5rem;
            left: .8rem;
            font-size: .75rem;
            font-weight: 500;
            background: whitesmoke;
            padding: 0 5px;
        }

        .form-input:not(:placeholder-shown).form-input:not(:focus) {
            background: none;
            border-color: #3b80ee;
        }

        .form-input:not(:placeholder-shown).form-input:not(:focus)+.form-label {
            top: -.5rem;
            left: .8rem;
            background: #fff;
            color: blue;
            font-size: .75rem;
            font-weight: 500;
            padding: 0 5px;
            z-index: 10;
        }

        button {
            width: 100%;
            border: none;
            background: #3b89ee;
            border-radius: 5px;
            padding: .5rem 2rem;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: .3s;
        }

        button:focus {
            outline: none;
            letter-spacing: 2px;
        }

        button:focus,
        button:hover {
            background: #3b80ee;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1 class="title">Create new account</h1>

        <form class="form-control" action="" method="POST" autocomplete="off">
            <div class="field">
                <input class="form-input" type="text" name="username" id="username" placeholder=" ">
                <label class="form-label" for="username">Username</label>
            </div>

            <div class="field">
                <input class="form-input" type="email" name="email" id="email" placeholder=" ">
                <label class="form-label" for="email">Email</label>
            </div>

            <div class="field">
                <input class="form-input" type="password" name="password" id="password" placeholder=" ">
                <label class="form-label" for="password">Password</label>
            </div>

            <div class="field">
                <input class="form-input" type="password" name="cpassword" id="cpassword" placeholder=" ">
                <label class="form-label" for="cpassword">Confirm Password</label>
            </div>

            <button type="submit">Register</button>

        </form>
    </div>

</body>

</html>