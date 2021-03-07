<!DOCTYPE html>
<html>    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Patrick Wallin">
        
        <link rel="stylesheet" href="css/styles.css">

        <title>Integration Engineer Coding Challenge By Patrick Wallin</title>
    </head>

    <body>
        <div class="controls">
            <button id="btn-refresh-members" type="button">Refresh Members</button>
            <input type="checkbox" id="cbx-show-xml" name="show-xml" value="0">
            <label for="show-xml"> Show XML</label><br>
        </div>
        <p></p>
        <div class="displays">            
            <div id="display-xml" hidden> 
                <label>XML Data:</label>
                <p></p>
                <textarea readonly id="display-xml-data" rows="30"></textarea>
            </div>
            <p></p>
            <div id="display-json">
                <label>Converted Data (JSON - Members Only):</label>
                <p></p>
                <textarea readonly id="display-json-data" rows="30"></textarea>
            </div>
        </div>

        <script src="js/scripts.js"></script>
    </body>
</html>