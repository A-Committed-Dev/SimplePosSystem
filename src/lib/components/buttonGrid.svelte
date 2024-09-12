<script>
	const handleLargeButtonClick = () => {
		alert('Large button clicked!');
	};
</script>

<!-- Small Buttons -->

<!-- Large Button -->
<button class="button button-large" on:click={handleLargeButtonClick}>Sync <br /> ↑↓</button>

<style>
	.button {
		width: 90%;
		display: flex;
		align-items: center;
		justify-content: center;
		border: none;
		cursor: pointer;
		border-radius: 5px;
		background-color: #007bff; /* Button background color */
		color: #fff; /* Button text color */
		font-size: 1rem;
		padding-bottom: 20px;
		padding-top: 20px;
		margin: 0 auto;
	}

	.button-large {
		border-radius: 20px;
		grid-column: 1 / 4; /* Span across all three columns */
		font-size: 5rem; /* Adjust as needed */
		background-color: #28a745; /* Different background for the large button */
		display: flex;
		align-items: center;
		justify-content: center;
	}
</style>
