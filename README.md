README - Under development
==========================

What is MistyForms?
-----------------

MistyForms is a form builder system based on Smarty 3.

It is designed to make it as easy as possible to create usable, safe and consistent forms.

Why should I use it?
------------------

Because forms are simple things, but they actually require a lot of work to be implemented the right way.
The input must be validated, and it's never acceptable to lose the user data when there is an error with
the input. As a result every form requires a lot of code to read the data, check it, and create a new form
with all the submitted data when there's an error.

The alternative is to use a form builder. With MistyForms you only have to specify the form and its
requirements in the Smarty template, and you are done.

How does it work
------------

You have to define the form and its requirements in your template:

```html
{form}
	{rowlabel for=username text="Username"}
		{textfield id=username required=1 minLength=5 maxLength=20}
	{/rowlabel}

	{rowlabel for=email text="Email"}
		{emailfield id=email required=1}
	{/rowlabel}

	{command id=register text="Send form"}
{/form}
```

```php
```

Features
-------

What it does:

* Makes your forms more usable:
** All forms are consistent, both in look and functionality
** User submitted data is never lost, no matter how many times the user re-submit the form
* Makes it simpler to create forms
** The form and its requirements are defined in your Smarty template. No more PHP configuration
** The code is very concise, almost as concise as writing a HTML form
* Makes your forms safer
** The input is automatically server-side validated according to your requirements
** Crafted data is discarded (e.g. values added to a select field using firebug)

What it doesn't do:

* Escaping. MistyForms only makes sure that the data you received complies with the requirements you
specified. Escaping of the input is your responsability

What it will do in future:

* Javascript validation

Requirements
------------

MistyForms requires Smarty 3 and PHP 5.3
