<script>
	let isFullscreen = false;

	function toggleFullscreen() {
		if (!document.fullscreenElement) {
			// Request fullscreen
			if (document.documentElement.requestFullscreen) {
				document.documentElement.requestFullscreen().catch((err) => {
					console.error('Error attempting to enable fullscreen mode:', err);
				});
			}
			isFullscreen = true;
		} else {
			// Exit fullscreen
			if (document.exitFullscreen) {
				document.exitFullscreen().catch((err) => {
					console.error('Error attempting to exit fullscreen mode:', err);
				});
			}
			isFullscreen = false;
		}
	}
</script>

<button on:click={toggleFullscreen}>
	{#if isFullscreen}
		🗖
	{:else}
		⛶
	{/if}
</button>

<style>
	/* Add any styles you want here */
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
</style>
