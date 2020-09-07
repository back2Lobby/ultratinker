<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UltraTinker</title>
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

        .controls>form>button {
            padding: 4px;
            margin: 1px;
            font-size: 1.2em;
            border: none;
            cursor: pointer !important;
            border-radius: 1px;
            outline: none;
        }

        .controls>form>button:hover {
            background-color: gray;
        }

        .run_btn {
            width: 30px;
            color: green;
            background-color: #ddd;
        }

        .reset_btn {
            color: #333;
        }

        .show_query {
            background-color: #ddd;
        }

        .auto_run:hover {
            mix-blend-mode: exclusion;
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
        <h1>UltraTinker</h1>
        <div class="controls">
            <form action="" method="POST">
                <button type="button" class="run_btn" name="run" title="Run (Ctrl+Enter)">▶</button>
                <button type="button" class="reset_btn" name="reset" title="Clear Both (Ctrl+Backspace)">Clear</button>
                <button type="button" class="show_query" name="show_query" title="Show Queries Performed">Show Queries</button>
                <button type="button" class="auto_run" name="auto_run" title="Auto Run (0.2s delay)">Auto Run</button>
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
        const query = document.querySelector('.show_query');
        var auto_run = document.querySelector('.auto_run');
        var output = document.querySelector('.output');
        var input = document.querySelector('.input > textarea');
        var auto_run_toggle = false;
        var show_query = false;
        input.focus();

        //empty input/output on clear button
        clear.addEventListener('click', () => {
            input.value = "";
            output.innerHTML = "";
        });
        run_btn.addEventListener('click', () => {
            //send input data
            var http = new XMLHttpRequest();
            var url = 'ultratinker.php';
            var params = show_query ? 'input=' + input.value + '&show_query=' + show_query : 'input=' + input.value;
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

        //queries button toggler
        query.addEventListener('click', () => {
            if (query.style.backgroundColor == "#ddd" || query.style.backgroundColor == "" || query.style.backgroundColor == "rgb(221, 221, 221)") {
                query.style.backgroundColor = "gray";
                show_query = true;
            } else {
                query.style.backgroundColor = "#ddd";
                show_query = false;
            }
        });
        //auto run the code on 0.2 second delay
        var waitTime = 0.2;
        var timeout = null;
        auto_run.addEventListener('click', () => {
            if (auto_run_toggle == false) {
                input.addEventListener('keypress', autoRun);
                auto_run.style.backgroundColor = "#93cf96";
                auto_run_toggle = true;
            } else {
                input.removeEventListener('keypress', autoRun);
                auto_run.style.backgroundColor = "#ddd";
                auto_run_toggle = false;
                input.focus();
            }
        });
        auto_run.click();


        function autoRun() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                run_btn.click();
            }, waitTime * 1000);
        }
    </script>

</body>

</html>
