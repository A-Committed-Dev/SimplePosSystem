<!-- <script lang="ts"> -->
<!-- 	import { onMount, onDestroy } from 'svelte'; -->
<!---->
<!-- 	export let products: number[]; -->
<!-- 	export let names: string[]; -->
<!---->
<!-- 	let chart: ApexCharts | null = null; -->
<!---->
<!-- 	onMount(async () => { -->
<!-- 		// Dynamically import ApexCharts only on the client-side -->
<!-- 		if (typeof window !== 'undefined') { -->
<!-- 			const ApexCharts = (await import('apexcharts')).default; -->
<!---->
<!-- const options: ApexCharts.ApexOptions = { -->
<!-- 	series: products, -->
<!-- 	chart: { -->
<!-- 		width: '100%', -->
<!-- 		type: 'pie' -->
<!-- 	}, -->
<!-- 	labels: names, -->
<!-- 	responsive: [ -->
<!-- 		{ -->
<!-- 			breakpoint: 480, -->
<!-- 			options: { -->
<!-- 				chart: { -->
<!-- 					width: 200 -->
<!-- 				}, -->
<!-- 				legend: { -->
<!-- 					position: 'bottom' -->
<!-- 				} -->
<!-- 			} -->
<!-- 		} -->
<!-- 	] -->
<!-- }; -->
<!-- 			chart = new ApexCharts(document.querySelector('#chart'), options); -->
<!-- 			chart.render(); -->
<!-- 		} -->
<!-- 	}); -->
<!---->
<!-- 	// Clean up the chart when component is destroyed -->
<!-- 	onDestroy(() => { -->
<!-- 		if (chart) { -->
<!-- 			chart.destroy(); -->
<!-- 		} -->
<!-- 	}); -->
<!---->
<!-- 	// Reactive block to update the chart whenever products or names change -->
<!-- 	$: if (chart) { -->
<!-- 		console.log('this is the updated products ->', products); -->
<!-- 		chart.updateSeries(products); -->
<!-- 	} -->
<!-- </script> -->
<!---->
<!---->
<!---->
<script lang="ts">
	import { browser } from '$app/environment';
	import { renderChart, type Chart } from 'svelte-chart-apex';

	export let products;
	export let names;

	const chart: Chart = {
		// Provide your own ApexCharts options.
		options: {
			series: products,
			chart: {
				width: '100%',
				type: 'pie'
			},
			labels: names,
			responsive: [
				{
					breakpoint: 480,
					options: {
						chart: {
							width: 200
						},
						legend: {
							position: 'bottom'
						}
					}
				}
			]
		}
		// These key-values are later set by the action.
		// - node: HTMLDivElement; - No need to use bind:this on the <div> element.
		// - ref: ApexCharts; - Use the ApexCharts' methods. (e.g. updateOptions)
	};

	$: if (products) {
		// Update the chart when the page products gets updated. (e.g. invalidateAll)
		// The `updateSeries` does not run on mount, since the `ref` is undefined.
		console.log('updated chart', products);
		chart.ref?.updateSeries([{ data: products }]);
	}
</script>

<div class="container">
	<h1>Products sold by %</h1>
	<div class="chart" use:renderChart={chart}></div>
</div>

<style>
	.container {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		width: 50%;
	}

	.chart {
		width: 100%;
		max-width: 600px; /* Adjust this to fit your design */
		height: 400px; /* Adjust this to fit your design */
	}
</style>
