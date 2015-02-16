<html>
    <head>
        <title>Generator wykreślanek</title>
        <link rel="stylesheet" href="sheet.css" type="text/css">
        <meta charset="utf-8">
    </head>
    <body>
        <h1>Generator wykreślanek (v0.1 tzw. pierwsza działająca)</h1>
        Wpisz słowa oddzielone spacją: <input type="text" id="words"></input>
        <button type="button" onclick="generatePuzzle()">generuj wykreślankę</button>
        <div id="content">
            
        </div>
        <script type="text/javascript">
            function generatePuzzle() 
            {
                var requestObject = new XMLHttpRequest();
                var wordsList = "wordsList=" + document.getElementById("words").value.toUpperCase();
                requestObject.open("POST", "controller.php", true);
                requestObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                requestObject.send(wordsList);
                requestObject.onreadystatechange = function() 
                {
                    if (requestObject.readyState == 4 && requestObject.status == 200)
                    {
                        document.getElementById("content").innerHTML = requestObject.responseText;
                    }
                }
            }
            
        </script>
    </body>
</html>