<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Two columns layout - Example form</title>
	<meta name="description" content="">

	<meta name="viewport" content="width=device-width">

	<link rel="stylesheet" href="../static/css/normalize.css">
	<link rel="stylesheet" href="../static/css/mistyforms.css">

	<style type="text/css">
		body{
			padding: 0 35px 35px 35px;
		}
	</style>
</head>
<body>

	<h1>Two columns layout - Example form</h1>

	{mf_form}
		<fieldset>
			<legend>Let's have a legend</legend>

			{mf_rowlabel for=textfield text="Simple text field"}
				{mf_textfield id=textfield required=1 placeholder="With placeholder text..."}
				<small class="mf_note_inline">The placeholder is done using the HTML5 placeholder attribute</small>
			{/mf_rowlabel}

			{mf_rowlabel for=emailfield text="E-mail field"}
				{mf_emailfield id=emailfield}
				<small class="mf_note_inline">This is a HTML5 email field</small>
			{/mf_rowlabel}

			{mf_rowlabel text="Radio button - list style"}
				{mf_radiobutton id=radiobuttons options=$radiobuttons}
			{/mf_rowlabel}

			{mf_rowlabel text="Radio button - compact style"}
				{mf_radiobutton id=radiobuttons2 options=$radiobuttons}
			{/mf_rowlabel}

		</fieldset>

		<fieldset>
			<legend>And another legend</legend>

			{mf_rowlabel for=select text="A select box"}
				{mf_select id=select options=$selects selected=4}
			{/mf_rowlabel}

			{mf_rowlabel for=intfield text="A numeric field"}
				{mf_numericfield id=intfield format=integer size=4}
				<small class="mf_note">This will only accept an integer or no input</small>
			{/mf_rowlabel}

			{mf_rowlabel for=textarea text="I love texteareas"}
				{mf_textarea id=textarea rows=6 cols=40}
			{/mf_rowlabel}
		</fieldset>

		<fieldset>
			<legend>And a checkbox please</legend>

			{mf_rowlabel for=checkbox text="Standard checkbox"}
				{mf_checkbox id=checkbox}
			{/mf_rowlabel}
		</fieldset>

		<fieldset>
			<legend>What if I have a long text?</legend>

			{mf_rowlabel for=checkbox2 text="You can invert the checkbox and the label, in case you have a very long label, or you need more space because you want to explain something to the user. Or just show off that your form supports it." class="mf_longtext"}
				{mf_checkbox id=checkbox2 required=1}
			{/mf_rowlabel}
		</fieldset>

		<div class="mf_actions">
			{mf_submit id=actionName value="Register"}
			<a href="#">Cancel</a>
			<p>Buttons are unstyled because you should use the style of your site</p>
		</div>
	{/mf_form}

</body>
</html>