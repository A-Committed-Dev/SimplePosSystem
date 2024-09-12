<script lang="ts">
	import Card from '$lib/components/card.svelte';
	import Shoppingcart from '$lib/components/shoppingcart.svelte';
	import Keyboard from '$lib/components/keyboard.svelte';
	import Pin from '$lib/components/pin.svelte';
	import Piechart from '$lib/components/piechart.svelte';
	import NumberDisplay from '$lib/components/numberDisplay.svelte';
	import ButtonGrid from '$lib/components/buttonGrid.svelte';
	import Footer from '$lib/components/footer.svelte';

	// Define the structure for cart items
	interface CartItem {
		name: string;
		price: number;
	}

	interface payment {
		CartItems: CartItem[];
		totalPrice: number;
		changePaid: number;
		changeBack: number;
	}
	// Initialize itemsInCart array
	let itemsInCart: CartItem[] = [];

	let allPayments: payment[] = [];

	let showKeyboard: boolean = false;
	let changePaid: number = 0;

	let unlocked: boolean = false;
	let showStatistics: boolean = false;
</script>

{#if unlocked}
	{#if showStatistics}
		<div>
			<div class="layout-container">
				<Piechart
					names={['Wrap', 'Pandekage', 'Pandekage bål', 'Suppe', 'Sodavand', 'Vand']}
					products={[9, 1]}
				></Piechart>
				<div
					style="width: 50%;  background-color: #f4f4f4; align-content: center; border-radius: 20px;"
				>
					<NumberDisplay amount={200}></NumberDisplay>
					<ButtonGrid></ButtonGrid>
				</div>
			</div>
		</div>
	{:else}
		<div class="layout-container">
			{#if showKeyboard}
				<Keyboard bind:showKeyboard bind:changePaid></Keyboard>
			{:else}
				<Card bind:itemsInCart></Card>
			{/if}
			<Shoppingcart bind:itemsInCart bind:showKeyboard bind:changePaid bind:allPayments
			></Shoppingcart>
		</div>
	{/if}

	<Footer bind:unlocked bind:showStatistics></Footer>
{:else}
	<Pin bind:unlocked></Pin>
{/if}

<style>
	/* Flexbox container for the entire layout */
	.layout-container {
		display: flex;
		width: 100%;
		height: 85vh; /* Full height of the viewport */
		/* padding: 10px; */
		/* background-color: #f4f4f4; */
	}
</style>
