<script lang="ts">
	function statisicsClick(event: MouseEvent): void {
		showStatistics = true;
	}
	function paymentClick(event: MouseEvent): void {
		showStatistics = false;
	}

	function lockClick(event: MouseEvent): void {
		unlocked = false;
	}

	export let unlocked: boolean;
	export let showStatistics: boolean;
</script>

<footer class="footer">
	<div class="center-buttons">
		<button on:click={paymentClick}>Payment</button>
		<button on:click={statisicsClick}>Statistics</button>
	</div>
	<button class="lock-button" on:click={lockClick}>🔒</button>
</footer>

<style>
	.footer {
		display: flex;
		justify-content: center;
		align-items: center;
		position: fixed;
		bottom: 0;
		left: 0;
		width: 100%; /* Full width */
		height: 12vh;
		/* padding-top: 20px; */
		/* padding-bottom: 20px; */
		background-color: #f8f9fa;
		border-top: 1px solid #ddd;
		z-index: 1000;
		/* margin-top: 20px; */
	}

	.center-buttons {
		display: flex;
		gap: 1rem; /* Space between the buttons */
		margin: 0 auto;
	}

	/* Style for larger buttons */
	button {
		background-color: #007bff;
		color: white;
		/* padding: 1rem 2rem; /* Increased padding for bigger buttons */
		/* padding-top: 2rem; */
		/* padding-bottom: 2rem; */
		width: 150px;
		height: 80px;
		font-size: 1.5rem; /* Larger font size */
		border: none;
		border-radius: 8px; /* Increased border radius */
		cursor: pointer;
		font-weight: bolder;
	}

	button:hover {
		background-color: #0056b3;
	}

	/* Lock button in the right corner */
	.lock-button {
		position: absolute;
		right: 1rem;
		background-color: #007bff;
		color: white;
		/* padding: 1rem 2rem; /* Increased padding for bigger buttons */
		/* padding-top: 2rem; */
		/* padding-bottom: 2rem; */
		font-size: 1.5rem;
		border: none;
		border-radius: 8px;
		cursor: pointer;
	}

	.lock-button:hover {
		background-color: #0056b3;
	}

	.lock-icon {
		margin-left: 0.5rem;
		font-size: 1.5rem; /* Increase size of lock icon */
	}
</style>
