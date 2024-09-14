<script lang="ts">
	import Card from '$lib/components/card.svelte';
	import Shoppingcart from '$lib/components/shoppingcart.svelte';
	import Keyboard from '$lib/components/keyboard.svelte';
	import Pin from '$lib/components/pin.svelte';
	import Piechart from '$lib/components/piechart.svelte';
	import NumberDisplay from '$lib/components/numberDisplay.svelte';
	import ButtonGrid from '$lib/components/buttonGrid.svelte';
	import Footer from '$lib/components/footer.svelte';
	import { onMount } from 'svelte';
	import axios from 'axios';

	// Define the structure for cart items
	interface CartItem {
		name: string;
		price: number;
	}

	interface Payment {
		CartItems: CartItem[];
		totalPrice: number;
		changePaid: number;
		changeBack: number;
	}

	interface SyncedJson {
		items: {
			Wraps: number;
			Pandekage: number;
			'Pandekage Bål': number;
			'Suppe Med Brød': number;
			Sodavand: number;
			Vand: number;
		};
		money: {
			totalEarned: number;
			totalChangeGiven: number;
			totalChangeBack: number;
		};
	}

	let itemsInCart: CartItem[] = [];
	let allPayments: Payment[] = [];
	let showKeyboard: boolean = false;
	let changePaid: number = 0;
	let unlocked: boolean = false;
	let showStatistics: boolean = false;
	let doSync: boolean = false;

	// Initialize with default values
	let syncedJson: SyncedJson = {
		items: {
			Wraps: 0,
			Pandekage: 0,
			'Pandekage Bål': 0,
			'Suppe Med Brød': 0,
			Sodavand: 0,
			Vand: 0
		},
		money: {
			totalEarned: 0,
			totalChangeGiven: 0,
			totalChangeBack: 0
		}
	};

	let products: number[] = [];
	let names: string[] = ['Wrap', 'Pandekage', 'Pandekage bål', 'Suppe', 'Sodavand', 'Vand'];

	// Helper function to convert string to number if needed
	function parseData(data: any): SyncedJson {
		return {
			items: {
				Wraps: Number(data.items.Wraps),
				Pandekage: Number(data.items.Pandekage),
				'Pandekage Bål': Number(data.items['Pandekage Bål']),
				'Suppe Med Brød': Number(data.items['Suppe Med Brød']),
				Sodavand: Number(data.items.Sodavand),
				Vand: Number(data.items.Vand)
			},
			money: {
				totalEarned: Number(data.money.totalEarned),
				totalChangeGiven: Number(data.money.totalChangeGiven),
				totalChangeBack: Number(data.money.totalChangeBack)
			}
		};
	}

	function doSyncFunc(doSync: boolean, showMessage: boolean) {
		if (doSync) {
			if (showMessage) {
				alert('Syncing with database pushing ' + allPayments.length + ' payments to server.');
			}
			// Send POST request using Axios
			let doFetch: boolean = false;

			if (allPayments.length > 0) {
				axios
					.post('/backend.php', allPayments)
					.then((response) => {
						console.log('Success:', response.data);
					})
					.catch((error) => {
						console.error('Error:', error);
					});
				doFetch = true;
			} else {
				doFetch = true;
			}

			if (doFetch) {
				setTimeout(() => {
					// Fetch data and parse it to the correct types
					axios
						.get('/getData.php')
						.then((response) => {
							const data = response.data;
							console.log('Fetched raw data:', data);

							// Parse the string values into numbers
							syncedJson = parseData(data);

							// Now update the products array
							products = [
								syncedJson.items.Wraps,
								syncedJson.items.Pandekage,
								syncedJson.items['Pandekage Bål'],
								syncedJson.items['Suppe Med Brød'],
								syncedJson.items.Sodavand,
								syncedJson.items.Vand
							];
							console.log('Updated products:', products);
						})
						.catch((error) => {
							console.error('Error fetching data:', error);
						});

					allPayments = [];
					console.log('this is json from db ->', syncedJson);
					if (showMessage) {
						alert('Synced with database');
					}
				}, 3000);
			}
		}
	}

	onMount(() => {
		doSyncFunc(true, false);
	});

	$: doSyncFunc(doSync, true), (doSync = false);
</script>

{#if unlocked}
	{#if showStatistics}
		<div>
			<div class="layout-container">
				{#key products}
					<Piechart {names} {products}></Piechart>
				{/key}
				<div
					style="width: 50%;  background-color: #f4f4f4; align-content: center; border-radius: 20px;"
				>
					<NumberDisplay amount={syncedJson.money.totalEarned}></NumberDisplay>
					<ButtonGrid bind:doSync></ButtonGrid>
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
