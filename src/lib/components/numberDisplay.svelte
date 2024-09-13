<script lang="ts">
	export let amount: number = 0; // Amount in DKK

	// Format the amount as Danish Krone currency
	const formatCurrency = (value: number) => {
		return value.toLocaleString('da-DK', {
			style: 'currency',
			currency: 'DKK',
			minimumFractionDigits: 1 // No decimal places
		});
	};
</script>

<div class="backdrop">
	<div class="number-display">
		Current Revenue <br />
		{formatCurrency(amount)}
	</div>
</div>

<style>
	.backdrop {
		background: #eaeaea; /* Semi-transparent black */
		border-radius: 30px;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
		align-content: center;
		height: auto;
		width: 90%;
		padding-top: 20px;
		padding-bottom: 20px;
		margin: 0 auto;
		margin-bottom: 20px;
	}

	.number-display {
		align-content: center;
		font-size: 3rem; /* Large font size */
		color: black; /* White text color */
		text-align: center;
	}
</style>
