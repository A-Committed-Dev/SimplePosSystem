<script lang="ts">
	import FullscreenButton from './fullscreenButton.svelte';

	let pin: string = '';
	const correctPin: string = '1234';
	export let unlocked: Boolean;
	let message: string = '';

	function handleButtonClick(value: number): void {
		if (pin.length < 4) {
			pin += value;
			message = '';
		}
		if (pin.length === 4) {
			checkPin();
		}
	}

	function deleteLastDigit(): void {
		pin = pin.slice(0, -1);
	}

	function clearPin(): void {
		pin = '';
	}

	function checkPin(): void {
		if (pin === correctPin) {
			// message = 'Access Granted!';
			unlocked = true;
		} else {
			// message = 'Incorrect PIN. Try again.';
			unlocked = false;
			clearPin();
		}
	}
</script>

<div class="pin-container">
	<div class="pin-display">{pin.padEnd(4, '•')}</div>

	<div class="buttons">
		{#each [1, 2, 3, 4, 5, 6, 7, 8, 9] as num}
			<button on:click={() => handleButtonClick(num)}>{num}</button>
		{/each}
		<button on:click={deleteLastDigit}>←</button>
		<button on:click={() => handleButtonClick(0)}>0</button>
		<button on:click={clearPin}>C</button>
	</div>
	<FullscreenButton></FullscreenButton>

	{#if message}
		<div class="message">{message}</div>
	{/if}
</div>

<style>
	.pin-container {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		height: 95vh;
	}

	.pin-display {
		font-size: 4em;
		letter-spacing: 20px;
		margin-bottom: 40px;
		text-align: center;
	}

	.buttons {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		gap: 20px;
		margin-bottom: 20px;
	}

	button {
		font-size: 2em;
		padding: 20px;
		background-color: #f0f0f0;
		border: none;
		border-radius: 50%; /* Makes the buttons circular */
		cursor: pointer;
		width: 100px; /* Equal width and height for circular buttons */
		height: 100px;
		display: flex;
		align-items: center;
		justify-content: center;
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow for a better appearance */
	}

	button:active {
		background-color: #ccc;
	}

	.message {
		margin-top: 40px;
		font-size: 2em;
		color: #f00;
	}
</style>
