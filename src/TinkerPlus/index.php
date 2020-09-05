<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TinkerPlus</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            background-color: #333;
        }

        main {
            display: flex;
            width: inherit;
            height: inherit;
            flex-direction: row;
        }

        main>section {
            min-width: 50vw;
            overflow: scroll;
        }

        .input>textarea {
            background-color: #333;
            color: #ddd;
            padding: 10px;
        }

        header {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 3px;
            padding: 4px;
            border-bottom: 1px solid #eee;
        }

        h1 {
            font-family: monospace;
            color: #ddd;
        }

        .controls {
            margin-right: 7px;
            position: absolute;
            right: 0;
        }

        .run_btn,
        .reset_btn {
            padding: 4px;
            margin: 1px;
            font-size: 1.2em;
            border: none;
            cursor: pointer;
            border-radius: 1px;
        }

        .run_btn {
            width: 30px;
            color: green;
            background-color: #ddd;
        }

        .reset_btn {
            color: #333;
        }

        @media screen and (max-width:950px) {
            main {
                flex-direction: column;
            }

            main>section {
                height: 50vh;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>TinkerPlus</h1>
        <div class="controls">
            <form action="" method="POST">
                <button type="button" class="run_btn" name="run" title="Run">▶</button>
                <button type="button" class="reset_btn" name="reset" title="Clear Input & Output">Clear</button>
            </form>
        </div>
    </header>
    <main>
        <section class="input">
            <textarea name="input" style="width:100%;height:98%;"></textarea>
        </section>
        <section class="output">
        </section>
    </main>

    <script>
        const run_btn = document.querySelector('.run_btn');
        const clear = document.querySelector('.reset_btn');
        var output = document.querySelector('.output');
        var input = document.querySelector('.input > textarea');
        input.focus();
        //empty input/output on clear button
        clear.addEventListener('click', () => {
            input.value = "";
            output.innerHTML = "";
        });
        run_btn.addEventListener('click', () => {
            //send input data
            var http = new XMLHttpRequest();
            var url = 'tinkerplus.php';
            var params = 'input=' + input.value;
            http.open('POST', url, true);

            //Send the proper header information along with the request
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            http.onreadystatechange = function() { //Call a function when the state changes.
                if (http.readyState == 4 && http.status == 200) {
                    output.innerHTML = http.responseText;
                }
            }
            http.send(params);
        });

        //shortcut for running Ctrl+Enter
        var isCtrl = false;
        document.onkeyup = function(e) {
            if (e.keyCode == 17) isCtrl = false;
        }

        document.onkeydown = function(e) {
            if (e.keyCode == 17) isCtrl = true;
            if (e.keyCode == 13 && isCtrl == true) {
                //run code for CTRL+S -- ie, save!
                run_btn.click();
                return false;
            } else if (e.keyCode == 8 && isCtrl == true) {
                clear.click();
                return false;
            }
        }
    </script>

</body>

</html>