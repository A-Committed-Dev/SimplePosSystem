<script lang="ts">
	import Card from '$lib/components/card.svelte';
	import Shoppingcart from '$lib/components/shoppingcart.svelte';
	import Keyboard from '$lib/components/keyboard.svelte';
	import Pin from '$lib/components/pin.svelte';

	// Define the structure for cart items
	interface CartItem {
		name: string;
		price: number;
	}

	// Initialize itemsInCart array
	let itemsInCart: CartItem[] = [];

	let showKeyboard: boolean = false;
	let changePaid: number = 0;

	let unlocked: boolean = false;
</script>

{#if unlocked}
	<div class="layout-container">
		{#if showKeyboard}
			<Keyboard bind:showKeyboard bind:changePaid></Keyboard>
		{:else}
			<Card bind:itemsInCart></Card>
		{/if}
		<Shoppingcart bind:itemsInCart bind:showKeyboard bind:changePaid></Shoppingcart>
	</div>
{:else}
	<Pin bind:unlocked></Pin>
{/if}

<!-- <Card></Card> -->
<!-- <Shoppingcart></Shoppingcart> -->

<style>
	/* Flexbox container for the entire layout */
	.layout-container {
		display: flex;
		width: 100%;
		height: 95vh; /* Full height of the viewport */
		/* padding: 10px; */
		/* background-color: #f4f4f4; */
	}
</style>
