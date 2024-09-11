<script lang="ts">
	export let itemsInCart: { name: string; price: number }[];
	export let showKeyboard: boolean;
	export let totalPrice: number = 0;
	export let changePaid: number = 0;
	export let changeBack: number = 0;

	function removeItem(index: number) {
		itemsInCart = itemsInCart.filter((_, i) => i !== index);
		console.log(itemsInCart);
		countItems(itemsInCart);
		changeBackCount(totalPrice, changePaid);
	}
	function changeBackCount(totalPrice: number, changePaid: number) {
		changeBack = changePaid - totalPrice;
	}

	function countItems(cart: { name: string; price: number }[]) {
		console.log(cart);
		totalPrice = 0;
		cart.forEach((item) => {
			totalPrice += item.price;
		});
	}
	function toggleKeyboard() {
		if (showKeyboard) {
			showKeyboard = false;
		} else {
			showKeyboard = true;
		}
	}
	$: countItems(itemsInCart);
	$: changeBackCount(totalPrice, changePaid);
</script>

<div class="right-box">
	<div class="item-list">
		<h2>Items in Cart</h2>
		<ul>
			{#each itemsInCart as item, index}
				<li>
					{item.name} - ${item.price.toFixed(2)}
					<button class="remove-btn" on:click={() => removeItem(index)}>Remove</button>
				</li>
			{/each}
		</ul>
	</div>
	<div class="summary">
		<div>
			<span class="label">Total Price:</span>
			{totalPrice.toFixed(2)} .kr
		</div>
		<div>
			<span class="label">Change Paid:</span>
			{changePaid.toFixed(2)} .kr
		</div>
		<div>
			<span class="label">Change Back:</span>
			{changeBack.toFixed(2)} .kr
		</div>
	</div>
	<div class="button-container">
		<button class="btn">Complete Transaction</button>
		<button class="btn" on:click={() => toggleKeyboard()}>Change</button>
	</div>
</div>

<style>
	.right-box {
		background-color: #eaeaea; /* Slightly darker white */
		width: 30%; /* Take up one-third of the screen */
		padding: 20px;
		border-radius: 8px;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		position: sticky;
		top: 0; /* Keep the box fixed at the top */
		display: flex;
		flex-direction: column;
		height: 100%;
		box-sizing: border-box;
		margin-right: 10px;
	}

	.item-list {
		flex: 1; /* Allow item list to take up the remaining space */
		margin-bottom: 20px;
		overflow-y: auto;
	}

	.item-list ul {
		list-style-type: none;
		padding: 0;
		margin: 0;
	}

	.item-list ul li {
		padding: 10px;
		border-bottom: 1px solid #ccc;
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	.remove-btn {
		background-color: #dc3545;
		color: white;
		border: none;
		padding: 5px 10px;
		font-size: 0.9em;
		cursor: pointer;
		border-radius: 5px;
		transition: background-color 0.2s ease;
	}

	.remove-btn:hover {
		background-color: #c82333;
	}

	.summary {
		margin-bottom: 20px;
		/* border-top: 1px solid #ccc; */
		padding: 10px 0;
	}

	.summary div {
		display: flex;
		justify-content: space-between;
		padding: 5px 0;
	}

	.summary .label {
		font-weight: bold;
	}

	.button-container {
		display: flex;
		justify-content: space-between;
	}

	.button-container .btn {
		background-color: #007bff;
		color: white;
		border: none;
		padding: 10px 15px;
		font-size: 1em;
		cursor: pointer;
		border-radius: 5px;
		transition: background-color 0.2s ease;
		width: 48%;
	}

	.button-container .btn:hover {
		background-color: #0056b3;
	}
</style>
