<script>
	import { onMount } from 'svelte';
	export let products;
	export let names;
	onMount(async () => {
		const ApexCharts = (await import('apexcharts')).default;
		var options = {
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
		};
		var chart = new ApexCharts(document.querySelector('#chart'), options);

		chart.render();
	});
</script>

<div class="chart" id="chart"><h1 style="text-align: center;">Products sold by %</h1></div>

<style>
	.chart {
		align-content: center;
		width: 50%;
		height: auto;
	}
</style>
