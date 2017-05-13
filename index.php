<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>BoxCharacters</title>
<style media="screen">
	body { background-color:#fafafa; }
	fieldset { background-color:#f6f6f6; overflow:hidden; display:inline-block; vertical-align:top; }
	fieldset p { color:#666; }
	#output * { vertical-align: middle; }
	#output p { display:inline-block; margin:0; }
	#output button { display:inline-block; padding:1em 2em; }
	textarea { width:60em; height:20em; }
	legend { font-variant:small-caps;}
	strong { font-weight:normal; color:#000; }
	code { font-family:monospace; }
	.style, .layout { float:left; white-space:pre; font-family:monospace; margin:0 0.5em;}
	#separator { width:2em; }
</style>
</head>
<body>
<h1>BoxCharacters</h1>
<form action="result.php" method="post">

<fieldset id="styles">
<legend>Styles</legend>
<div class="style"><label title="fine">
┌──┬──┐
│  │  │
├──┼──┤
│  │  │
└──┴──┘
<input type="radio" name="style" value="0"></label></div>
<div class="style"><label title="thick">
┏━━┳━━┓
┃  ┃  ┃
┣━━╋━━┫
┃  ┃  ┃
┗━━┻━━┛
<input type="radio" name="style" value="1"></label></div>
<div class="style"><label title="thick fine">
┍━━┯━━┑
│  │  │
┝━━┿━━┥
│  │  │
┕━━┷━━┙
<input type="radio" name="style" value="2"></label></div>
<div class="style"><label title="fine thick">
┎──┰──┒
┃  ┃  ┃
┠──╂──┨
┃  ┃  ┃
┖──┸──┚
<input type="radio" name="style" value="3"></label></div>
<div class="style"><label title="double">
╔══╦══╗
║  ║  ║
╠══╬══╣
║  ║  ║
╚══╩══╝
<input type="radio" name="style" value="4"></label></div>
<div class="style"><label title="double fine">
╒══╤══╕
│  │  │
╞══╪══╡
│  │  │
╘══╧══╛
<input type="radio" name="style" value="5"></label></div>
<div class="style"><label title="fine double">
╓──╥──╖
║  ║  ║
╟──╫──╢
║  ║  ║
╙──╨──╜
<input type="radio" name="style" value="6"></label></div>
<div class="style"><label title="math">
+--+--+
|  |  |
+--+--+
|  |  |
+--+--+
<input type="radio" name="style" value="7"></label></div>
<div class="style"><label title="rounded">
╭──┬──╮
│  │  │
├──┼──┤
│  │  │
╰──┴──╯
<input type="radio" name="style" value="8"></label></div>
<?php /*
<div class="style"><label title="full">
███████
█  █  █
███████
█  █  █
███████
<input type="radio" name="style" value="8"></label></div>
*/ ?>
</fieldset>

<fieldset id="layouts">
<legend>Layouts</legend>
<div class="layout"><label title="grid">
┌──┬──┬──┐
├──┼──┼──┤
├──┼──┼──┤
└──┴──┴──┘
<input type="radio" name="layout" value="0"></label></div>
<div class="layout"><label title="columns">
┌──┬──┬──┐
│  │  │  │
│  │  │  │
└──┴──┴──┘
<input type="radio" name="layout" value="1"></label></div>
<div class="layout"><label title="rows">
┌────────┐
├────────┤
├────────┤
└────────┘
<input type="radio" name="layout" value="2"></label></div>
<div class="layout"><label title="box">
┌────────┐
│        │
│        │
└────────┘
<input type="radio" name="layout" value="3"></label></div>
<div class="layout"><label title="cross">
   │  │
───┼──┼───
───┼──┼───
   │  │
<input type="radio" name="layout" value="4"></label></div>
</fieldset>

<fieldset id="options">
<legend>Options</legend>
<p>
	<label for="padding">Padding <strong id="range_value">1</strong>:</label>
	<input type="range" min="0" max="10" step="1" value="1" name="padding" id="padding"
		onchange="document.getElementById('range_value').innerText = this.value;">
</p>
<p>
	<label for="separator">Cell separator:</label>
	<input type="text" value=";" name="separator" id="separator" maxlength="1"
    onchange="document.getElementById('separator_value').innerText = this.value;">
</p>
</fieldset>

<fieldset>
<legend>Input</legend>
<p>Enter tabular data separated by <q><strong id="separator_value">;</strong></q> and by line breaks</p>
<textarea name="input">Lorem ipsum; Dolor sit amet; Consectetur; Adipisicing elit
Sed do eiusmod tempor; ; Ut labore et; Dolore magna aliqua.
Ut enim; Ad minim veniam; Quis nostrud; Exercitation ullamco
Laboris nisi; Ut aliquip; ; Commodo consequat
Duis aute irure; Dolor in; Reprehenderit
Esse cillum; Dolore eu; Fugiat nulla; Pariatur
Excepteur
Sunt in culpa; Qui officia deserunt; Mollit anim; Id est laborum</textarea>
</fieldset>

<fieldset id="output">
	<legend>Output</legend>
	<button>Send</button>
	<p>
		<label><input type="radio" name="format" value="text"> Text</label><br>
		<label><input type="radio" name="format" value="html" checked> HTML</label>
	</p>
</fieldset>

</form>
</body>
</html>
