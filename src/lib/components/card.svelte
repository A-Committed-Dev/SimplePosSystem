<script lang="ts">
	export let itemsInCart: { name: string; price: number }[];

	interface Card {
		header: string;
		image: string;
		price: number;
	}

	let cards: Card[] = [
		{
			header: 'Item Header 1',
			image: 'https://placehold.co/600x400/EEE/31343C',
			price: 49.99
		},
		{
			header: 'Item Header 2',
			image: 'https://placehold.co/600x400/EEE/31343C',
			price: 59.99
		},
		{
			header: 'Item Header 3',
			image: 'https://placehold.co/600x400/EEE/31343C',
			price: 39.99
		},
		{
			header: 'Item Header 4',
			image: 'https://placehold.co/600x400/EEE/31343C',
			price: 69.99
		},
		{
			header: 'Item Header 5',
			image: 'https://placehold.co/600x400/EEE/31343C',
			price: 89.99
		},
		{
			header: 'Item Header 6',
			image: 'https://placehold.co/600x400/EEE/31343C',
			price: 99.99
		},
		{
			header: 'Item Header 7',
			image: 'https://placehold.co/600x400/EEE/31343C',
			price: 109.99
		},
		{
			header: 'Item Header 8',
			image: 'https://placehold.co/600x400/EEE/31343C',
			price: 119.99
		},
		{
			header: 'Item Header 9',
			image: 'https://placehold.co/600x400/EEE/31343C',
			price: 129.99
		},
		{
			header: 'Item Header 10',
			image: 'https://placehold.co/600x400/EEE/31343C',
			price: 139.99
		}
	];

	function additem(name: string, price: number) {
		itemsInCart.push({ name: name, price: price });
		itemsInCart = itemsInCart;
	}
</script>

<div class="card-container">
	{#each cards as card}
		<div class="card">
			<h2>{card.header}</h2>
			<img src={card.image} alt="Item Image" />
			<div class="price">{card.price} .kr</div>
			<button class="add-btn" on:click={() => additem(card.header, card.price)}>Add to Cart</button>
		</div>
	{/each}
</div>

<style>
	.card-container {
		display: grid;
		grid-template-columns: repeat(2, 1fr); /* Two columns per row */
		gap: 20px;
		width: 70%;
		height: 100%;
		max-width: 1200px; /* Optional: Set max-width for large screens */
		box-sizing: border-box;
		overflow-y: auto; /* Enable vertical scrolling */
		/* padding: 20px; /* Add padding around the container */
		padding-right: 20px;
		/* background-color: white; /* Optional: Add a background color */
		margin-left: 5px;
	}

	.card {
		background-color: white;
		border: 1px solid #ccc;
		border-radius: 8px;
		padding: 20px;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		transition: transform 0.2s ease;
		display: flex;
		flex-direction: column;
		justify-content: space-between;
		height: 100%; /* Ensure the card takes full height of the grid cell */
		box-sizing: border-box; /* Ensure padding is included in the width/height */
	}

	.card:hover {
		transform: scale(1.05);
	}

	h2 {
		margin-top: 0;
		font-size: 1.5em;
	}

	.card img {
		width: 100%;
		border-radius: 8px;
		margin-bottom: 15px;
	}

	.price {
		font-size: 1.2em;
		color: #333;
		font-weight: bold;
		margin: 10px 0;
	}

	.add-btn {
		background-color: #28a745;
		color: white;
		border: none;
		padding: 10px 15px;
		font-size: 1em;
		cursor: pointer;
		border-radius: 5px;
		text-align: center;
		transition: background-color 0.2s ease;
	}

	.add-btn:hover {
		background-color: #218838;
	}
</style>
