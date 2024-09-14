<script>
	export let message = '';
	export let visible = false;

	const closeAlert = () => {
		visible = false;
	};
</script>

{#if visible}
	<div class="alert-box">
		<p>{message}</p>
		<button on:click={closeAlert}>Close</button>
	</div>
{/if}

<style>
	.alert-box {
		background-color: lightcoral;
		color: white;
		padding: 1em;
		border-radius: 5px;
		position: fixed;
		top: 20px;
		right: 20px;
		z-index: 1000;
	}

	button {
		margin-top: 1em;
		background: none;
		border: 1px solid white;
		color: white;
		cursor: pointer;
	}
</style>
