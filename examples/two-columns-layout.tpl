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

			{mf_row label="Simple text field" for=textfield}
				{mf_text id=textfield required=1 placeholder="With placeholder text..."}
				<small class="mf_note_inline">The placeholder is done using the HTML5 placeholder attribute</small>
			{/mf_row}

			{mf_row label="E-mail field" for=emailfield}
				{mf_email id=emailfield}
				<small class="mf_note_inline">This is a HTML5 email field</small>
			{/mf_row}

			{mf_row label="Radio button - compact style" for=radiobuttons}
				{mf_radiobutton id=radiobuttons options=$radioOptions required=1}
			{/mf_row}

			{mf_row label="Radio button - list style" class="mf_options_compact"}
				{mf_radiobutton id=radiobuttons2 options=$radioOptions}
			{/mf_row}

		</fieldset>

		<fieldset>
			<legend>And another legend</legend>

			{mf_row label="A select box" for=select}
				{mf_select id=select options=$selectOptions selected=4}
			{/mf_row}

			{mf_row label="A numeric field" for=intfield}
				{mf_number id=intfield format=integer size=4}
				<small class="mf_note">This will only accept an integer or no input</small>
			{/mf_row}

			{mf_row label="I love texteareas" for=textarea}
				{mf_textarea id=textarea rows=6 cols=40}
			{/mf_row}
		</fieldset>

		<fieldset>
			<legend>And a checkbox please</legend>

			{mf_row label="Standard checkbox" for=checkbox}
				{mf_checkbox id=checkbox}
			{/mf_row}
		</fieldset>

		<fieldset>
			<legend>What if I have a long text?</legend>

			{mf_row label="You can invert the checkbox and the label, in case you have a very long label, or you need more space because you want to explain something to the user. Or just show off that your form supports it." class="mf_longtext" for=checkbox2}
				{mf_checkbox id=checkbox2 required=1}
			{/mf_row}
		</fieldset>

		<div class="mf_actions">
			{mf_submit id=actionName value="Register"}
			<a href="#">Cancel</a>
			<p>Buttons are unstyled because you should use the style of your site</p>
		</div>
	{/mf_form}

</body>
</html>