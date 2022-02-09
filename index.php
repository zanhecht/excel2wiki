<?php
echo "<!DOCTYPE html>
<html lang=\"en\">
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <!--
        Copyright (c) 2010 Shawn M. Douglas (shawndouglas.com)

        Permission is hereby granted, free of charge, to any person
        obtaining a copy of this software and associated documentation
        files (the \"Software\"), to deal in the Software without
        restriction, including without limitation the rights to use,
        copy, modify, merge, publish, distribute, sublicense, and/or sell
        copies of the Software, and to permit persons to whom the
        Software is furnished to do so, subject to the following
        conditions:

        The above copyright notice and this permission notice shall be
        included in all copies or substantial portions of the Software.

        THE SOFTWARE IS PROVIDED \"AS IS\", WITHOUT WARRANTY OF ANY KIND,
        EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
        OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
        NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
        HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
        WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
        FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
        OTHER DEALINGS IN THE SOFTWARE.
        -->
        <title>excel2wiki | Excel xls to wiki copy and paste converter for wikipedia and mediawiki</title>
        <link rel=\"StyleSheet\" href=\"/style.css\" type=\"text/css\" media=\"screen\" />
        <link rel=\"StyleSheet\" href=\"resources/mediawiki.ui.button.css\" type=\"text/css\" media=\"screen\" />
        <style type=\"text/css\">
        /* <![CDATA[ */
            th, td {padding: 7.5px; width: 50%;}
            input, label, div {display:inline-block !important;}
            code {font-family: monospace !important;}
            a {text-decoration: none; color: #0645ad;}
            a:hover, a:focus {text-decoration: underline;}
            a:visited {color:#0b0080}
            a:active {color:#faa700}
            input:disabled + label {color: #949494}
        /* ]]> */
        </style>
        <script type=\"text/javascript\">
        /* <![CDATA[ */
            function headerrowClick() {
                if (document.getElementById('headerrow').checked && document.getElementById('wikitable').checked) {
                    document.getElementById('sortable').disabled = false;
                } else {
                    document.getElementById('sortable').disabled = true;
                }
            }
            
            function templatetableClick() {
                if (document.getElementById('templatetable').checked) {
                    document.getElementById('wikitable').checked = false;
                }
                wikitableClick();
            }
        
            function wikitableClick() {
               if (document.getElementById('wikitable').checked) {
                   document.getElementById('templatetable').checked = false;
                   document.getElementById('collapsible').disabled = false;
                   if (document.getElementById('headerrow').checked) {document.getElementById('sortable').disabled = false;}
               } else {
                   document.getElementById('collapsible').disabled = true;
                   document.getElementById('sortable').disabled = true;
               }
               collapsibleClick();
            }

            function collapsibleClick() {
               if (document.getElementById('wikitable').checked && document.getElementById('collapsible').checked) {
                   document.getElementById('collapsed').disabled = false;
                   document.getElementById('autocollapse').disabled = false;
               } else {
                   document.getElementById('collapsed').disabled = true;
                   document.getElementById('autocollapse').disabled = true;
               }
            }
        /* ]]> */
        </script>
    </head>
    <body onload=\"headerrowClick(); templatetableClick();\">
        <div style=\"margin-right: auto;margin-left: auto;max-width: 960px;display: block !important;\">
            <h1>Copy and Paste Excel-to-Wiki Converter</h1>
            <form method=\"post\" action=\"".htmlentities($_SERVER['PHP_SELF'])."\">
                <div style=\"text-align: center;margin-right: auto;margin-left: auto;max-width: 960px;display: block !important;\" >
                    <textarea name=\"data\" rows=\"10\" cols=\"80\" style=\"width:100%;margin: 7.5px;\">".$_POST['data']."</textarea><br />
                    <table style=\"margin: 7.5px auto;font-size: initial;\"><tr>
                        <td><div class=\"mw-ui-checkbox\"><input type=\"checkbox\" name=\"headerrow\" id=\"headerrow\"".((isset($_POST['headerrow']) or ($_SERVER['REQUEST_METHOD'] != 'POST')) ? " checked=\"checked\"" : "")." onclick=\"headerrowClick();\"/><label for=\"headerrow\">format first row as header</label></div></td>
                        <td><div class=\"mw-ui-checkbox\"><input type=\"checkbox\" name=\"headercolumn\" id=\"headercolumn\"".(isset($_POST['headercolumn']) ? " checked=\"checked\"" : "")." /><label for=\"headercolumn\">format first column as header</label></div><br /></td>
                    </tr>
                    <tr>
                        <td><div class=\"mw-ui-checkbox\" title=\"For wikis running MediaWiki 1.16+.\"><input type=\"checkbox\" name=\"wikitable\" id=\"wikitable\"".((isset($_POST['wikitable']) or ($_SERVER['REQUEST_METHOD'] != 'POST')) ? " checked=\"checked\"" : "")." onclick=\"wikitableClick();\" /><label for=\"wikitable\">use <code>class=\"wikitable\"</code></label></div></td>
                        <td><div class=\"mw-ui-checkbox\" title=\"For wikis that define table styles with a {{table}} template.\"><input type=\"checkbox\" name=\"templatetable\" id=\"templatetable\"".(isset($_POST['templatetable']) ? " checked=\"checked\"" : "")." onclick=\"templatetableClick();\" /><label for=\"templatetable\">use <code>{{table}}</code> </label></div><br /></td>
                    </tr>
                    <tr>
                        <td><div class=\"mw-ui-checkbox\" title='Table can be collapsed or hidden. Requires class=\"wikitable\".'><input type=\"checkbox\" name=\"collapsible\" id=\"collapsible\"".(isset($_POST['collapsible']) ? " checked=\"checked\"" : "")." onclick=\"collapsibleClick();\" /><label for=\"collapsible\">collapsible</label></div></td>
                        <td><div class=\"mw-ui-checkbox\" title='Show sort buttons. Requires header row and class=\"wikitable\".'><input type=\"checkbox\" name=\"sortable\" id=\"sortable\"".(isset($_POST['sortable']) ? " checked=\"checked\"" : "")." /><label for=\"sortable\">sortable</label></div><br /></td>
                    </tr>
                    <tr>
                        <td><div class=\"mw-ui-checkbox\" title=\"Default to collapsed. Requires 'collapsible'.\"><input type=\"checkbox\" name=\"collapsed\" id=\"collapsed\"".(isset($_POST['collapsed']) ? " checked=\"checked\"" : "")." onclick=\"document.getElementById('autocollapse').checked = false;\" /><label for=\"collapsed\">collapsed</label></div></td>
                        <td><div class=\"mw-ui-checkbox\" title=\"Collapse if 3+ collapsible tables on page. Requires 'collapsible'.\"><input type=\"checkbox\" name=\"autocollapse\" id=\"autocollapse\"".(isset($_POST['autocollapse']) ? " checked=\"checked\"" : "")." onclick=\"document.getElementById('collapsed').checked = false;\" /><label for=\"autocollapse\">autocollapse</label></div><br /></td>
                    </tr></table>
                    <input type=\"submit\"  value=\"Convert\" class=\"mw-ui-button mw-ui-progressive\" />
                </div>
            </form>";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "
            <p style=\"margin-top: 2em;\"><b>Instructions:</b> Copy and paste cells from Excel and click submit. Mouseover options for more information.</p>
            <p style=\"font-size: smaller;\">Based on <a href=\"excel2wiki.php\">excel2wiki</a> and <a href=\"wikipedia.php\">excel2wikipedia</a> (originally located at <a href=\"http://excel2wiki.net\">http://excel2wiki.net</a>) by <a href=\"http://shawndouglas.com/\">Shawn M. Douglas</a> (gmail: shawn.douglas)</p>
            <p style=\"font-size: smaller;\">You can download the <a href=\"https://github.com/sdouglas/excel2wiki\">original source code</a>, the <a href=\"index.php.txt\">modified source code</a>, or the <a href=\"README.markdown\">documentation</a>.</p>";
} else {
    echo "   <h2>Result</h2>\n            <pre>\n{|";
    if (isset($_POST['wikitable'])) {
        echo " class=\"wikitable";
        if (isset($_POST['collapsible'])) {
            echo " collapsible";
            if (isset($_POST['collapsed'])) {
                echo " collapsed";
            } elseif (isset($_POST['autocollapse'])) {
                echo " autocollapse";
            }
        }
        if (isset($_POST['sortable']) && isset($_POST['headerrow'])) {echo " sortable";}
        echo "\"";
    } elseif (isset($_POST['templatetable'])) {
        echo " {{table}}";
    }
    echo "\n";
    $lines = preg_split("/\n/", $_POST['data']);
    $n = sizeof($lines) - 1;
    if (($n>0) and (preg_replace('/[^\PC]/u', '', $lines[$n]) == '')) {
        $lines = array_slice($lines, 0, $n);
        --$n;
    }
    foreach ($lines as $index => $value) {
        $line = preg_split("/\t/", $value);
        if ($index == 0 && isset($_POST['headerrow'])) {
            $data = implode(" !! ", $line);
            echo '! ' . $data;
            echo ($n > 0) ? "|-\n" : "";
        } else {
            if (isset($_POST['headercolumn'])) {
                echo "! " . $line[0] . (((($index < $n) and ($n > 0)) or $line[1]) ? "\n" : "");
                $line = array_slice($line, 1);
            }
            $data = implode(" || ", $line);
            echo $line ? ("| " . $data) : "";
            echo (($index < $n) and ($n > 0)) ? "|-\n" : "";
        }
    }
    echo "\n|}</pre>";
}
echo "\n        </div>
    </body>
</html>";
?>
