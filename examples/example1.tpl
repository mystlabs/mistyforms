<h1>{$var}</h1>

{form}
	{rowlabel for="product" text="Product"}
		{textfield id=product required=1}
	{/rowlabel}

	{rowlabel for="price" text="Price"}
		{numericfield id=price}
	{/rowlabel}

	{submit id=actionName value="Insert product"}
{/form}