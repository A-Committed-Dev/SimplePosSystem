<script lang="ts">
	let display: string = '0';
	export let changePaid: number;
	export let showKeyboard: boolean;

	function appendNumber(number: string) {
		display = display === '0' ? number : display + number;
	}

	function clearDisplay() {
		display = '0';
	}

	function eraseLastDigit() {
		display = display.length > 1 ? display.slice(0, -1) : '0';
	}

	function submitNumber() {
		changePaid = +display;
		clearDisplay(); // Optional: clear the display after submission
		showKeyboard = false;
	}
</script>

<div class="keyboard-container">
	<div class="display">{display}</div>
	<div class="keyboard">
		<button on:click={() => appendNumber('1')}>1</button>
		<button on:click={() => appendNumber('2')}>2</button>
		<button on:click={() => appendNumber('3')}>3</button>
		<button on:click={() => appendNumber('4')}>4</button>
		<button on:click={() => appendNumber('5')}>5</button>
		<button on:click={() => appendNumber('6')}>6</button>
		<button on:click={() => appendNumber('7')}>7</button>
		<button on:click={() => appendNumber('8')}>8</button>
		<button on:click={() => appendNumber('9')}>9</button>
		<button on:click={() => appendNumber('0')}>0</button>
		<button class="erase-btn" on:click={eraseLastDigit}>←</button>
		<button class="clear-btn" on:click={clearDisplay}>Clear</button>
		<button class="enter-btn" on:click={submitNumber}>Enter</button>
	</div>
</div>

<style>
	.keyboard-container {
		display: flex;
		flex-direction: column;
		background-color: #fff;
		border-radius: 8px;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		padding: 20px;
		width: 70%;
		height: 100%;
		box-sizing: border-box;
		padding-right: 20px;
		margin-right: 20px;
	}

	.display {
		font-size: 2em;
		margin-bottom: 20px;
		padding: 10px;
		border: 1px solid #ccc;
		border-radius: 5px;
		background-color: #eaeaea;
		width: 100%;
		text-align: right;
		box-sizing: border-box;
	}

	.keyboard {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		grid-template-rows: repeat(4, 1fr);
		gap: 10px;
		width: 100%;
		height: 100%;
		box-sizing: border-box;
		margin-top: 10px; /* Optional: Add some space between display and keyboard */
	}

	.keyboard button {
		background-color: #007bff;
		color: white;
		border: none;
		font-size: 1.5em; /* Adjust font size as needed */
		cursor: pointer;
		border-radius: 5px;
		transition: background-color 0.2s ease;
		width: 100%;
		height: 100%;
		box-sizing: border-box;
		display: flex;
		align-items: center;
		justify-content: center; /* Center text within the button */
	}

	.keyboard button:hover {
		background-color: #0056b3;
	}

	.keyboard .enter-btn {
		grid-column: span 3;
		grid-row: span 10;

		background-color: #28a745;
	}

	.keyboard .enter-btn:hover {
		background-color: #218838;
	}

	.keyboard .clear-btn {
		grid-column: span 3;
		grid-row: span 10;
		background-color: #dc3545;
	}

	.keyboard .clear-btn:hover {
		background-color: #c82333;
	}

	.keyboard .erase-btn {
		background-color: #ffc107;
		grid-column: span 2;
	}

	.keyboard .erase-btn:hover {
		background-color: #e0a800;
	}
</style>
